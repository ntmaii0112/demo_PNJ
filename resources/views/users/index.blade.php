@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Danh sách người dùng và phân quyền</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Role</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <strong>{{ $user->name }}</strong><br>
                        <small>{{ $user->email }}</small>
                    </td>

                    <td>
                        {{-- Luôn hiển thị role mặc định từ role_id --}}
                        <span class="badge bg-secondary">user</span>

                        {{-- Nếu có thêm role admin thì hiển thị thêm --}}
                        @if($user->roles->contains('name', 'admin'))
                            <span class="badge bg-warning text-dark">admin</span>

                            {{-- Chỉ cho xoá role admin --}}
                            <form action="{{ route('users.removeRole', [$user->id, 1]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger ms-1">X</button>
                            </form>
                        @endif
                    </td>

                    <td style="min-width: 220px;">
                        {{-- Form thêm role admin --}}
                        @if(!$user->roles->contains('name', 'admin'))
                            <form action="{{ route('users.addRole', $user->id) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <input type="hidden" name="role_id" value="1">
                                <button class="btn btn-sm btn-primary">Thêm quyền admin</button>
                            </form>
                        @else
                            <span class="text-muted">Đã có quyền admin</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
