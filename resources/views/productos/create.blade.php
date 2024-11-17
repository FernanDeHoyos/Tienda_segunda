<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
</head>
<body>

@include('layouts.navbar')

<div class="container pt-5 mt-5">
    <div class="card shadow-lg mt-5">
        <div class="card-body">
            <h2 class="text-center mb-4">Agregar Producto</h2>
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <!-- Nombre Producto -->
                    <div class="form-col mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-cube"></i></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ejemplo: Camisa de Algodón">
                        </div>
                    </div>

                    <!-- Precio -->
                    <div class="form-col mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required placeholder="Ejemplo: 19.99">
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="form-col mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="nuevo">Nuevo</option>
                                <option value="usado">Usado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Categoría -->
                    <div class="form-col mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div class="form-col mb-3">
                        <label for="imagen_url" class="form-label">URL de la Imagen</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                            <input type="text" class="form-control" id="imagen_url" name="imagen_url" placeholder="Ingresa la URL de la imagen" required>
                        </div>
                        <!-- Vista previa de la imagen -->
                        <div class="preview-container">
                            <img id="preview" src="" alt="Vista previa de la imagen" style="display: none;">
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="form-col mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required placeholder="Escribe una breve descripción del producto"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4">Agregar Producto</button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/cart.js') }}"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    document.getElementById('imagen_url').addEventListener('input', function() {
        const imgUrl = this.value;
        const preview = document.getElementById('preview');
        
        if (imgUrl) {
            preview.src = imgUrl;
            preview.style.display = 'block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    });
</script>
</body>
</html>
