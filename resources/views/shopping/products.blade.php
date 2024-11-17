@extends('layouts.app')

@section('content')


    <div class="category-bar d-flex justify-content-center py-3  sticky-top">
    <button type="button" data-id="" 
        class="category-btn {{ empty($categoriaId) ? 'active' : '' }}">
        Todas las Categorías
    </button>
    @foreach ($categorias as $categoria)
        <button type="button" data-id="{{ $categoria->id }}" 
            class="category-btn {{ $categoria->id == $categoriaId ? 'active' : '' }}">
            {{ $categoria->nombre }}
        </button>
    @endforeach
</div>


<div id="product-list">
    @include('shopping.partials.product-list', ['productos' => $productos])
</div>



@endsection

<style>
    .category-bar {
    position: sticky;
    margin-top: 3rem;
    top: 0;
    z-index: 1020;
    border-bottom: 1px solid #ddd; /* Línea divisoria */
}

.category-btn {
    border: none;
    margin: 0 5px;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 25px;
    color: #495057; /* Texto oscuro */
    transition: all 0.3s ease;
}

.category-btn:hover, .category-btn.active {
    background-color: #007bff; /* Azul principal */
    color: #fff; /* Texto blanco */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
    transform: translateY(-2px); /* Efecto de levantamiento */
}

</style>
