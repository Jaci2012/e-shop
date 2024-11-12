<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', action: [FrontController::class, 'index'])->name('front');
Route::get('/all-products', action: [FrontController::class, 'productsFront'])->name('all.products');
Route::get('/products/by-devise', [FrontController::class, 'getProductsByDevise'])->name('products.byDevise');
Route::post('/cart/clear', [FrontController::class, 'clearCart'])->name('cart.clear');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/payment', [FrontController::class, 'processPayment'])->name('payment.process');
// Page d'inscription
Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/register', [AccountController::class, 'storeRegister'])->name('register.store');

// Page de connexion
Route::get('/login', [AccountController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AccountController::class, 'storeLogin'])->name('login.store');

// Route pour déconnexion
Route::post('/logout', function () {
    Auth::logout(); // Déconnexion de l'utilisateur
    return redirect('/login')->with('success', 'Vous êtes déconnecté avec succès.');
})->name('logout');

//Users
Route::get('/users', [DashboardController::class, 'users'])->name('users.index');
// Modification d'un utilisateur
// Route::get('/users/{user}/edit', [DashboardController::class, 'editUser'])->name('users.edit');
// Route::put('/users/{user}', [DashboardController::class, 'updateUser'])->name('users.update');

// Suppression d'un utilisateur
Route::delete('/users/{user}', [DashboardController::class, 'destroyUser'])->name('users.destroy');
Route::put('/profile/update/{id}', [AccountController::class, 'update'])->name('profile.update');


// Catégories
Route::get('/categories', [DashboardController::class, 'categories'])->name('categories.index');
Route::get('/categories/add', [DashboardController::class, 'categoriesAdd'])->name('categories.add');
Route::post('/categories', [DashboardController::class, 'categoriesStore'])->name('categories.store');
Route::get('/categories/{category}/edit', [DashboardController::class, 'categoriesEdit'])->name('categories.edit');
Route::put('/categories/{category}', [DashboardController::class, 'categoriesUpdate'])->name('categories.update');
Route::delete('/categories/{category}', [DashboardController::class, 'categoriesDestroy'])->name('categories.destroy');

//TYPES
Route::get('/types', [DashboardController::class, 'types'])->name('types.index');
Route::get('/types/add', [DashboardController::class, 'typesAdd'])->name('types.add');
Route::get('/types/{type}/edit', [DashboardController::class, 'typesEdit'])->name('types.edit');
Route::post('/types', [DashboardController::class, 'typesStore'])->name('types.store');
Route::put('types/{type}', [DashboardController::class, 'typesUpdate'])->name('types.update');
Route::delete('types/{type}', [DashboardController::class, 'typesDestroy'])->name('types.destroy');

//VILLES
Route::get('/villes', [DashboardController::class, 'villes'])->name('villes.index');
Route::get('/villes/add', [DashboardController::class, 'villesAdd'])->name('villes.add');
Route::post('/villes', [DashboardController::class, 'villesStore'])->name('villes.store');
Route::get('/villes/{ville}/edit', [DashboardController::class, 'villesEdit'])->name('villes.edit');
Route::put('villes/{ville}', [DashboardController::class, 'villesUpdate'])->name('villes.update');
Route::delete('villes/{ville}', [DashboardController::class, 'villesDestroy'])->name('villes.destroy');

// Produits
Route::get('/produits', [DashboardController::class, 'produits'])->name('produits.index');
Route::get('/produits/add', [DashboardController::class, 'produitsAdd'])->name('produits.add');
Route::post('/produits', [DashboardController::class, 'produitsStore'])->name('produits.store');
Route::get('/produits/{produit}/edit', [DashboardController::class, 'produitsEdit'])->name('produits.edit');
Route::put('/produits/{produit}', [DashboardController::class, 'produitsUpdate'])->name('produits.update');
Route::delete('/produits/{produit}', [DashboardController::class, 'produitsDestroy'])->name('produits.destroy');

//ROLES
Route::get('/roles', [DashboardController::class, 'roles'])->name('roles.index');
Route::get('/roles/add', [DashboardController::class, 'rolesAdd'])->name('roles.add');
Route::post('/roles', [DashboardController::class, 'rolesStore'])->name('roles.store');
Route::get('/roles/{role}/edit', [DashboardController::class, 'rolesEdit'])->name('roles.edit');
Route::put('roles/{role}', [DashboardController::class, 'rolesUpdate'])->name('roles.update');
Route::delete('roles/{role}', [DashboardController::class, 'rolesDestroy'])->name('roles.destroy');

//CLIENTS
Route::get('/clients', [DashboardController::class, 'clients'])->name('clients.index');
Route::get('/clients/add', [DashboardController::class, 'clientsAdd'])->name('clients.add');
Route::post('/clients', [DashboardController::class, 'clientsStore'])->name('clients.store');
Route::get('/clients/{client}/edit', [DashboardController::class, 'clientsEdit'])->name('clients.edit');
Route::put('clients/{client}', [DashboardController::class, 'clientsUpdate'])->name('clients.update');
Route::delete('clients/{client}', [DashboardController::class, 'clientsDestroy'])->name('clients.destroy');

//VENDEURS
Route::get('/vendeurs', [DashboardController::class, 'vendeurs'])->name('vendeurs.index');
Route::get('/vendeurs/add', [DashboardController::class, 'vendeursAdd'])->name('vendeurs.add');
Route::post('/vendeurs', [DashboardController::class, 'vendeursStore'])->name('vendeurs.store');
Route::get('/vendeurs/{vendeur}/edit', [DashboardController::class, 'vendeursEdit'])->name('vendeurs.edit');
Route::put('vendeurs/{vendeur}', [DashboardController::class, 'vendeursUpdate'])->name('vendeurs.update');
Route::delete('vendeurs/{vendeur}', [DashboardController::class, 'vendeursDestroy'])->name('vendeurs.destroy');

//DEVICES
Route::get('/devices', [DashboardController::class, 'devices'])->name('devices.index');
Route::get('/devices/add', [DashboardController::class, 'devicesAdd'])->name('devices.add');
Route::post('/devices', [DashboardController::class, 'devicesStore'])->name('devices.store');
Route::get('/devices/{device}/edit', [DashboardController::class, 'devicesEdit'])->name('devices.edit');
Route::put('devices/{device}', [DashboardController::class, 'devicesUpdate'])->name('devices.update');
Route::delete('devices/{device}', [DashboardController::class, 'devicesDestroy'])->name('devices.destroy');

//TRANSPORTS
Route::get('/transports', [DashboardController::class, 'transports'])->name('transports.index');
Route::get('/transports/add', [DashboardController::class, 'transportsAdd'])->name('transports.add');
Route::post('/transports', [DashboardController::class, 'transportsStore'])->name('transports.store');
Route::get('/transports/{transport}/edit', [DashboardController::class, 'transportsEdit'])->name('transports.edit');
Route::put('transports/{transport}', [DashboardController::class, 'transportsUpdate'])->name('transports.update');
Route::delete('transports/{transport}', [DashboardController::class, 'transportsDestroy'])->name('transports.destroy');

//ventes
Route::get('/ventes', [DashboardController::class, 'ventes'])->name('ventes.index');
Route::get('/ventes/add', [DashboardController::class, 'ventesAdd'])->name('ventes.add');
Route::post('/ventes', [DashboardController::class, 'ventesStore'])->name('ventes.store');
Route::get('/ventes/{vente}/edit', [DashboardController::class, 'ventesEdit'])->name('ventes.edit');
Route::put('/ventes/{vente}', [DashboardController::class, 'ventesUpdate'])->name('ventes.update');
Route::delete('/ventes/{vente}', [DashboardController::class, 'ventesDestroy'])->name('ventes.destroy');


//Achats
Route::get('/achats', [DashboardController::class, 'achats'])->name('achats.index');
Route::get('/achats/add', [DashboardController::class, 'achatsAdd'])->name('achats.add');
Route::post('/achats', [DashboardController::class, 'achatsStore'])->name('achats.store');
Route::get('/achats/{achat}/edit', [DashboardController::class, 'achatsEdit'])->name('achats.edit');
Route::put('/achats/{achat}', [DashboardController::class, 'achatsUpdate'])->name('achats.update');
Route::delete('/achats/{achat}', [DashboardController::class, 'achatsDestroy'])->name('achats.destroy');


//Stocks
Route::get('/stocks', [DashboardController::class, 'stocks'])->name('stocks.index');
Route::get('/stocks/add', [DashboardController::class, 'stocksAdd'])->name('stocks.add');
Route::post('/stocks', [DashboardController::class, 'stocksStore'])->name('stocks.store');
Route::get('/stocks/{stock}/edit', [DashboardController::class, 'stocksEdit'])->name('stocks.edit');
Route::put('/stocks/{stock}', [DashboardController::class, 'stocksUpdate'])->name('stocks.update');
Route::delete('/stocks/{stock}', [DashboardController::class, 'stocksDestroy'])->name('stocks.destroy');


//Paniers
Route::post('/cart/add', [FrontController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [FrontController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/items', [FrontController::class, 'cartItems'])->name('cart.items');
Route::get('/cart/count', [FrontController::class, 'cartCount'])->name('cart.count');
Route::post('/cart/modify', [FrontController::class, 'modifyCartQuantity'])->name('cart.modify');
Route::post('/charge', [FrontController::class, 'charge'])->name('charge');

//Commandes
Route::get('/commandes', [DashboardController::class, 'commandes'])->name('commandes.index');
Route::get('/commandes/add', [DashboardController::class, 'commandesAdd'])->name('commandes.add');
Route::post('/commandes', [DashboardController::class, 'commandesStore'])->name('commandes.store');
Route::get('/commandes/{commande}/edit', [DashboardController::class, 'commandesEdit'])->name('commandes.edit');
Route::put('/commandes/{commande}', [DashboardController::class, 'commandesUpdate'])->name('commandes.update');
Route::delete('/commandes/{commande}', [DashboardController::class, 'commandesDestroy'])->name('commandes.destroy');

//Livraisons
Route::get('/livraisons', [DashboardController::class, 'livraisons'])->name('livraisons.index');
Route::get('/livraisons/add', [DashboardController::class, 'livraisonsAdd'])->name('livraisons.add');
Route::post('/livraisons', [DashboardController::class, 'livraisonsStore'])->name('livraisons.store');
Route::get('/livraisons/{livraison}/edit', [DashboardController::class, 'livraisonsEdit'])->name('livraisons.edit');
Route::put('/livraisons/{livraison}', [DashboardController::class, 'livraisonsUpdate'])->name('livraisons.update');
Route::delete('/livraisons/{livraison}', [DashboardController::class, 'livraisonsDestroy'])->name('livraisons.destroy');

//Paiements
Route::get('/paiements', [DashboardController::class, 'paiements'])->name('paiements.index');
Route::get('/paiements/add', [DashboardController::class, 'paiementsAdd'])->name('paiements.add');
Route::post('/paiements', [DashboardController::class, 'paiementsStore'])->name('paiements.store');
Route::get('/paiements/{paiement}/edit', [DashboardController::class, 'paiementsEdit'])->name('paiements.edit');
Route::put('/paiements/{paiement}', [DashboardController::class, 'paiementsUpdate'])->name('paiements.update');
Route::delete('/paiements/{paiement}', [DashboardController::class, 'paiementsDestroy'])->name('paiements.destroy');


Route::get('/paiements/{id}/facture', [DashboardController::class, 'generateFacture'])->name('paiements.facture');


