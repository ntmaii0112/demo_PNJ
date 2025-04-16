@extends('layouts.home')

@section('content')

    <div class="container py-4">
        <h3 class="mb-4">Giỏ hàng của bạn 🛒</h3>
        @include('layouts.alert')

        @if($cartItems->count() > 0)
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @php $total = 0; @endphp
                @foreach($cartItems as $index => $item)
                    @php $itemTotal = $item->product_price * $item->quantity; $total += $itemTotal; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset('images/products/' . $item->product_image) }}" width="60"></td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ number_format($item->product_price, 0, ',', '.') }}₫</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 80px;" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>{{ number_format($itemTotal, 0, ',', '.') }}₫</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-secondary fw-bold">
                    <td colspan="5" class="text-end">Tổng cộng:</td>
                    <td colspan="2">{{ number_format($total, 0, ',', '.') }}₫</td>
                </tr>
                </tbody>
            </table>
        @else
            <p>Chưa có sản phẩm nào trong giỏ hàng.</p>
        @endif
    </div>
@endsection

