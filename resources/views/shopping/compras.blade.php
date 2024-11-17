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
                <div id="cartTotal" class="text-end mt-3 p-3 bg-light rounded">
</div>
                <button id="clearCart" class="btn btn-outline-danger w-100 mt-3">Vaciar Carrito</button>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Primero verificamos que podemos obtener todos los elementos
    const cartItemsContainer = document.getElementById('cartItems');
    const emptyCartMessage = document.getElementById('emptyCartMessage');
    const cartTotal = document.getElementById('cartTotal');
    const clearCartButton = document.getElementById('clearCart');

    // Agregamos logs para verificar que los elementos existen
    console.log('Container:', cartItemsContainer);
    console.log('Empty Message:', emptyCartMessage);
    console.log('Cart Total:', cartTotal);
    console.log('Clear Button:', clearCartButton);
    const strong  = '<strong>Total a Pagar: $0.00</strong>';
    cartTotal.insertAdjacentHTML('beforeend', strong);
    

    function cargarCarrito() {
        const idUsuario = obtenerIdUsuario();
        console.log('ID Usuario:', idUsuario); // Verificar el ID de usuario

        const carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};
        console.log('Carrito:', carrito); // Verificar el contenido del carrito

        let totalPrice = 0;

        cartItemsContainer.innerHTML = '';
        cartTotal.innerHTML = `<strong>Total a Pagar: $${totalPrice.toFixed(2)}</strong>`;
        if (Object.keys(carrito).length === 0) {
            emptyCartMessage.style.display = 'block';
        } else {
            emptyCartMessage.style.display = 'none';

            for (const id in carrito) {
                const item = carrito[id];
                totalPrice += item.precio * item.cantidad;
                console.log('Precio del item:', item.precio); // Verificar precio
                console.log('Cantidad del item:', item.cantidad); // Verificar cantidad

                const productHtml = `
                    <div class="d-flex align-items-center mb-3 border p-2">
                        <img src="${item.imagen}" alt="${item.nombre}" 
                             class="img-fluid rounded" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0">${item.nombre}</h6>
                            <p class="mb-0 text-muted">Cantidad: ${item.cantidad}</p>
                            <p class="mb-0 text-primary">Precio: $${item.precio.toFixed(2)}</p>
                        </div>
                    </div>
                `;
                cartItemsContainer.insertAdjacentHTML('beforeend', productHtml);
            }

            console.log('Total calculado:', totalPrice); // Verificar total final
            
        }
    }

    function obtenerIdUsuario() {
        return sessionStorage.getItem('id_user') || 'default';
    }

    function vaciarCarrito() {
        const idUsuario = obtenerIdUsuario();
        localStorage.removeItem('carrito_' + idUsuario);
        cargarCarrito();
    }

    // Agregamos event listeners
    clearCartButton.addEventListener('click', vaciarCarrito);
    
    // Cargamos el carrito inicialmente
    cargarCarrito();
});
</script>
@endsection
