<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Acceuil</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('dash/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dash/assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('dash/assets/images/favicon.png') }}" />
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        <!-- <img src="{{ asset('dash/assets/images/logo.svg') }}" alt="logo" /> -->
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <!-- <img src="{{ asset('dash/assets/images/logo-mini.svg') }}" alt="logo" /> -->
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text text-primary">
                            Bienvenue,
                            <span class="text-black fw-bold">{{ Auth::user()->name }}</span>
                        </h1>
                        <h3 class="welcome-sub-text text-muted">
                            Profitez de votre journée !
                        </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">


                    <!-- <li class="nav-item">
              <form class="search-form" action="#">
                <i class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
              </form>
            </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-mail icon-lg"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset('dash/assets/images/faces/face8.jpg') }}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle"
                                    src="{{ asset('dash/assets/images/faces/face8.jpg') }}" alt="Profile image">
                                <!-- Afficher le nom de l'utilisateur connecté -->
                                <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->name }}</p>
                                <!-- Afficher l'email de l'utilisateur connecté -->
                                <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                            <a class="dropdown-item">
                                <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mon Profile
                                <span class="badge badge-pill badge-danger">1</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Deconnexion
                            </a>

                            <!-- Formulaire pour la déconnexion -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-view-dashboard menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Gestion de shop</li>

                    @if(Auth::user()->role->role == 'Administrateur')  <!-- Si le rôle est "Admin" -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <i class="menu-icon mdi mdi-tag-outline"></i>
                                <span class="menu-title">Catégories</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('types.index') }}">
                                <i class="menu-icon mdi mdi-shape-outline"></i>
                                <span class="menu-title">Types</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('villes.index') }}">
                                <i class="menu-icon mdi mdi-home-city"></i>
                                <span class="menu-title">Villes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('roles.index') }}">
                                <i class="menu-icon mdi mdi-shield-account"></i>
                                <span class="menu-title">Rôles</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clients.index') }}">
                                <i class="menu-icon mdi mdi-account-multiple-plus-outline"></i>
                                <span class="menu-title">Clients</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vendeurs.index') }}">
                                <i class="menu-icon mdi mdi-cart-outline"></i>
                                <span class="menu-title">Vendeurs</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produits.index') }}">
                                <i class="menu-icon mdi mdi-cart"></i>
                                <span class="menu-title">Produits</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ventes.index') }}">
                                <i class="menu-icon mdi mdi-cart-arrow-down"></i>
                                <span class="menu-title">Ventes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commandes.index') }}">
                                <i class="menu-icon mdi mdi-format-list-checks"></i>
                                <span class="menu-title">Commandes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('achats.index') }}">
                                <i class="menu-icon mdi mdi-cart-plus"></i>
                                <span class="menu-title">Achats</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('paiements.index') }}">
                                <i class="menu-icon mdi mdi-credit-card-outline"></i>
                                <span class="menu-title">Paiements</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('devices.index') }}">
                                <i class="menu-icon mdi mdi-bank"></i>
                                <span class="menu-title">Devises</span>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stocks.index') }}">
                                <i class="menu-icon mdi mdi-label-outline"></i>
                                <span class="menu-title">Stocks</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transports.index') }}">
                                <i class="menu-icon mdi mdi-ferry"></i>
                                <span class="menu-title">Transports</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('livraisons.index') }}">
                                <i class="menu-icon mdi mdi-truck-delivery"></i>
                                <span class="menu-title">Livraisons</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                                <span class="menu-title">Utilisateurs</span>
                            </a>
                        </li>

                    @elseif(Auth::user()->role->role == 'Vendeur')  <!-- Si le rôle est "Vendeur" -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ventes.index') }}">
                                <i class="menu-icon mdi mdi-cart-arrow-down"></i>
                                <span class="menu-title">Ventes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produits.index') }}">
                                <i class="menu-icon mdi mdi-cart"></i>
                                <span class="menu-title">Produits</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commandes.index') }}">
                                <i class="menu-icon mdi mdi-format-list-checks"></i>
                                <span class="menu-title">Commandes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stocks.index') }}">
                                <i class="menu-icon mdi mdi-label-outline"></i>
                                <span class="menu-title">Stocks</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('livraisons.index') }}">
                                <i class="menu-icon mdi mdi-truck-delivery"></i>
                                <span class="menu-title">Livraisons</span>
                            </a>
                        </li>

                    @elseif(Auth::user()->role->role == 'Acheteur')  <!-- Si le rôle est "Acheteur" -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('achats.index') }}">
                                <i class="menu-icon mdi mdi-cart-plus"></i>
                                <span class="menu-title">Achats</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commandes.index') }}">
                                <i class="menu-icon mdi mdi-format-list-checks"></i>
                                <span class="menu-title">Commandes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('paiements.index') }}">
                                <i class="menu-icon mdi mdi-credit-card-outline"></i>
                                <span class="menu-title">Paiements</span>
                            </a>
                        </li>

                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="docs/documentation.html">
                            <i class="menu-icon mdi mdi-cog"></i>
                            <span class="menu-title">Paramètres</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Projet
                            e-shop.</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024 by
                            EworkPro. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('dash/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('dash/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('dash/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('dash/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('dash/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dash/assets/js/template.js') }}"></script>
    <script src="{{ asset('dash/assets/js/settings.js') }}"></script>
    <script src="{{ asset('dash/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('dash/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('dash/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/assets/js/dashboard.js') }}"></script>
    <!-- <script src="dash/assets/js/Chart.roundedBarCharts.js"></script> -->

    <script src="{{ asset('dash/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('dash/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('dash/assets/js/select2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#profileCard').click(function() {
                $('#editProfileModal').modal('show');
            });
        });
    </script>

    <!-- End custom js for this page-->
</body>

</html>
