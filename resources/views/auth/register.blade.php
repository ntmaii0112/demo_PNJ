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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            font-size: 14px;
        }
        input, textarea {
            width: 100%;
            margin-top: 5px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            height: 80px;
            resize: none;
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
    </style>
</head>
<body>
<div class="form-box">
    <h2>Đăng ký</h2>
    <form action="{{ route('register') }}" method="POST" id="registerForm" onsubmit="return validateForm(event)">
        @csrf

        <!-- Họ tên -->
        <label for="name">Họ tên</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Họ tên...">
        <div class="error-message" id="name-error">{{ old('name') ? '' : 'Vui lòng nhập họ tên.' }}</div>
        @error('name')
        <div class="error-message" style="display: block;">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email...">
        <div class="error-message" id="email-error">{{ old('email') ? '' : 'Vui lòng nhập email.' }}</div>
        @error('email')
        <div class="error-message" style="display: block;">{{ $message }}</div>
        @enderror

        <!-- Mật khẩu -->
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="Mật khẩu...">
        <div class="error-message" id="password-error">Vui lòng nhập mật khẩu.</div>
        @error('password')
        <div class="error-message" style="display: block;">{{ $message }}</div>
        @enderror

        <!-- Nhập lại mật khẩu -->
        <label for="password_confirmation">Nhập lại mật khẩu</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu...">
        <div class="error-message" id="password_confirmation-error">Mật khẩu xác nhận không đúng.</div>

        <!-- Địa chỉ -->
        <label for="address">Địa chỉ</label>
        <textarea id="address" name="address" placeholder="Địa chỉ...">{{ old('address') }}</textarea>
        <div class="error-message" id="address-error">{{ old('address') ? '' : 'Vui lòng nhập địa chỉ.' }}</div>
        @error('address')
        <div class="error-message" style="display: block;">{{ $message }}</div>
        @enderror

        <!-- Ngày sinh -->
        <label for="dob">Ngày sinh</label>
        <input type="date" id="dob" name="dob" value="{{ old('dob') }}">
        <div class="error-message" id="dob-error">Ngày sinh phải là ngày trong quá khứ.</div>
        @error('dob')
        <div class="error-message" style="display: block;">{{ $message }}</div>
        @enderror

        <button type="submit">Đăng ký</button>
    </form>
</div>

<script>
    function validateForm(event) {
        event.preventDefault();
        let isValid = true;

        // Reset all error messages
        document.querySelectorAll('.error-message').forEach(error => {
            error.style.display = 'none';
        });

        // Get form values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const address = document.getElementById('address').value.trim();
        const dob = document.getElementById('dob').value;

        // Validate Họ tên
        if (!name) {
            document.getElementById('name-error').style.display = 'block';
            isValid = false;
        }

        // Validate Email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            document.getElementById('email-error').textContent = 'Vui lòng nhập email.';
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
        } else if (!emailPattern.test(email)) {
            document.getElementById('email-error').textContent = 'Email không hợp lệ.';
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
        }

        // Validate Mật khẩu
        if (!password) {
            document.getElementById('password-error').style.display = 'block';
            isValid = false;
        }

        // Validate Nhập lại mật khẩu
        if (password !== passwordConfirmation) {
            document.getElementById('password_confirmation-error').style.display = 'block';
            isValid = false;
        }

        // Validate Địa chỉ
        if (!address) {
            document.getElementById('address-error').style.display = 'block';
            isValid = false;
        }

        // Validate Ngày sinh
        if (dob) {
            const today = new Date();
            const dobDate = new Date(dob);
            if (dobDate >= today) {
                document.getElementById('dob-error').style.display = 'block';
                isValid = false;
            }
        } else {
            document.getElementById('dob-error').textContent = 'Vui lòng chọn ngày sinh.';
            document.getElementById('dob-error').style.display = 'block';
            isValid = false;
        }

        // If all validations pass, submit the form
        if (isValid) {
            document.getElementById('registerForm').submit();
        }

        return isValid;
    }

    // Real-time email validation with AJAX to check for uniqueness
    document.getElementById('email').addEventListener('blur', function() {
        const email = this.value.trim();
        const emailError = document.getElementById('email-error');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Reset error message
        emailError.style.display = 'none';

        // Basic email validation
        if (!email) {
            emailError.textContent = 'Vui lòng nhập email.';
            emailError.style.display = 'block';
            return;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = 'Email không hợp lệ.';
            emailError.style.display = 'block';
            return;
        }

        // AJAX call to check if email exists
        fetch('/check-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                emailError.textContent = 'Email đã được sử dụng.';
                emailError.style.display = 'block';
            } else {
                emailError.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error checking email:', error);
            emailError.textContent = 'Có lỗi xảy ra khi kiểm tra email.';
            emailError.style.display = 'block';
        });
    });
</script>
</body>
</html>