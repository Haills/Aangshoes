<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Aangshoes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <header class="bg-white shadow p-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-xl font-bold text-green-700">Aangshoes</a>
        <nav>
            <ul class="flex space-x-4 items-center">
                <li><a href="{{ url('/') }}" class="hover:text-green-700">Home</a></li>

                @auth
                    @if(auth()->user()->is_admin)
                        <li><a href="{{ route('products.index') }}" class="hover:text-green-700">Kelola Produk</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-green-700">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-green-700">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-green-700">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main class="flex-grow container mx-auto p-6">
        @yield('content')
    </main>

    <footer class="bg-white text-center p-4 shadow">
        &copy; {{ date('Y') }} Aangshoes. All rights reserved.
    </footer>

</body>
</html>
