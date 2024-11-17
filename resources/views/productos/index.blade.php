<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para tarjetas de productos */
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-image {
            max-height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .product-price {
            font-size: 1.1rem;
            color: #28a745;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
        }

        .btn-custom {
            padding: 5px 10px;
            font-size: 0.9rem;
            border-radius: 5px;
        }

        /* Para pantallas más pequeñas */
        @media (max-width: 767px) {
            .product-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>

@include('layouts.navbar')

<div class="container pt-5 mt-5">
    <h2 class="mt-4 mb-4">Mis Productos</h2>

    <div class="row">
        <!-- Itera sobre los productos del usuario -->
        @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="product-card">
                <img src="{{ $producto->imagen_url }}" alt="Imagen del producto" class="product-image">
                <div class="product-info">
                    <div class="product-name">{{ $producto->nombre }}</div>
                    <div class="product-price">${{ number_format($producto->precio, 2) }}</div>
                    <p class="text-muted">{{ $producto->descripcion }}</p>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
