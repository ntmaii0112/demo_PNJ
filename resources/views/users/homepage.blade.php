<!-- resources/views/products/index.blade.php -->
@extends('layouts.home')

@section('content')
    <div class="container py-4">
        <h2 class="text-center mb-4" style="font-size: 32px;"><strong>Danh sách sản phẩm</strong></h2>

        <form method="GET" action="{{ route('products.public') }}" class="mb-4 d-flex align-items-center gap-3">
            <label for="category" class="form-label mb-0">Danh mục:</label>
            <select name="category_id" id="category" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                <option value="">Tất cả</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <div class="ms-auto d-flex">
                <input type="text" name="search" placeholder="Nhập tên sản phẩm" value="{{ $search }}" class="form-control" />
                <button class="btn btn-warning ms-2"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top p-3" style="height: 250px; object-fit: contain;">
                        <div class="card-body">
                            <h6 class="text-purple text-truncate">{{ $product->name }}</h6>
                            <p>Đã bán: {{ $product->soldCount }}</p>
                            <p class="text-decoration-line-through text-secondary">Giá gốc: {{ number_format($product->originalPrice, 0) }}VND</p>
                            <p class="text-danger fw-bold">Giá bán: {{ number_format($product->salePrice, 0) }}VND</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-warning">THÊM VÀO GIỎ</a>
                                <a href="{{route('products.public.show',$product)}}" class="btn btn-dark">XEM CHI TIẾT</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection

