<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng nhập</title>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            font-size: 14px;
        }
        input {
            width: 100%;
            margin-top: 5px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #b2783c;
            color: white;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #a56b34;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        .forgot-password {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function validateForm(){
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value;

            // xóa thông tin lỗi trước đó

            document.getElementById("emailError").innerText = "";
            document.getElementById("passwordError").innerText = "";

            let isValid = true;

            if(email === ""){
                document.getElementById("emailError").innerText = "Email không được để trống!";
            }
            else{
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(!emailPattern.test(email)){
                    document.getElementById("emailError").innerText = "Email không hợp lệ";
                    isValid = false;
                }
            }

            if(password === ""){
                document.getElementById("passwordError").innerText = "Password không được để trống!";
            }
            else{
                if(password.length < 6){
                    document.getElementById("passwordError").innerText = "Password không hợp lệ";
                    isValid = false;
                }
            }

            return isValid;

        }

    </script>
</head>
<body>

<form id="LoginForm" action="{{route('login')}}" method="post" onsubmit="return validateForm()">
    @csrf
    <div class="mb-3">
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" >
        <p id="emailError" style="color: red"></p>
    </div>

    <div class="mb-3">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" >
        <p id="passwordError" style="color: red"></p>
    </div>
    <br>
    {{-- <button type="button" onclick="validateForm()">Login</button> --}}
    <button type="submit">Login</button>
</form>
</body>
</html>
