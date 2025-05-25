<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Aangshoes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #d4a373 0%, #b65d37 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 400px;
            background: #fff8f0;
        }
        .btn-primary {
            background-color: #b65d37;
            border-color: #a34f2f;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #a34f2f;
            border-color: #8e431f;
        }
        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            color: #6a3c1d;
            text-align: center;
            margin-bottom: 1rem;
            letter-spacing: 2px;
            user-select: none;
        }
        label {
            font-weight: 600;
            color: #6a3c1d;
        }
        a {
            color: #b65d37;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="card p-4">
        <div class="brand-title">Aangshoes</div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control" required autofocus placeholder="masukkan email" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required placeholder="masukkan password" />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="mt-3 d-flex justify-content-between">
            <a href="{{ route('password.request') }}">Lupa Password?</a>
            <a href="{{ route('register') }}">Daftar akun baru</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>