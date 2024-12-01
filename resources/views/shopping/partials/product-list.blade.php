<div id="product-list" class="row mt-4">
    @forelse ($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
                <img src="{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 300px; object-fit: cover; transition: transform 0.3s ease;">
                <div class="card-body p-3">
                    <h5 class="card-title text-dark font-weight-bold">{{ $producto->nombre }}</h5>
                    <p class="card-text text-muted" style="height: 50px; overflow: hidden; text-overflow: ellipsis;">{{ $producto->descripcion }}</p>
                    <p class="card-text text-primary"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                </div>
                <div class="card-footer border-0 bg-white text-center">
                    <a href="{{ route('shopping.show', $producto->id) }}" class="btn btn-primary btn-block py-1 px-3 rounded-pill shadow-sm">
                        Ver Producto
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p>No hay productos disponibles.</p>
    @endforelse
</div>

<style>
    /* Efecto de imagen al pasar el ratón */
    .card-img-top:hover {
        transform: scale(1.1); /* Zoom en la imagen */
    }

    /* Estilo de la tarjeta */
    .card {
        border-radius: 15px; /
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Suavizar la transición */
        background: '#343a40';
    }

    /* Efecto de hover en la tarjeta */
    .card:hover {
        transform: translateY(-5px); /* Levantar la tarjeta */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Sombra más fuerte */
    }

    /* Estilo del título */
    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    /* Descripción del producto */
    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Botón 'Ver Producto' */
    .btn-primary {
        background-color: #007bff;
        border: none;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Ajustes responsivos para pantallas pequeñas */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem; /* Ajustar padding en móviles */
        }

        .card-title {
            font-size: 1rem;
        }

        .card-text {
            font-size: 0.85rem;
        }

        .btn-primary {
            font-size: 0.9rem;
        }
    }
</style>
