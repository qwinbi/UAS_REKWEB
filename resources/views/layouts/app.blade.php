<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BUNNYPOP - E-commerce Aesthetic')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink-pastel: #ECCACB;
            --white-creamy: #FCFAFA;
            --dark-gray: #3B3B3B;
            --light-gray: #ECECEC;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--white-creamy);
            color: var(--dark-gray);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-custom {
            background: linear-gradient(135deg, var(--pink-pastel), #ffb6c1) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .btn-bunny {
            background: linear-gradient(135deg, var(--pink-pastel), #ffb6c1);
            border: none;
            color: var(--dark-gray);
            font-weight: 600;
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-bunny:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(236, 202, 203, 0.4);
            color: var(--dark-gray);
        }

        .btn-bunny-outline {
            border: 2px solid var(--pink-pastel);
            color: var(--dark-gray);
            background: transparent;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-bunny-outline:hover {
            background: var(--pink-pastel);
            color: var(--dark-gray);
        }

        .product-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--pink-pastel), #ffb6c1);
            padding: 80px 0;
            border-radius: 0 0 30px 30px;
        }

        .footer-custom {
            background: var(--dark-gray);
            color: var(--white-creamy);
            padding: 40px 0;
            margin-top: auto;
        }

        .bunny-icon {
            font-size: 1.2em;
            margin-right: 5px;
        }

        .admin-sidebar {
            background: var(--dark-gray);
            color: var(--white-creamy);
            min-height: 100vh;
            padding: 20px 0;
        }

        .admin-sidebar .nav-link {
            color: var(--white-creamy);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .admin-sidebar .nav-link:hover {
            background: var(--pink-pastel);
            color: var(--dark-gray);
        }

        .admin-sidebar .nav-link.active {
            background: var(--pink-pastel);
            color: var(--dark-gray);
            font-weight: 600;
        }

        .search-box {
            border: 2px solid var(--pink-pastel);
            border-radius: 25px;
            padding: 8px 20px;
        }

        .cart-badge {
            background: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7em;
            position: absolute;
            top: -5px;
            right: -5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-bunny bunny-icon"></i>BUNNYPOP
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-cog"></i> Admin Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item position-relative">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    <i class="fas fa-shopping-cart"></i> Cart
                                    @php
                                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                                    @endphp
                                    @if($cartCount > 0)
                                        <span class="cart-badge">{{ $cartCount }}</span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h5 class="mb-3"><i class="fas fa-bunny"></i> BUNNYPOP</h5>
                    <p class="mb-3">
                        <a href="{{ route('home') }}" class="text-light me-3">Home</a>
                        <a href="{{ route('about') }}" class="text-light me-3">About</a>
                        <a href="{{ route('products.index') }}" class="text-light">Products</a>
                    </p>
                    <p class="mb-0">
                        @if(\App\Models\Setting::getValue('footer_content'))
                            {!! \App\Models\Setting::getValue('footer_content') !!}
                        @else
                            BUNNYPOP - E-commerce Aesthetic © 2024. All rights reserved.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
    @endif
    
    @if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
    @endif
</body>
</html>