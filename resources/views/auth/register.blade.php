<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - HR Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            /* background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%); */
            display: flex;
            background: #f7fafc;
            align-items: center;
            justify-content: center;
        }
        .glass-card {
            background: rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.11);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            border: 1px solid rgba(255,255,255,0.3);
            max-width: 420px;
            width: 100%;
            margin: 40px auto;
        }
        .glass-card h3 {
            font-weight: 700;
            text-align: center;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 2px #228be6;
            border-color: #228be6;
        }
        .btn-primary {
            width: 100%;
            font-weight: 600;
            background: #228be6;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 0;
        }
        .btn-primary:hover {
            background: #176ad6;
        }
        .text-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    <div class="glass-card">
        <h3>Register</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Register</button>
        </form>
        <div class="text-link">
            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html>
