<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\Paiement;
use App\Models\Type;
use App\Models\Ville;
use App\Models\Product;
use App\Models\Role;
use App\Models\Stock;
use App\Models\Vendeur;
use App\Models\Transport;
use App\Models\User;
use App\Models\Vente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class DashboardController extends Controller {

    public function index() {
        $user = Auth::user();
        $role = $user->role; // Assurez-vous que la relation user-role est correctement configurée

        $data = [];

        switch ($role->role) {
            case 'Administrateur':
                $data = [
                    'categories' => Category::all(),
                    'types' => Type::all(),
                    'villes' => Ville::all(),
                    'roles' => Role::all(),
                    'clients' => Client::all(),
                    'vendeurs' => Vendeur::all(),
                    'produits' => Product::all(),
                    'ventes' => Vente::all(),
                    'commandes' => Commande::all(),
                    'achats' => Achat::all(),
                    'paiements' => Paiement::all(),
                    'devices' => Device::all(),
                    'stocks' => Stock::all(),
                    'transports' => Transport::all(),
                    'livraisons' => Livraison::all(),
                    'users' => User::all(),
                ];
                break;
            case 'Vendeur':
                $data = [
                    'profile' => $user,
                    'ventes' => Vente::where('vendeur_id', $user->id)->count(),
                    'produits' => Product::where('vendeur_id', $user->id)->count(),
                    'commandes' => Commande::where('vendeur_id', $user->id)->get(),
                    'stocks' => Stock::where('vendeur_id', $user->id)->get(),
                    'livraisons' => Livraison::where('vendeur_id', $user->id)->get(),
                ];
                break;
            case 'Acheteur':
                $data = [
                    'profile' => $user,
                    'achats' => Achat::where('clients_id', $user->id)->get(),
                    'commandes' => Commande::where('clients_id', $user->id)->get(),
                    'paiements' => Paiement::where('clients_id', $user->id)->get(),
                ];
                break;
            // Ajoutez d'autres rôles si nécessaire
        }

        return view('dashboard.index', compact('data', 'role'));
    }


    //Users
    public function users(Request $request)
    {
        // Récupère le terme de recherche de la requête
        $searchTerm = $request->input('search');

        // Récupère les utilisateurs avec leur rôle
        $query = User::with('role');

        // Si un terme de recherche est fourni, applique le filtre
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('role', function($query) use ($searchTerm) {
                    $query->where('role', 'like', '%' . $searchTerm . '%');
                });
            });
        }

        // Récupère les utilisateurs avec pagination
        $users = $query->paginate(10); // Par exemple, 10 utilisateurs par page

        return view('users.index', compact('users'));
    }

    // public function editUser(User $user)
    // {
    //     $roles = Role::all(); // Récupère tous les rôles pour le formulaire de modification
    //     return view('users.edit', compact('user', 'roles'));
    // }

    // public function updateUser(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255',
    //         'role_id' => 'required|exists:roles, id', // Assurez-vous que le rôle existe
    //     ]);

    //     $user->update($request->all());
    //     return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès.');
    // }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }


    // Catégories

    public function categories(Request $request) {
        // Récupère le terme de recherche de la requête
        $searchTerm = $request->input('search');

        // Récupère les catégories
        $query = Category::query();

        // Si un terme de recherche est fourni, applique le filtre
        if ($searchTerm) {
            $query->where('designation', 'like', '%' . $searchTerm . '%');
        }

        // Récupère les catégories avec pagination
        $categories = $query->paginate(10); // Par exemple, 10 catégories par page

        return view('categories.index', compact('categories'));
    }


    public function categoriesAdd() {
        return view( 'categories.add' );
    }

    public function categoriesStore( Request $request ) {
        $request->validate( [
            'designation' => 'required|unique:categories',
        ] );

        Category::create( $request->all() );
        return redirect()->route( 'categories.index' )->with( 'success', 'Catégorie créée avec succès.' );
    }

    public function categoriesEdit( Category $category ) {
        return view( 'categories.edit', compact( 'category' ) );
    }

    public function categoriesUpdate( Request $request, Category $category ) {
        $request->validate( [
            'designation' => 'required|unique:categories, designation, ' . $category->id,
        ] );

        $category->update( $request->all() );
        return redirect()->route( 'categories.index' )->with( 'success', 'Catégorie mise à jour avec succès.' );
    }

    public function categoriesDestroy( Category $category ) {
        $category->delete();
        return redirect()->route( 'categories.index' )->with( 'success', 'Catégorie supprimée avec succès.' );
    }


    //TYPES
    public function types() {
        $types = Type::paginate(10); // Récupère 10 types par page

        return view('types.index', compact('types'));
    }
    public function typesAdd() {
        return view( 'types.add' );
    }

    public function typesStore( Request $request ) {
        $request->validate( [
            'type' => 'required|unique:types',
        ] );

        Type::create( $request->all() );

        return redirect()->route( 'types.index' )->with( 'success', 'type créée avec succès.' );
    }

    public function typesEdit( Type $type ) {
        return view( 'types.edit', compact( 'type' ) );
    }

    public function typesUpdate( Request $request, Type $type ) {
        $request->validate( [
            'type' => 'required|unique:types, type, ' . $type->id,
        ] );

        $type->update( $request->all() );

        return redirect()->route( 'types.index' )->with( 'success', 'Type mise à jour avec succès.' );
    }

    public function typesDestroy( Type $type ) {
        $type->delete();

        return redirect()->route( 'types.index' )->with( 'success', 'Type supprimée avec succès.' );
    }


    //VILLES
    public function villes() {
        $villes = Ville::paginate(10); // Récupère 10 villes par page

        return view('villes.index', compact('villes'));
    }

    public function villesAdd() {
        return view( 'villes.add' );
    }

    public function villesStore( Request $request ) {
        $request->validate( [
            'name' => 'required|unique:villes',
            'cp' => 'required|unique:villes',
        ] );

        Ville::create( $request->all() );

        return redirect()->route( 'villes.index' )->with( 'success', 'ville créée avec succès.' );
    }

    public function villesEdit( Ville $ville ) {
        return view( 'villes.edit', compact( 'ville' ) );
    }

    public function villesUpdate( Request $request, Ville $ville ) {
        $request->validate( [
            'name' => 'required|unique:villes, name, ' . $ville->id,
            'cp' => 'required|unique:villes, cp, ' . $ville->id,
        ] );

        $ville->update( $request->all() );

        return redirect()->route( 'villes.index' )->with( 'success', 'Ville mise à jour avec succès.' );
    }

    public function villesDestroy( Ville $ville ) {
        $ville->delete();

        return redirect()->route( 'villes.index' )->with( 'success', 'Ville supprimée avec succès.' );
    }


    //ROLES
    public function roles() {
        $rols = Role::paginate(10);

        return view( 'roles.index', compact( 'rols' ) );
    }

    public function rolesAdd() {
        return view( 'roles.add' );
    }

    public function rolesStore( Request $request ) {
        $request->validate( [
            'role' => 'required|unique:roles',
        ] );

        Role::create( $request->all() );

        return redirect()->route( 'roles.index' )->with( 'success', 'role créée avec succès.' );
    }

    public function rolesEdit( Role $role ) {
        return view( 'roles.edit', compact( 'role' ) );
    }

    public function rolesUpdate( Request $request, Role $role ) {
        $request->validate( [
            'role' => 'required|unique:roles, role, ' . $role->id,
        ] );

        $role->update( $request->all() );

        return redirect()->route( 'roles.index' )->with( 'success', 'Role mise à jour avec succès.' );
    }

    public function rolesDestroy( Role $role ) {
        $role->delete();

        return redirect()->route( 'roles.index' )->with( 'success', 'Role supprimée avec succès.' );
    }


    //VENDEURS
    public function vendeurs() {
        // Utilisez 'clients' comme variable cohérente
        $vendeurs = Vendeur::with( 'role' )->paginate(10);
        // dump( $clients );

        return view( 'vendeurs.index', compact( 'vendeurs' ) );
    }

    public function vendeursAdd() {

        $roles = Role::all();
        // Récupérer tous les rôles

        return view( 'vendeurs.add', compact( 'roles' ) );
        // Passer les rôles à la vue
    }

    public function vendeursStore( Request $request ) {
        $validatedData = $request->validate( [
            'name' => 'required|unique:vendeurs',
            'adresse' => 'required',
            'numero' => 'required|unique:vendeurs',
            'email' => 'required|unique:vendeurs',
            'roles_id' => 'required|exists:roles, id',
        ] );

        // dump( $validatedData );
        // Créez le client avec les données validées
        Vendeur::create($validatedData);

        return redirect()->route('vendeurs.index')->with('success', 'Vendeurs créé avec succès.');
    }
    public function vendeursEdit(Vendeur $vendeur)
    {
        $roles = Role::all();

        // Envoyez le client et les rôles à la vue
        return view('vendeurs.edit', compact('vendeur', 'roles'));
    }

    public function vendeursUpdate(Request $request, Vendeur $vendeur)
    {
        $request->validate([
            'name' => 'required|unique:vendeurs, name, ' . $vendeur->id,
            'adresse' => 'required',
            'numero' => 'required|unique:vendeurs, numero, ' . $vendeur->id,
            'email' => 'required|unique:vendeurs, email, ' . $vendeur->id,
            'roles_id' => 'required|exists:roles, id',
        ]);


        $vendeur->update($request->all());

        return redirect()->route('vendeurs.index')->with('success', 'Vendeur mis à jour avec succès.');
    }
    public function vendeursDestroy(Vendeur $vendeur)
    {
        $vendeur->delete();

        return redirect()->route('vendeurs.index')->with('success', 'Vendeurs supprimée avec succès.');
    }


    //DEVICES
    public function devices()
    {
        $devices = Device::paginate(10);

        return view('devices.index', compact('devices'));
    }

    public function devicesAdd()
    {
        return view('devices.add');
    }

    public function devicesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:devices',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')->with('success', 'Device créée avec succès.');
    }

    public function devicesEdit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function devicesUpdate(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|unique:devices, name, ' . $device->id,
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')->with('success', 'Devices mise à jour avec succès.');
    }

    public function devicesDestroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Devices supprimée avec succès.');
    }


    // TRANSPORTS
    public function transports()
    {
        $transports = Transport::paginate(10); // Changez transport en transports

        return view('transports.index', compact('transports')); // Assurez-vous de passer la variable avec le même nom
    }

    public function transportsAdd()
    {
        $villes = Ville::all();
        return view('transports.add', compact('villes'));
    }

    public function transportsStore(Request $request) {
        $request->validate([
            'type' => 'required',
            'vehicule' => 'required',
            'villes_id' => 'required|exists:villes, id', // Valider que villes_id existe dans la table villes
        ]);

        Transport::create($request->all());

        return redirect()->route('transports.index')->with('success', 'Transport créé avec succès.');
    }

    public function transportsEdit(Transport $transport)
    {
        $villes = Ville::all();
        return view('transports.edit', compact('transport', 'villes'));
    }

    public function transportsUpdate(Request $request, Transport $transport) {
        $request->validate([
            'type' => 'required',
            'vehicule' => 'required',
            'villes_id' => 'required|exists:villes, id', // Valider que villes_id existe dans la table villes
        ]);

        $transport->update($request->all());

        return redirect()->route('transports.index')->with('success', 'Transport mis à jour avec succès.');
    }

    public function transportsDestroy(Transport $transport)
    {
        $transport->delete();

        return redirect()->route('transports.index')->with('success', 'Transport supprimée avec succès.');
    }


    //CLIENTS
    public function clients()
    {
        // Utilisez 'clients' comme variable cohérente
        $clients = Client::with('role')->paginate(10);
        // dump($clients);die;
        return view('clients.index', compact('clients'));
    }

    public function clientsAdd()
    {

        $roles = Role::all(); // Récupérer tous les rôles


        return view('clients.add', compact('roles')); // Passer les rôles à la vue
    }

    public function clientsStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:clients',
            'adresse' => 'required',
            'numero' => 'required|unique:clients',
            'email' => 'required|unique:clients',
            'roles_id' => 'required|exists:roles, id',
        ]);

        // Créez le client avec les données validées
        Client::create($request->only(['name', 'adresse', 'numero', 'email', 'roles_id']));
        return redirect()->route( 'clients.index' )->with( 'success', 'Client créé avec succès.' );
    }

    public function clientsEdit( Client $client ) {
        $roles = Role::all();

        // Envoyez le client et les rôles à la vue
        return view( 'clients.edit', compact( 'client', 'roles' ) );
    }

    public function clientsUpdate( Request $request, Client $client ) {
        $request->validate( [
            'name' => 'required|unique:clients, name, ' . $client->id,
            'adresse' => 'required',
            'numero' => 'required|unique:clients, numero, ' . $client->id,
            'email' => 'required|unique:clients, email, ' . $client->id,
            'roles_id' => 'required|exists:roles, id',
        ] );

        $client->update($request->only(['name', 'adresse', 'numero', 'email', 'roles_id']));
        return redirect()->route( 'clients.index' )->with( 'success', 'Client mis à jour avec succès.' );
    }

    public function clientsDestroy( Client $client ) {
        $client->delete();

        return redirect()->route( 'clients.index' )->with( 'success', 'Client supprimée avec succès.' );
    }


    //Produits
    public function produits() {
        $user = Auth::user();
        $products = Product::with(['category', 'type', 'devise'])
                    ->where('vendeur_id', $user->id)
                    ->paginate(10); // Utiliser paginate(10) pour la pagination

        return view('produits.index', compact('products'));
    }


    public function produitsAdd() {
        $categories = Category::all();
        // Récupérer toutes les catégories
        $types = Type::all();
        // Récupérer tous les types
        $devices = Device::all();
        return view( 'produits.add', compact( 'categories', 'types', 'devices' ) );
    }

    public function produitsStore(Request $request) {
        $request->validate([
            'desc' => 'required|unique:products',
            'name' => 'required|unique:products',
            'prixUnit' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'type_id' => 'required|exists:types,id',
            'devise_id' => 'required|exists:devices,id',
            'image' => 'required|image|mimes:jpeg, png, jpg, gif, svg, webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image/products', 'public');

            Product::create([
                'desc' => $request->desc,
                'name' => $request->name,
                'prixUnit' => $request->prixUnit,
                'category_id' => $request->category_id,
                'type_id' => $request->type_id,
                'devise_id' => $request->devise_id,
                'image' => $path,
                'vendeur_id' => Auth::id(), // Assigner l'ID du vendeur connecté
        ] );
    }

    return redirect()->route( 'produits.index' )->with( 'success', 'Produit créé avec succès.' );
}

public function produitsEdit( $id ) {
    $produit = Product::findOrFail( $id );
    $categories = Category::all();
    // Récupérer toutes les catégories
    $types = Type::all();
    // Récupérer tous les types
    $devices = Device::all();
    return view( 'produits.edit', compact( 'produit', 'categories', 'types', 'devices' ) );
}

public function produitsUpdate( Request $request, $id ) {
    $produit = Product::findOrFail( $id );

    $request->validate( [
        'desc' => 'nullable|unique:products,desc,' . $id,
        'name' => 'nullable|unique:products,name,' . $id,
        'prixUnit' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'type_id' => 'required|exists:types,id',
        'devise_id' => 'required|exists:devices,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ] );

    $data = $request->only( [ 'desc', 'prixUnit', 'category_id', 'type_id', 'devise_id', 'name' ] );

    if ( $request->hasFile( 'image' ) ) {
        $file = $request->file( 'image' );
        $path = $file->store( 'image/products', 'public' );
        $data[ 'image' ] = $path;
    }

    $produit->update( $data );

    return redirect()->route( 'produits.index' )->with( 'success', 'Produit modifié avec succès.' );
}

public function produitsDestroy( $id ) {
    $produit = Product::findOrFail( $id );
    $produit->delete();
    return redirect()->route( 'produits.index' )->with( 'success', 'Produit supprimé avec succès.' );
}

// Ventes

public function ventes() {
    $user = Auth::user();

    $ventes = Vente::with( [ 'produit.devise', 'client' ] )
              ->where('vendeur_id', $user->id)
              ->paginate( 10 );

    return view( 'ventes.index', compact( 'ventes' ) );
}

public function ventesAdd() {
    $clients = Client::all();
    // Récupère tous les clients
    $produits = Product::all();
    // Récupère tous les produits
    return view( 'ventes.add', compact( 'clients', 'produits' ) );
}

public function ventesStore( Request $request ) {
    $request->validate( [
        'clients_id' => 'required|exists:clients,id',
        'products_id' => 'required|exists:products,id',
        // Validation pour products_id

    ] );

    Vente::create( $request->all());

    return redirect()->route( 'ventes.index' )->with( 'success', 'Vente créée avec succès.' );
}

// Afficher le formulaire pour modifier une vente

public function ventesEdit( Vente $vente ) {
    $clients = Client::all();
    // Récupérer la liste des clients
    $produits = Product::all();
    // Récupérer la liste des produits
    return view( 'ventes.edit', compact( 'vente', 'clients', 'produits' ) );
}

// Mettre à jour une vente

public function ventesUpdate( Request $request, Vente $vente ) {
    // Valider la quantité et le clients_id
    $request->validate( [
        'clients_id' => 'required|exists:clients,id',  // Valider que le client existe
        'products_id' => 'required|exists:products,id', // Validation pour products_id
    ] );

    // Mettre à jour la vente avec les nouvelles données
    $vente->update( $request->all() );

    return redirect()->route( 'ventes.index' )->with( 'success', 'Vente mise à jour avec succès.' );
}

public function ventesDestroy( Vente $vente ) {
    $vente->delete();
    // Supprime la vente de la base de données
    return redirect()->route( 'ventes.index' )->with( 'success', 'Vente supprimée avec succès.' );
}

//Achats

public function achats() {
    $achats = Achat::with( [ 'produit.devise', 'client' ] )->paginate( 10 );
    // Par exemple, pour paginer 10 achats par page
    return view( 'achats.index', compact( 'achats' ) );

}

// Afficher le formulaire pour ajouter un nouvel achat

public function achatsAdd() {
    $produits = Product::all();
    $clients = Client::all();
    // Récupérer tous les produits pour le formulaire
    return view( 'achats.add', compact( 'produits', 'clients' ) );
}

// Stocker un nouvel achat

public function achatsStore( Request $request ) {
    $request->validate( [
        'products_id' => 'required|exists:products,id',
        'clients_id' => 'required|exists:clients,id',
        'quantity' => 'required|integer|min:1',

    ] );

    $product = Product::find( $request->products_id );
    $stock = Stock::where( 'product_id', $product->id )->first();

    if ( $stock && $stock->quantity >= $request->quantity ) {
        // Réduction du stock disponible
        $stock->quantity -= $request->quantity;
        $stock->save();

        // Enregistrement de l'achat
            Achat::create([
                'products_id' => $request->products_id,
                'clients_id' => $request->clients_id,
                'quantity' => $request->quantity,

            ]);

            return redirect()->route('achats.index')->with('success', 'Achat ajouté avec succès et stock mis à jour.');
        } else {
            // Message d'erreur si le stock est insuffisant
        return redirect()->back()->with( 'error', 'Quantité demandée non disponible en stock.' );
    }
}

// Afficher le formulaire pour éditer un achat

public function achatsEdit( Achat $achat ) {
    $produits = Product::all();
    $clients = Client::all();
    // Récupérer tous les produits pour le formulaire
    return view( 'achats.edit', compact( 'achat', 'produits', 'clients' ) );
}

// Mettre à jour un achat existant

public function achatsUpdate( Request $request, Achat $achat ) {
    $request->validate( [
        'products_id' => 'required|exists:products,id', // Validation pour s'assurer que le produit existe
            'clients_id' => 'required|exists:clients, id',
            'quantity' => 'required|integer|min:1', // Validation pour la quantité

        ] );

        $achat->update( $request->all() );
        // Mettre à jour l'achat avec les données du formulaire
        return redirect()->route( 'achats.index' )->with( 'success', 'Achat mis à jour avec succès.' );
    }

    // Supprimer un achat

    public function achatsDestroy( Achat $achat ) {
        $achat->delete();
        // Supprimer l'achat
        return redirect()->route( 'achats.index' )->with( 'success', 'Achat supprimé avec succès.' );
    }



    //Stocks
    public function stocks() {
        $stocks = Stock::with( 'produit' )->paginate( 10 );
        // Pagination des stocks
        return view( 'stocks.index', compact( 'stocks' ) );
    }

    // Afficher le formulaire pour ajouter un nouveau stock

    public function stocksAdd() {
        $produits = Product::all();
        // Récupérer tous les produits pour le formulaire
        return view( 'stocks.add', compact( 'produits' ) );
    }

    // Stocker un nouveau stock
    public function stocksStore( Request $request ) {
        $request->validate( [
                'product_id' => 'required|exists:products, id', // Validation pour s'assurer que le produit existe
        'quantity' => 'required|integer|min:1', // Validation pour la quantité
        'date_entry' => 'required|date', // Validation pour la date
    ] );

    Stock::create( $request->all() );
    // Créer un nouveau stock avec les données du formulaire
    return redirect()->route( 'stocks.index' )->with( 'success', 'Stock ajouté avec succès.' );
}

// Afficher le formulaire pour éditer un stock

public function stocksEdit( Stock $stock ) {
    $produits = Product::all();
    // Récupérer tous les produits pour le formulaire
    return view( 'stocks.edit', compact( 'stock', 'produits' ) );
}

// Mettre à jour un stock existant

public function stocksUpdate( Request $request, Stock $stock ) {
    $request->validate( [
        'product_id' => 'required|exists:products,id', // Enlever l'espace ici
                'quantity' => 'required|integer|min:1', // Validation pour la quantité
                'date_entry' => 'required|date', // Validation pour la date
            ]);

            $stock->update($request->all()); // Mettre à jour le stock avec les données du formulaire

            return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
        }

    // Supprimer un stock

    public function stocksDestroy( Stock $stock ) {
        $stock->delete();
        // Supprimer le stock
        return redirect()->route( 'stocks.index' )->with( 'success', 'Stock supprimé avec succès.' );
    }


    // Commandes
    // Afficher la liste des commandes
    public function commandes()
    {
        $commandes = Commande::paginate(10);
        return view('commandes.index', compact('commandes'));
    }

    // Afficher le formulaire d'ajout d'une nouvelle commande
    public function commandesAdd()
    {
        $vendeurs = Vendeur::all();
        $produits = Product::all();
        $clients = Client::all(); // Récupérer tous les clients
        return view('commandes.add', compact('produits', 'vendeurs', 'clients'));
    }


    // Enregistrer une nouvelle commande
    public function commandesStore(Request $request)
    {
        // Validation des données
        $request->validate([
            'dateCommande' => 'required|date',
            'statusCommande' => 'required|string|max:255',
            'products_id' => 'required|exists:products, id',
            'vendeur_id' => 'required|exists:vendeurs, id',
            'clients_id' => 'required|exists:clients, id', // Validation pour clients_id
        ]);

        // Création de la commande
        Commande::create([
            'dateCommande' => $request->dateCommande,
            'statusCommande' => $request->statusCommande,
            'products_id' => $request->products_id,
            'vendeur_id' => $request->vendeur_id,
            'clients_id' => $request->clients_id, // Inclure clients_id
        ]);

        return redirect()->route('commandes.index')->with('success', 'Commande ajoutée avec succès');
    }


    // Afficher le formulaire d'édition d'une commande
    public function commandesEdit(Commande $commande)
    {
        $vendeurs = Vendeur::all();
        $produits = Product::all();
        $clients = Client::all(); // Récupérer tous les clients pour l'édition
        return view( 'commandes.edit', compact( 'commande', 'produits', 'vendeurs', 'clients' ) );
    }

    // Mettre à jour une commande

    public function commandesUpdate( Request $request, Commande $commande ) {
        // Validation des données
        $request->validate( [
            'dateCommande' => 'required|date',
            'statusCommande' => 'required|string|max:255',
            'products_id' => 'required|exists:products,id',
            'vendeur_id' => 'required|exists:vendeurs,id',
            'clients_id' => 'required|exists:clients,id', // Validation pour clients_id
        ] );

        // Mise à jour de la commande
        $commande->update( [
            'dateCommande' => $request->dateCommande,
            'statusCommande' => $request->statusCommande,
            'products_id' => $request->products_id,
            'vendeur_id' => $request->vendeur_id,
            'clients_id' => $request->clients_id, // Inclure clients_id
        ] );

        return redirect()->route( 'commandes.index' )->with( 'success', 'Commande mise à jour avec succès' );
    }

    // Supprimer une commande

    public function commandesDestroy( Commande $commande ) {
        $commande->delete();
        return redirect()->route( 'commandes.index' )->with( 'success', 'Commande supprimée avec succès' );
    }

    //Livraison

    public function livraisons() {
        $livraisons = Livraison::paginate( 10 );
        return view( 'livraisons.index', compact( 'livraisons' ) );
    }

    public function livraisonsAdd() {
        $produits = Product::all();
        $clients = Client::all();
        $villes = Ville::all();
        $transports = Transport::all();
        return view( 'livraisons.add', compact( 'produits', 'clients', 'villes', 'transports' ) );
    }

    public function livraisonsStore( Request $request ) {
        $request->validate( [
            'dateLivraison' => 'required|date',
            'statusLivraison' => 'required|string|max:255',
            'products_id' => 'required|exists:products,id',
            'clients_id' => 'required|exists:clients,id',
            'villes_id' => 'required|exists:villes,id',
            'transports_id' => 'required|exists:transports,id',

        ] );

        Livraison::create( [
            'dateLivraison' => $request->dateLivraison,
            'statusLivraison' => $request->statusLivraison,
            'products_id' => $request->products_id,
            'clients_id' => $request->clients_id,
            'villes_id' => $request->villes_id,
            'transports_id' => $request->transports_id,
        ] );
        return redirect()->route( 'livraisons.index' )->with( 'success', 'Livraison ajoutée avec succès' );
    }

    public function livraisonsEdit( Livraison $livraison ) {
        $produits = Product::all();
        $clients = Client::all();
        $villes = Ville::all();
        $transports = Transport::all();
        return view( 'livraisons.edit', compact( 'livraison', 'produits', 'clients', 'villes', 'transports' ) );
    }

    public function livraisonsUpdate( Request $request, Livraison $livraison ) {
        $request->validate( [
            'dateLivraison' => 'required|date',
            'statusLivraison' => 'required|string|max:255',
            'products_id' => 'required|exists:products,id',
            'clients_id' => 'required|exists:clients,id',
            'villes_id' => 'required|exists:villes,id',
            'transports_id' => 'required|exists:transports,id',

        ] );

        $livraison->update( [
            'dateLivraison' => $request->dateLivraison,
            'statusLivraison' => $request->statusLivraison,
            'products_id' => $request->products_id,
            'clients_id' => $request->clients_id,
            'villes_id' => $request->villes_id,
            'transports_id' => $request->transports_id,

        ] );

        return redirect()->route( 'livraisons.index' )->with( 'success', 'Livraison mise à jour avec succès' );
    }

    public function livraisonsDestroy( Livraison $livraison ) {
        $livraison->delete();
        return redirect()->route( 'livraisons.index' )->with( 'success', 'Livraison supprimée avec succès' );
    }

    //Paiements

    public function paiements() {
        $payements = Paiement::with( [ 'produit.devise', 'achat' ] )->paginate( 10 );
        return view( 'paiements.index', compact( 'payements', ) );
    }

    public function paiementsAdd() {
        $produits = Product::all();
        $clients = Client::all();
        $achats = Achat::all();
        return view( 'paiements.add', compact( 'produits', 'clients', 'achats' ) );
    }

    public function paiementsStore( Request $request ) {
        $request->validate( [
            'datePaiement' => 'required|date',
            'statusPaiement' => 'required|string|max:255',
            'products_id' => 'required|exists:products,id',
            'clients_id' => 'required|exists:clients,id',
            'achats_id' => 'required|exists:achats,id',

        ] );

        Paiement::create( [
            'datePaiement' => $request->datePaiement,
            'statusPaiement' => $request->statusPaiement,
            'products_id' => $request->products_id,
            'clients_id' => $request->clients_id,
            'achats_id' => $request->achats_id,
        ] );
        return redirect()->route( 'paiements.index' )->with( 'success', 'Paiements ajoutée avec succès' );
    }

    public function paiementsEdit( Paiement $paiement ) {
        $produits = Product::all();
        $clients = Client::all();
        $achats = Achat::all();
        return view( 'paiements.edit', compact( 'paiement', 'produits', 'clients', 'achats' ) );
    }

    public function paiementsUpdate( Request $request, Paiement $paiement ) {
        $request->validate( [
            'datePaiement' => 'required|date',
            'statusPaiement' => 'required|string|max:255',
            'products_id' => 'required|exists:products,id',
            'clients_id' => 'required|exists:clients,id',
            'achats_id' => 'required|exists:achats,id',
        ] );

        $paiement->update( [
            'datePaiement' => $request->datePaiement,
            'statusPaiement' => $request->statusPaiement,
            'products_id' => $request->products_id,
            'clients_id' => $request->clients_id,
            'achats_id' => $request->achats_id,

        ] );

        return redirect()->route( 'paiements.index' )->with( 'success', 'Paiement mise à jour avec succès' );
    }

    public function paiementsDestroy( Paiement $paiement ) {
        $paiement->delete();
        return redirect()->route( 'paiements.index' )->with( 'success', 'Paiement supprimée avec succès' );
    }

    public function generateFacture( $id ) {
        // Récupérer le paiement par ID
        $paiement = Paiement::findOrFail( $id );

        // Récupérer l'achat et le produit associés
        $achat = $paiement->achat;
        $produit = $paiement->produit;

        // Vérifier si l'achat et le produit sont disponibles
        $quantite = $achat ? $achat->quantity : 0;
        $prixUnitaire = $produit ? $produit->prixUnit : 0;
        $totalPaiement = $quantite * $prixUnitaire;
        $devise = $produit && $produit->devise ? $produit->devise->name : 'Pas de devise';

        // Récupérer l'email et l'adresse du client
        $client = $paiement->client;
        $emailClient = $client ? $client->email : 'Email non disponible';
        $adresseClient = $client ? $client->adresse : 'Adresse non disponible';

        // Charger la vue et générer le PDF
        $pdf = PDF::loadView( 'paiements.facture', compact( 'paiement', 'produit', 'quantite', 'prixUnitaire', 'totalPaiement', 'devise', 'emailClient', 'adresseClient' ) );

        return $pdf->download( 'facture-paiement.pdf' );
    }

}
