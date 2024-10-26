<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tienda San Andres</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        .user-initial {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            margin-right: 8px;
            font-size: 1rem;
        }
        .navbar-brand-centered {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 1.2rem;
        }
        .welcome-section {
            padding: 60px 0;
            text-align: center;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body class="antialiased">
    
    @include('layouts.navbar')

    <!-- Bienvenida (solo para invitados) -->
    @guest
    <section class="welcome-section bg-light">
        <div class="container">
            <h1 class="display-4">Bienvenido a su tienda</h1>
            <p class="lead">Aquí puedes encontrar productos de tu interés.</p>
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">Ir al Dashboard</a>
        </div>
    </section>
    @endguest

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
</body>
</html>
