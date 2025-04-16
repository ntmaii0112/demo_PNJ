@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Quản lý danh mục</h2>
        @include('layouts.alert')
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('category.create') }}" class="btn btn-primary">Thêm mới danh mục</a>
        </div>

        <form method="GET" action="{{ route('category.index') }}" class="mb-4 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm theo tên" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Status</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Category as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if ($category->del_flag == 0)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Deactive</span>
                        @endif
                    </td>
                    <td>
                        {{-- Chỉnh sửa --}}
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                        {{-- Xóa --}}
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Hiển thị phân trang --}}
        {{ $Category->links() }}
    </div>
@endsection
