<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }
        .form-box {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
        }
        input, textarea, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #b2783c;
            color: white;
            border: none;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Đăng ký</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Họ tên..." required>
        <input type="email" name="email" placeholder="Email..." required>
        <input type="password" name="password" placeholder="Mật khẩu..." required>
        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu..." required>
        <textarea name="address" placeholder="Địa chỉ..." required></textarea>
        <input type="date" name="dob" required>
        <button type="submit">Đăng ký</button>
    </form>
</div>
</body>
</html>
