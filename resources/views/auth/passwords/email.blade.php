<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Password - Aangshoes</title>
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
        .alert {
            font-size: 0.9rem;
        }
        a {
            color: #b65d37;
            font-weight: 600;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Masukkan Email Anda</label>
                <input id="email" type="email" name="email" class="form-control" required autofocus placeholder="Masukkan email untuk reset password" />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim Link Reset Password</button>
        </form>

        <p class="mt-3 text-center">
            Ingat password? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>