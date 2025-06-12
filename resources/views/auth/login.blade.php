<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - HR Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f7fafc;
        }
        .glass-card {
            width: 100%;
            max-width: 380px;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(18px) saturate(130%);
            -webkit-backdrop-filter: blur(18px) saturate(130%);
            border: 1.5px solid rgba(255,255,255,0.24);
            transition: box-shadow 0.3s;
        }
        .glass-card:hover {
            box-shadow: 0 8px 40px 0 rgba(31, 38, 135, 0.22);
        }
        .card-title {
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #262a42;
        }
    </style>
</head>
<body>
    <div class="glass-card p-4">
        <h4 class="card-title text-center mb-4">Login</h4>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus>
                @error('email')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                {{-- <label class="form-label">Captcha</label> --}}
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ url('captcha/flat') }}" alt="captcha" id="captcha-img" class="me-2 rounded">
                </div>
                <button type="button" class="btn btn-link p-0" onclick="refreshCaptcha()" style="font-size:12px">Refresh</button>
                <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required placeholder="Enter Captcha">
                @error('captcha')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="text-center mt-3">
                <a href="{{ route('register') }}">Register</a> |
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        </form>
    </div>

    <script>
        function refreshCaptcha() {
            const  captcha = document.getElementById('captcha-img');
            captcha.src = "{{ url('captcha/flat') }}" + "?" + Date.now();
        }
    </script>
</body>
</html>