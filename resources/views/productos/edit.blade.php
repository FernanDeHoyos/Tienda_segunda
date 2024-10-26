<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        /* Para pantallas más pequeñas */
        @media (max-width: 767px) {
            .form-col {
                flex: 1 1 100%; /* 100% en pantallas pequeñas */
            }
        }
    </style>
</head>
<body>

@include('layouts.navbar')

<div class="container  pt-5 mt-5">
    <h2 class="mb-4">Editar Producto</h2>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-row">
        <div class="form-col mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="form-col mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
        </div>

        <div class="form-col mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="nuevo" {{ $producto->estado === 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                <option value="usado" {{ $producto->estado === 'usado' ? 'selected' : '' }}>Usado</option>
            </select>
        </div>

        <div class="form-col mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-control" id="id_categoria" name="id_categoria" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id === $producto->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-col mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="form-col mb-3">
            <label for="imagen_url" class="form-label">URL de la Imagen</label>
            <input type="text" class="form-control" id="imagen_url" name="imagen_url" placeholder="Ingresa la URL de la imagen" value="{{ old('imagen_url', $producto->imagen_url) }}" required>
            <div class="mt-3">
                <img id="preview" src="{{ $producto->imagen_url }}" alt="Vista previa de la imagen" style="display: {{ $producto->imagen_url ? 'block' : 'none' }}; max-width: 200px; height: auto;">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>

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
