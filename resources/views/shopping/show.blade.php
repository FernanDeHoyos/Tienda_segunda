@extends('layouts.app')

@section('show')
<div class="container mt-5" style="padding-top: 70px;">
    <div class="row">
        <!-- Detalles del Producto -->
        <div class="col-md-8">
            <div class="product-details shadow-lg rounded-lg p-4" style="background-color: #fff;">
                <div class="row">
                    <!-- Imagen del Producto -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img src="{{ $producto->imagen_url }}" class="img-fluid rounded-3" alt="{{ $producto->nombre }}" style="max-height: 400px; object-fit: cover;">
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
                            <button onclick="agregarAlCarrito('{{ $producto->id_usuario}}{{$producto->nombre}}', '{{ $producto->nombre }}', '{{ $producto->precio }}', '{{ $producto->imagen_url }}')" class="btn btn-primary btn-sm px-4" style="border-radius: 20px;">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional, como productos relacionados -->
        <div class="col-md-4">
            <h5 class="mb-4" style="font-size: 1.3rem; color: #333; font-weight: bold;">Productos Relacionados</h5>
            <div class="row">
                @foreach($productosRelacionados as $relacionado)
                    <div class="col-md-6 mb-3">
                        <div class="product-related shadow-sm rounded-lg p-3" style="background-color: #f9f9f9;">
                            <a href="{{ route('shopping.show', $relacionado->id) }}" style="text-decoration: none; color: #333;">
                                <img src="{{ $relacionado->imagen_url }}" class="img-fluid rounded-3" alt="{{ $relacionado->nombre }}" style="max-height: 150px; object-fit: cover;">
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
  <div id="cartToast" class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Carrito</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-center">
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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .toast-header {
        background-color: #28a745;
        color: #fff;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .toast-body {
        font-size: 1.1rem;
    }
</style>
