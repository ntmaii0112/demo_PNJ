@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Thêm sản phẩm</h2>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.product.form')

            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
@endsection
