<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PNJ - Trang Sản Phẩm</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
        }
        .navbar-brand img {
            height: 50px;
        }
        .text-purple {
            color: #6b2eb9;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="PNJ Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.public') }}">SẢN PHẨM</a></li>
                <li class="nav-item"><a class="nav-link" href="#">ĐƠN HÀNG</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cart.index')}}">GIỎ HÀNG 🛒
                        @if($cartCount > 0)
                            <span class="badge bg-danger">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.profile')}}">PROFILE</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('register.form')}}">ĐĂNG KÝ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('login.form')}}">ĐĂNG NHẬP</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Nội dung chính -->
<main class="py-4">
    @yield('content')
</main>

<!-- Footer -->
<footer class="text-center py-4 bg-light mt-5">
    <p class="mb-0">&copy; 2025 PNJ. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
