<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda San Andres</title>

    <!-- Carga de fuentes y librerías externas -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">

    <style>
        /* Fondo de la página y estilo general */
        body {
            background-color: #343a40; 
            font-family: 'Roboto', sans-serif;
            color: #f8f9fa; 
        }

        /* Estilo para la barra de navegación fija */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Estilo para el mensaje de bienvenida */
        .welcome-section {
            background: url('https://source.unsplash.com/1600x900/?nature,shop') center/cover no-repeat;
            color: white;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            filter: brightness(0.7); 
        }

        .welcome-text {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Tarjetas con productos destacados o contenido */
        .card-custom {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 100%;
            overflow: hidden;
            padding-bottom: 10px;
        }

        .card-custom img {
            border-radius: 8px 8px 0 0;
            object-fit: cover; 
            height: 200px;
            width: 100%;
        }

        .card-custom-body {
            padding: 1.25rem;
        }

        /* Botón destacado */
        .btn-custom {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    @include('layouts.navbar') <!-- Barra de navegación -->

    <div class="welcome-section">
        <div class="welcome-text">
            ¡Bienvenido a Tienda San Andrés!
            <p>Explora nuestros productos y realiza tu compra en línea.</p>
        </div>
    </div>

    <div class="container mt-5">
        @yield('content') 
    </div>

    <div class="container mt-5 mb-5">
        <h3 class="text-center mb-4">Productos Destacados</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-custom">
                    <img src="/assets/camisetas.webp" class="card-img-top" alt="producto">
                    <div class="card-body card-custom-body">
                        <h5 class="card-title">Camiseta de Diseño</h5>
                        <p class="card-text">Estilo único para tu armario, cómoda y elegante.</p>
                        <a href="#" class="btn btn-custom">Ver Producto</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom">
                    <img src="/assets/zapatos.jpg" class="card-img-top" alt="producto">
                    <div class="card-body card-custom-body">
                        <h5 class="card-title">Zapatos de Cuero</h5>
                        <p class="card-text">Zapatos de alta calidad, perfectos para cualquier ocasión.</p>
                        <a href="#" class="btn btn-custom">Ver Producto</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom">
                    <img src="/assets/accesorio.png" class="card-img-top" alt="producto">
                    <div class="card-body card-custom-body">
                        <h5 class="card-title">Accesorios Modernos</h5>
                        <p class="card-text">Complementa tu look con nuestros accesorios exclusivos.</p>
                        <a href="#" class="btn btn-custom">Ver Producto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shopping.partials.footer')

    <!-- Scripts -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
</body>
</html>
