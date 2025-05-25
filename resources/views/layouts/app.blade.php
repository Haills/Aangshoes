<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Aangshoes</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite CSS & JS (untuk Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    @include('layouts.navbar')
    
    <main class="flex-grow-1 py-4">
        <div class="container">
            @include('components.alert')
            @yield('content')
        </div>
    </main>
    
    @include('layouts.footer')
    
    @include('partials.scripts')
    @stack('scripts')
</body>
</html>