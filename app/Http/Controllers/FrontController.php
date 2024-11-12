<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Device;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Type;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;

class FrontController extends Controller {
    public function index() {
        $categories = Category::all();
        $products = Product::all();
        $recommendedProducts = Product::inRandomOrder()->take(9)->get();
        $types = Type::withCount('products')->get();
        $categories = Category::withCount('products')->get();
        // Pour chaque produit, récupérer le stock associé
        foreach ($products as $product) {
            $product->stock = Stock::where('product_id', $product->id)->first();
        }

        $devises = Device::all();
        return view('front', compact('categories', 'products', 'devises', 'recommendedProducts', 'types'));
    }
    public function getProductsByDevise(Request $request) {
        $deviseId = $request->get('devise_id');
        $products = Product::with('devise', 'stock')->where('devise_id', $deviseId)->get();

        return response()->json(['products' => $products]);
    }


    public function productsFront()
    {
        $categories = Category::all();
        $products = Product::all();
        $recommendedProducts = Product::inRandomOrder()->take(9)->get();
        $types = Type::withCount('products')->get();
        $categories = Category::withCount('products')->get();
        // Pour chaque produit, récupérer le stock associé
        foreach ($products as $product) {
            $product->stock = Stock::where('product_id', $product->id)->first();
        }

        $devises = Device::all();
        return view('products', compact('categories', 'products', 'devises', 'recommendedProducts', 'types'));

    }


    public function addToCart(Request $request) {
        $product = Product::find($request->product_id);
        $quantity = $request->quantity;

        // Ensure the product and stock exist
        if (!$product) {
            return response()->json(['error' => 'Produit introuvable.']);
        }

        $stock = Stock::where('product_id', $product->id)->first();
        if ($stock && $stock->quantity >= $quantity) {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->prixUnit,
                'quantity' => $quantity,
                'attributes' => [
                    'image' => $product->image,
                    'devise' => $product->devise->name,
                ],
            ]);
            $stock->decrement('quantity', $quantity);
            return response()->json(['success' => 'Produit ajouté au panier']);
        }

        return response()->json(['error' => 'Stock insuffisant']);
    }

    public function removeFromCart(Request $request) {
        $product = Cart::get($request->product_id);

        if ($product) {
            Cart::remove($request->product_id);

            // Find the actual product model and update stock
            $productModel = Product::find($product->id);
            if ($productModel) {
                $productModel->stocks()->first()->increment('quantity', $product->quantity);
            }

            return response()->json(['success' => 'Produit retiré du panier']);
        }

        return response()->json(['error' => 'Produit non trouvé dans le panier.']);
    }

    public function cartItems() {
        $items = Cart::getContent()->values(); // Ensure items are in array format
        $total = Cart::getTotal();

        return response()->json(['items' => $items, 'total' => $total]);
    }

    public function cartCount() {
        $count = Cart::getContent()->count();
        return response()->json(['count' => $count]);
    }

    public function modifyCartQuantity(Request $request) {
        $product = Cart::get($request->product_id);
        $quantityChange = $request->delta;

        if ($product) {
            $productModel = Product::find($product->id);
            if (!$productModel) {
                return response()->json(['error' => 'Produit introuvable.']);
            }

            $stock = $productModel->stocks()->first();
            if (!$stock) {
                return response()->json(['error' => 'Stock introuvable pour ce produit.']);
            }

            if ($quantityChange > 0) {
                // Increment quantity in cart if stock is sufficient
                if ($stock->quantity >= $quantityChange) {
                    Cart::update($product->id, [
                        'quantity' => $product->quantity + $quantityChange
                    ]);
                    $stock->decrement('quantity', $quantityChange);
                    return response()->json(['success' => 'Quantité augmentée.']);
                } else {
                    return response()->json(['error' => 'Stock insuffisant.']);
                }
            } else if ($quantityChange < 0) {
                // Decrement quantity in cart if new quantity will remain valid
                $newQuantity = $product->quantity + $quantityChange;

                if ($newQuantity >= 0) {
                    Cart::update($product->id, [
                        'quantity' => $newQuantity
                    ]);
                    $stock->increment('quantity', -$quantityChange); // Re-add stock for negative delta
                    return response()->json(['success' => 'Quantité réduite.']);
                } else {
                    return response()->json(['error' => 'Quantité invalide.']);
                }
            }
        }

        return response()->json(['error' => 'Produit non trouvé dans le panier.']);
    }
    public function clearCart() {
        Cart::clear();
        return response()->json(['success' => 'Le panier a été vidé avec succès.']);
    }


    public function charge(Request $request) {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => 2000, // Amount in cents
            'currency' => 'usd',
            'source' => $request->stripeToken,
        ]);

        return response()->json(['status' => 'success']);
    }

    public function processPayment(Request $request)
    {
        // Valider la requête
        $request->validate([
            'stripeToken' => 'required',
        ]);

        // Configurer Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Créer une charge
            $charge = Charge::create([
                'amount' => Cart::getTotal() * 100, // Le montant total du panier en centimes
                'currency' => 'usd',
                'description' => 'Description de la commande',
                'source' => $request->stripeToken,
            ]);

            // Logique supplémentaire (ex : sauvegarder la commande dans la base de données)

            return back()->with('success', 'Paiement réussi!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function checkout(Request $request) {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Total Cart',
                    ],
                    'unit_amount' => Cart::getTotal() * 100, // Le montant total du panier en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        return view('', [
            'sessionId' => $session->id
        ]);
    }


}
