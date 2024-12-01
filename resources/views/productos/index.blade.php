<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

   <style>
        /* Estilo para tarjetas de productos */
        .product-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            height: 400px;
            width: 300px;
            background-color: #fff;
            margin-top: 50px;
            margin-bottom: 15px;
            position: relative; /* Necesario para la posición absoluta */
        }

        /* Efecto de hover en las tarjetas */
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        /* Estilo de la imagen del producto */
        .product-image {
            object-fit: cover;
            width: 300px;
            height: 50%;
            border-bottom: 1px solid #ddd;
        }

        /* Estilo de la información del producto */
        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 170px;
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            transition: color 0.2s;
        }

        .product-name:hover {
            color: #007bff;
        }

        .product-price {
            font-size: 1.2rem;
            color: #28a745;
            font-weight: bold;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
        }

        .btn-custom {
            padding: 5px 10px;
            font-size: 1rem;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Estilo de la etiqueta de espera sobre la imagen */
        .product-waiting {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 193, 7, 0.8); /* Amarillo translúcido */
            color: #fff;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            z-index: 10;
        }

        /* Para pantallas más pequeñas */
        @media (max-width: 767px) {
            .product-card {
                margin-bottom: 20px;
            }

            .product-name {
                font-size: 1.1rem;
            }

            .product-price {
                font-size: 1rem;
            }
        }

        /* Aumentar el tamaño de las tarjetas en pantallas grandes */
        @media (min-width: 992px) {
            .col-lg-3 {
                max-width: 22%; /* Aumenta el espacio entre tarjetas */
            }
        }
    </style>
</head>
<body>

@include('layouts.navbar')

<div class="container mb-5">
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-lg-4 col-md-4 col-sm-6 "> <!-- Asegura un buen espaciado entre las tarjetas -->
                <div class="product-card">
                    <!-- Mostrar la etiqueta de espera sobre la imagen si el producto está en espera -->
                    @if($producto->en_espera)
                        <div class="product-waiting">En espera</div>
                    @endif
                    
                    <img src="{{ $producto->imagen_url }}" alt="Imagen del producto" class="product-image">
                    <div class="product-info">
                        <div class="product-name">{{ $producto->nombre }}</div>
                        <div class="product-price">${{ number_format($producto->precio, 2) }}</div>
                        <p class="text-muted" style="font-size: 0.9rem;">{{ $producto->descripcion }}</p>

                        <div class="product-actions">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-custom">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include( 'shopping.partials.footer')


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
