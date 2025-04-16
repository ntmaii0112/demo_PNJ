@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        @include('layouts.alert')
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

        <form method="GET" action="{{ route('product.index') }}" class="mb-3">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Tìm kiếm sản phẩm...">
            <button type="submit" class="btn btn-sm btn-secondary">Tìm</button>
        </form>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Ảnh</th>
                <th>Danh mục</th>
                <th>Số lượng</th>
                <th>Đã bán</th>
                <th>Status</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)

                <tr>
                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->originalPrice) }}</td>
                    <td>{{ number_format($product->salePrice) }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" width="80">
                        @else
                            <span>Không có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $product->category->name ?? 'Không rõ' }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->soldCount }}</td>
                    <td>
                        @if ($product->del_flag == 0)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Deactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection
