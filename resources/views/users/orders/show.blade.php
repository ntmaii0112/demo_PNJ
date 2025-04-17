@extends('layouts.home')

@section('content')
    @include('layouts.alert')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <h2 style="text-align: center; font-weight: bold;">Đơn hàng</h2>

    <table style="width: 100%; text-align: center;">
        <thead>
        <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>{{ number_format($order->total, 0, ',', '.') }} đ</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td><a href="{{ route('orders.show')}}" style="color: blue;">Chi tiết</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
