@extends('layouts.app')

@section('show')
<div class="container mt-5" style="padding-top: 70px;">
    <div class="row">
        <!-- Formulario -->
        <div class="col-md-6">
            <div class="form-container shadow-lg rounded-lg p-4" style="background-color: #fff;">
                <h3 class="mb-4" style="font-size: 2rem; font-weight: bold; color: #333;">Formulario de Pedido</h3>
                <form id="orderForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingresa tu email" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" placeholder="Ingresa tu dirección" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" placeholder="Ingresa tu número de teléfono" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" rows="3" placeholder="Escribe un mensaje o nota adicional"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar Pedido</button>
                </form>
            </div>
        </div>

        <!-- Productos del Carrito -->
        <div class="col-md-6">
            <div class="cart-container shadow-lg rounded-lg p-4" style="background-color: #fff;">
                <h3 class="mb-4" style="font-size: 2rem; font-weight: bold; color: #333;">Productos en el Carrito</h3>
                <div id="cartItems">
                    <!-- Aquí se mostrarán los productos cargados desde localStorage -->
                </div>
                <p id="emptyCartMessage" class="text-center text-muted" style="display: none;">El carrito está vacío.</p>
                <button id="clearCart" class="btn btn-outline-danger w-100 mt-3">Vaciar Carrito</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartItemsContainer = document.getElementById('cartItems');
        const emptyCartMessage = document.getElementById('emptyCartMessage');
        const clearCartButton = document.getElementById('clearCart');

        function obtenerIdUsuario() {
            const idUser = sessionStorage.getItem('id_user')
            return idUser
        }

        function cargarCarrito() {
            const idUsuario = obtenerIdUsuario();
            const carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};

            cartItemsContainer.innerHTML = '';
            let totalItems = 0;

            for (const id in carrito) {
                const item = carrito[id];
                totalItems += item.cantidad;

                const productHtml = `
                    <div class="d-flex align-items-center mb-3">
                        <img src="${item.imagen}" alt="${item.nombre}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0">${item.nombre}</h6>
                            <p class="mb-0 text-muted">Cantidad: ${item.cantidad}</p>
                            <p class="mb-0 text-primary">Precio: $${item.precio.toFixed(2)}</p>
                        </div>
                    </div>
                `;
                cartItemsContainer.insertAdjacentHTML('beforeend', productHtml);
            }

            if (totalItems === 0) {
                emptyCartMessage.style.display = 'block';
            } else {
                emptyCartMessage.style.display = 'none';
            }
        }

        function vaciarCarrito() {
            const idUsuario = obtenerIdUsuario();
            localStorage.removeItem('carrito_' + idUsuario);
            cargarCarrito();
        }

        clearCartButton.addEventListener('click', vaciarCarrito);

        cargarCarrito();
    });
</script>
@endsection
