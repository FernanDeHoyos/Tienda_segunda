<div id="product-list" class="row mt-2">
    @forelse ($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text text-primary"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('shopping.show', $producto->id) }}" class="btn btn-primary btn-block">Ver Producto</a>
                </div>
            </div>
        </div>
    @empty
        <p>No hay productos disponibles.</p>
    @endforelse
</div>


