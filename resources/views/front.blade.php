<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shop</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
        .product-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s ease;
        }

        .product-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Une nuance plus sombre pour l'effet de survol */
        }

        .account-circle {
            display: inline-block;
            width: 15px;
            height: 15px;
            line-height: 15px;
            border-radius: 50%;
            background-color: #fe980f;
            /* Changez cette couleur si nécessaire */
            color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .modal-footer .btn {
            margin-right: 10px;
        }

        .modal-footer .btn:last-child {
            margin-right: 0;
        }
    </style>
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +261 45 102 68</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> shop@contact.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DEVISES
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" id="devise-dropdown">
                                    @foreach ($devises as $devise)
                                        <li><a href="#" class="devise-item" data-id="{{ $devise->id }}">{{ $devise->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @auth
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="account-circle">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div> <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('dashboard') }}"><i class="fa fa-user"></i> Profile</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                                            <li> <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i> Logout </a> </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;"> @csrf </form>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                                @endauth
                                <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#cartModal">
                                        <i class="fa fa-shopping-cart"></i> Cart <span id="cart-count">{{ Cart::getContent()->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('front')}}" class="active">Acceuil</a></li>
                                <li><a href="{{ route('all.products')}}" class="">Produits</a></li>

                                <!-- Modal du panier -->

                                <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cartModalLabel">Votre Panier</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group" id="cart-items">
                                                    <!-- Les articles du panier seront ajoutés ici via AJAX -->
                                                </ul>
                                                <div class="mt-3">
                                                    <h4>Total : <span id="cart-total">0</span></h4>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-danger" id="clear-cart">Vider</button><br><br>
                                                <form action="{{ route('payment.process') }}" method="POST">
                                                    @csrf
                                                    <script
                                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                        data-key="{{ env('STRIPE_KEY') }}"
                                                        data-amount="{{ Cart::getTotal() * 100 }}"
                                                        data-name="Total Cart"
                                                        data-description="Description de la commande"
                                                        data-currency="usd"
                                                        data-locale="auto">
                                                    </script>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <li><a href="contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search" />
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <p>Bonjour le Monde ! Bienvenue dans votre supermarché préféré, le plus populaire
                                        grâce à la qualité exceptionnelle de nos produits de marque. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png" class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <p>Bonjour le Monde ! Bienvenue dans votre supermarché préféré, le plus populaire
                                        grâce à la qualité exceptionnelle de nos produits de marque. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png" class="pricing" alt="" />
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <p>Bonjour le Monde ! Bienvenue dans votre supermarché préféré, le plus populaire
                                        grâce à la qualité exceptionnelle de nos produits de marque. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png" class="pricing" alt="" />
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Categories de produits</h2>

                        <div class="panel-group category-products" id="accordian"><!--category-products-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-pills nav-stacked">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="#" style="color: black;">
                                                    <!-- Ajoutez ici le style pour la couleur -->
                                                    {{ $category->designation }}
                                                    <span class="pull-right">({{ $category->products_count }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div><!--/category-products-->


                        <div class="brands_products"><!--brands_products-->
                            <h2>Types de produits</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($types as $type)
                                        <li><a href="#"> <span class="pull-right">({{ $type->products_count }})</span>{{ $type->type }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->


                        {{-- <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                    id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range--> --}}

                        <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->

                    </div>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">Image du produit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="" id="modalImage" class="img-fluid" alt="Image du produit" width="150px">
                                <h4 id="modalProductName"></h4>
                                <p id="modalProductDesc"></p>
                                <p><strong>Prix: </strong><span id="modalProductPrice"></span></p>
                                <p><strong>Stock: </strong><span id="modalProductStock"></span></p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">NOS PRODUITS</h2>
                        <div class="row">
                            @foreach ($products->random(3) as $product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper {{ $product->stock ? '' : 'out-of-stock' }}">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" width="100"
                                                     data-toggle="modal" data-target="#imageModal"
                                                     data-src="{{ asset('storage/' . $product->image) }}"
                                                     data-name="{{ $product->name }}"
                                                     data-desc="{{ $product->desc }}"
                                                     data-price="{{ $product->prixUnit }} {{ $product->devise ? ($product->devise->name == 'Ariary' ? 'Ar' : ($product->devise->name == 'Euro' ? '€' : ($product->devise->name == 'Dollars' ? '$' : $product->devise->name))) : 'Pas de devise' }}"
                                                     data-stock="{{ $product->stock ? $product->stock->quantity : 'Non disponible' }}">
                                                <h2>{{ $product->prixUnit }}
                                                    {{ $product->devise ? ($product->devise->name == 'Ariary' ? 'Ar' : ($product->devise->name == 'Euro' ? '€' : ($product->devise->name == 'Dollars' ? '$' : $product->devise->name))) : 'Pas de devise' }}
                                                </h2>
                                                <p>{{ $product->name }}</p>
                                                <div class="product-card">
                                                    <a href="#" class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">
                                                        <i class="fa fa-shopping-cart"></i> Ajouter au panier
                                                    </a>
                                                    <div class="stock-info mt-2">
                                                        @if ($product->stock)
                                                            <span class="badge bg-success">Stock disponible : {{ $product->stock->quantity }}</span>
                                                        @else
                                                            <span class="badge bg-danger">Stock non disponible</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="modal fade" id="stockAlertModal" tabindex="-1" aria-labelledby="stockAlertModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="stockAlertModalLabel">
                                            <i class="fa fa-times-circle text-danger"></i> Stock non disponible
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <center>
                                            <h5>Ce produit est actuellement en rupture de stock.</h5>
                                            <p>Veuillez patienter...</p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="text-center mt-4">
                            <a href="{{ route('all.products') }}" class="btn btn-primary">Plus de produits</a>
                        </div>
                        <br>
                        <br>

                    </div><!--features_items-->

                    <div class="category-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @foreach ($categories as $index => $category)
                                    <li class="{{ $index == 0 ? 'active' : '' }}">
                                        <a href="#{{ Str::slug($category->designation) }}" data-toggle="tab">{{ $category->designation }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @foreach ($categories as $index => $category)
                                <div class="tab-pane fade {{ $index == 0 ? 'active in' : '' }}" id="{{ Str::slug($category->designation) }}">
                                    @if ($category->products->isEmpty())
                                    <center>

                                        <p>Pas de produits dans cette catégorie</p>
                                    </center>
                                    @else
                                        @foreach ($category->products as $product)
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" />
                                                            <h2>{{ $product->prixUnit }}
                                                                {{ $product->devise ? ($product->devise->name == 'Ariary' ? 'Ar' : ($product->devise->name == 'Euro' ? '€' : ($product->devise->name == 'Dollars' ? '$' : $product->devise->name))) : 'Pas de devise' }}
                                                            </h2>
                                                            <p>{{ $product->name }}</p>
                                                            <a href="#" class="btn btn-default add-to-cart" data-id="{{ $product->id }}">
                                                                <i class="fa fa-shopping-cart"></i> Ajouter au panier
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div><!--/category-tab-->



                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Produits recommander</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recommendedProducts->chunk(3) as $chunk)
                                    <div class="item {{ $loop->first ? 'active' : '' }}">
                                        @foreach ($chunk as $product)
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" />
                                                            <h2>{{ $product->prixUnit }}
                                                                {{ $product->devise ? ($product->devise->name == 'Ariary' ? 'Ar' : ($product->devise->name == 'Euro' ? '€' : ($product->devise->name == 'Dollars' ? '$' : $product->devise->name))) : 'Pas de devise' }}
                                                            </h2>
                                                            <p>{{ $product->name }}</p>
                                                            <a href="#" class="btn btn-default add-to-cart" data-id="{{ $product->id }}">
                                                                <i class="fa fa-shopping-cart"></i> Ajouter au panier
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->


                </div>
            </div>
        </div>
    </section>

    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="images/home/iframe1.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="images/home/iframe2.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="images/home/iframe3.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="images/home/iframe4.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2024 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Tsimanary</a></span></p>
                </div>
            </div>
        </div>

    </footer><!--/Footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>

    <script>
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var imageSrc = button.data('src');
            var productName = button.data('name');
            var productDesc = button.data('desc');
            var productPrice = button.data('price');
            var productStock = button.data('stock');

            var modal = $(this);
            modal.find('#modalImage').attr('src', imageSrc);
            modal.find('#modalProductName').text(productName);
            modal.find('#modalProductDesc').text(productDesc);
            modal.find('#modalProductPrice').text(productPrice);
            modal.find('#modalProductStock').text(productStock);
        });
    </script>


    <script>
        var stripe = Stripe(
            'pk_test_51QAtv8KbAB1O0df1mZqno9FLPvS9V9YDVcWO379ZeNfUr0Hc6A6P9skFXVSoXhG4D8PcaT5R0W5UQ3oaZ7Nicu7c00XkNl75I8'
        );
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-button');

        card.addEventListener('change', function(event) {
            var elements = stripe.elements();
            var card = elements.create('card');
            card.mount('#card-button');
            document.querySelector('input[name=stripeToken]').value = card.id;
        });
    </script>

    <script>
        document.querySelector('#card-button').addEventListener('click', function(e) {
            e.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.querySelector('#card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    var form = document.querySelector('#payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>


<script>
    $(document).ready(function() {
        function updateCartCount() {
            $.ajax({
                url: '{{ route("cart.count") }}',
                method: 'GET',
                success: function(data) {
                    $('#cart-count').text(data.count);
                }
            });
        }

        function updateCartItems() {
            $.ajax({
                url: '{{ route("cart.items") }}',
                method: 'GET',
                success: function(data) {
                    if (data && Array.isArray(data.items)) {
                        var items = data.items;
                        var total = data.total;
                        var $cartItems = $('#cart-items');
                        $cartItems.empty();

                        items.forEach(function(item) {
                            var listItem = `
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('storage/') }}/` + item.attributes.image + `" width="50" alt="Image du produit">
                                    <span>` + item.name + `</span>
                                    <span>` + item.price + ` ` + item.attributes.devise + `</span>
                                    <span>x ` + item.quantity + `</span>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-danger modify-quantity" data-id="` + item.id + `" data-delta="-1">-</button>
                                        <span class="mx-2">` + item.quantity + `</span>
                                        <button class="btn btn-sm btn-success modify-quantity" data-id="` + item.id + `" data-delta="1">+</button>
                                    </div>
                                </li>
                            `;
                            $cartItems.append(listItem);
                        });

                        $('#cart-total').text(total);
                    } else {
                        $('#cart-message').html('<div class="alert alert-danger">Erreur lors de la récupération des articles du panier.</div>');
                    }
                },
                error: function() {
                    $('#cart-message').html('<div class="alert alert-danger">Erreur lors de la récupération des articles du panier.</div>');
                }
            });
        }

        $('.add-to-cart').click(function(e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            var quantity = 1;

            $.ajax({
                url: '{{ route("cart.add") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        $('#cart-message').html('<div class="alert alert-success">' + response.success + '</div>');
                        updateCartCount();
                        updateCartItems();
                        $('#cartModal').modal('show'); // Afficher la modal du panier après l'ajout au panier
                    } else if (response.error && response.error === 'Stock insuffisant') {
                        $('#stockAlertModal').modal('show'); // Afficher la modal d'alerte pour le stock insuffisant
                    } else {
                        $('#cart-message').html('<div class="alert alert-danger">' + response.error + '</div>');
                    }
                },
                error: function() {
                    $('#cart-message').html('<div class="alert alert-danger">Erreur lors de l\'ajout au panier.</div>');
                }
            });
        });

        $('#cartModal').on('show.bs.modal', function() {
            updateCartItems();
        });

        $(document).on('click', '.modify-quantity', function(e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            var delta = $(this).data('delta');

            $.ajax({
                url: '{{ route("cart.modify") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    delta: delta
                },
                success: function(response) {
                    if (response.success) {
                        $('#cart-message').html('<div class="alert alert-success">' + response.success + '</div>');
                        updateCartCount();
                        updateCartItems();
                    } else {
                        $('#cart-message').html('<div class="alert alert-danger">' + response.error + '</div>');
                    }
                },
                error: function() {
                    $('#cart-message').html('<div class="alert alert-danger">Erreur lors de la modification de la quantité.</div>');
                }
            });
        });
    });
</script>



</body>

</html>
