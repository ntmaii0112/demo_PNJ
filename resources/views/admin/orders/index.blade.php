@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Quản lý Đơn Hàng</h1>

        @include('layouts.alert');

        <table class="table">
            <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Quê quán</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{$order->user_id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->user->address}}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="ordered" {{ $order->status == 'ordered' ? 'selected' : '' }}>Ordered</option>
                                <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Delivering</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
