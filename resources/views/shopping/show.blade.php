@extends('layouts.app')

@section('show')
<div class="container mt-5" style="padding-top: 70px;">
    <div class="row">
        <!-- Detalles del Producto -->
        <div class="col-md-12">
            <div class="product-details shadow-lg rounded-lg p-4" style="background-color: #fff;">
                <div class="row">
                    <!-- Imagen del Producto -->
                    <div class="col-md-5 mb-3 mb-md-0">
                        <img src="{{ $producto->imagen_url }}" class=" rounded-3" alt="{{ $producto->nombre }}" style="height: 400px; object-fit: contain;">
                    </div>

                    <!-- Información del Producto -->
                    <div class="col-md-6">
                        <h3 class="product-name" style="font-size: 2.2rem; font-weight: bold; color: #333;">{{ $producto->nombre }}</h3>
                        <p class="product-description" style="font-size: 1.1rem; color: #555; margin-top: 1rem;">{{ $producto->descripcion }}</p>
                        <p class="product-price" style="font-size: 1.3rem; color: #007bff; font-weight: bold; margin-top: 1.5rem;">${{ number_format($producto->precio, 2) }}</p>

                        <!-- Detalles adicionales -->
                        <p class="product-stock" style="font-size: 1rem; color: #888;"><strong>Stock:</strong> 1</p>
                        <p class="product-category" style="font-size: 1rem; color: #888;"><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="/home" class="btn btn-outline-secondary btn-sm px-4" style="border-radius: 20px;">Volver a la tienda</a>
                            <button onclick="agregarAlCarrito('{{ $producto->id}}', '{{ $producto->nombre }}', '{{ $producto->precio }}', '{{ $producto->imagen_url }}')" class="btn btn-primary btn-sm px-4" style="border-radius: 20px;">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional, como productos relacionados -->
        <div class="col-md-6">
            <h5 class="mb-4 mt-3" style="font-size: 1.5rem; color: #fff; font-weight: bold;">Productos Relacionados</h5>
            <div class="row">
                @foreach($productosRelacionados as $relacionado)
                    <div class="col-md-6 mb-4">
                        <div class="product-related shadow-sm rounded-lg p-3" style="background-color: #f9f9f9; border: 1px solid #ddd; transition: transform 0.3s;">
                            <a href="{{ route('shopping.show', $relacionado->id) }}" style="text-decoration: none; color: #333;">
                                <img src="{{ $relacionado->imagen_url }}" class="img-fluid rounded-3" alt="{{ $relacionado->nombre }}" style="max-height: 150px; object-fit: cover; transition: transform 0.3s;">
                                <h6 class="text-center mt-2" style="font-size: 1rem; font-weight: bold; color: #333;">{{ $relacionado->nombre }}</h6>
                                <p class="text-center" style="font-size: 1rem; color: #007bff;">${{ number_format($relacionado->precio, 2) }}</p>
                            </a>
                            <button onclick="agregarAlCarrito({{ $relacionado->id }}, '{{ $relacionado->nombre }}', '{{ $relacionado->precio }}', '{{ $relacionado->imagen_url }}')" class="btn btn-primary btn-sm mt-2 w-100" style="border-radius: 20px;">Añadir al carrito</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal del Carrito -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="cartItemsContainer">
          <!-- Aquí se mostrarán los productos del carrito -->
        </div>
        <p id="emptyCartMessage" class="text-center text-muted" style="display: none;">El carrito está vacío.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Finalizar Compra</button>
      </div>
    </div>
  </div>
</div>

<div class="toast-container-custom">
  <div id="cartToast" class="toast text-white bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-dark text-light">
      <strong class="me-auto">Carrito</strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-center" style="font-size: 1.1rem;">
      Producto agregado al carrito.
    </div>
  </div>
</div>

@endsection


<style>
     .toast-container-custom {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1055;
    }

    .toast {
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        background-color: #343a40; /* Dark background */
    }

    .toast-header {
        background-color: #343a40; /* Darker header */
        color: #f8f9fa; /* Light text for the header */
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .toast-body {
        font-size: 1.1rem;
        color: #e9ecef; /* Light color for body text */
    }

    .btn-close-white {
        filter: invert(1);
    }

    .product-related {
        transition: transform 0.3s ease-in-out;
    }

    .product-related:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .product-related img {
        max-height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-details {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
