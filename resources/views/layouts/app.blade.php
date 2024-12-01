<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda San Andres</title>
    <!-- Agrega este enlace en tu archivo layout para cargar los íconos de Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>
    @include('layouts.navbar') <!-- Incluye la barra de navegación -->
    
    <!-- Aquí va el contenido dinámico -->
    <div class="container pt-5 mt-5">
        @yield('content')
    </div>

    <div class="container mt-5">
        @yield('show')
    </div>

    @include('shopping.partials.footer')

    <!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cartItemsContainer">
                    <!-- Cart items will be displayed here -->
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


    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
    $('.category-btn').on('click', function () {
        // Evita que el formulario recargue la página
        const categoryId = $(this).data('id');

        // Cambiar estado activo
        $('.category-btn').removeClass('active');
        $(this).addClass('active');

        // Realizar la solicitud AJAX
        $.ajax({
            url: "{{ route('shopping.filter') }}",
            type: "GET",
            data: { id_categoria: categoryId },
            success: function (data) {
                // Actualizar la lista de productos sin parpadeo
                $('#product-list').html(data);
            },
            error: function () {
                alert('Error al cargar los productos. Intenta nuevamente.');
            }
        });
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<style>
        /* Estilo personalizado para columnas flexibles */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .form-col {
            flex: 1 1 calc(50% - 0.5rem); /* Calcula ancho de columna al 50% menos el espacio del gap */
        }
        .form-control, .form-select, textarea {
            border-radius: 10px;
        }

        .form-control:focus, .form-select:focus, textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Para pantallas más pequeñas */
        @media (max-width: 767px) {
            .form-col {
                flex: 1 1 100%; /* 100% en pantallas pequeñas */
            }
        }

        .preview-container {
            margin-top: 15px;
            text-align: center;
        }

        #preview {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</body>
</html>


