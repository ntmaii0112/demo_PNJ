@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Chỉnh sửa sản phẩm</h2>
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.product.form', ['product' => $product])

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
