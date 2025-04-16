@extends('layouts.home')

@section('content')
    <div class="container">
        <h2 class="text-center font-bold">Thông tin cá nhân</h2>
        <div class="profile">
            <div class="row">
                <div class="col-md-3">
                    <img src="https://via.placeholder.com/150" alt="Avatar" class="img-fluid rounded">
                </div>
                <div class="col-md-9">
                    <p><strong>Họ và tên:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Ngày sinh:</strong> {{ $user->dob ?? 'Chưa cập nhật' }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $user->address ?? 'Chưa cập nhật' }}</p>
                    <p><strong>Chức vụ:</strong>
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    </p>

                    @if($user->isAdmin())
                        <p>
                            <a href="{{ route('product.index') }}" class="text-purple-600">
                                Chuyển sang trang Admin
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
