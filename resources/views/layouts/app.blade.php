<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Role Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light bg-light mb-4">
    <div class="container d-flex align-items-center gap-3">
        <a class="navbar-brand fw-bold" href="#">ADMIN</a>
        <a class="btn btn-outline-primary" href="{{ route('admin.index') }}">Quản lý Role</a>
        <a class="btn btn-outline-primary" href="{{ route('category.index') }}">Quản lý danh mục</a>
        <a class="btn btn-outline-primary" href="{{ route('product.index') }}">Quản lý sản phẩm</a>
        <a class="btn btn-outline-primary" href="{{ route('admin.index') }}">Quản lý đơn hàng</a>
        <a class="btn btn-outline-primary" href="{{ route('products.public') }}">Chuyển về trang chủ</a>

    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>
