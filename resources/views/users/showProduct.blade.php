@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row bg-light p-4 rounded">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-5 text-center">
                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 350px;">
            </div>

            <!-- Thông tin chi tiết -->
            <div class="col-md-7">
                <h2 class="fw-bold">{{ $product->name }}</h2>

                <div class="mb-2">
                    <span class="text-danger fs-4 fw-semibold">Giá bán: {{ number_format($product->salePrice, 0) }}VNĐ</span><br>
                    <span class="text-decoration-line-through text-dark">Giá gốc: {{ number_format($product->originalPrice, 0) }}VNĐ</span>

{{--                    <p class="text-decoration-line-through text-secondary">Giá gốc: {{ number_format($product->originalPrice, 0) }}VND</p>--}}
{{--                    <p class="text-danger fw-bold">Giá bán: {{ number_format($product->salePrice, 0) }}VND</p>--}}
                </div>

                <p><strong>Số lượng còn:</strong> {{ $product->quantity }}</p>
                <p><strong>Đã bán:</strong> {{ $product->sold }}</p>

                @if($product->description)
                    <hr>
                    <h5 class="fw-bold">Mô tả sản phẩm:</h5>
                    <p>{{ $product->description }}</p>
                @endif

                <form action="" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-success">Thêm vào giỏ</button>
                </form>
            </div>
        </div>
    </div>
@endsection
