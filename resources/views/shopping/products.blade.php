@extends('layouts.app')

@section('content')

<div class="category-bar d-flex justify-content-center py-3 sticky-top">
    <button type="button" data-id="" 
        class="category-btn {{ empty($categoriaId) ? 'active' : '' }}">
        <i class="fas fa-list"></i> Todas las Categorías
    </button>
    @foreach ($categorias as $categoria)
        <button type="button" data-id="{{ $categoria->id }}" 
            class="category-btn {{ $categoria->id == $categoriaId ? 'active' : '' }}">
            <i class="fas fa-tag"></i> {{ $categoria->nombre }}
        </button>
    @endforeach
</div>

<div id="product-list" class="mt-4">
    @include('shopping.partials.product-list', ['productos' => $productos])
</div>

@endsection

<style>
    .category-bar {
        position: sticky;
        margin-top: 2rem;
        top: 0;
        z-index: 1020;
        background-color: #495057;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        border-radius: 10px; 
    }

    .category-btn {
        border: none;
        margin: 0 8px;
        padding: 5px 15px;
        font-size: 0.8rem;
        font-weight: 100;
        border-radius: 30px; 
        color: #495057; 
        background-color: #f8f9fa; 
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    /* Espaciado entre el icono y el texto */
    .category-btn i {
        margin-right: 8px;
        font-size: 1.2rem; /* Icono más grande */
    }

    /* Estilos al pasar el ratón sobre el botón o cuando está activo */
    .category-btn:hover, .category-btn.active {
        background-color: #007bff; /* Azul principal */
        color: #ffffff; /* Texto blanco */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
        transform: translateY(-3px); /* Efecto de elevación más marcado */
    }

    /* Responsividad para pantallas más pequeñas */
    @media (max-width: 768px) {
        .category-btn {
            font-size: 1rem; /* Ajustar tamaño de texto en pantallas pequeñas */
            padding: 10px 18px; /* Reducir el padding en dispositivos pequeños */
        }
    }

    /* Estilo para el contenedor de la lista de productos */
    #product-list {
        margin-top: 3rem;
    }
</style>
