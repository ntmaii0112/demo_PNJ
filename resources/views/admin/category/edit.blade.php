@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chỉnh sửa danh mục</h2>

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')  {{-- Hoặc @method('PATCH') --}}
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
