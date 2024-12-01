@extends('layouts.app')

@section('show')
<div class="container mt-5 mb-5 " style="padding-top: 70px;">
    <div class="row">
        <!-- Formulario -->
        <div class="col-md-6">
            <div class="form-container shadow-lg rounded-lg p-4" style="background-color: #fff;">
                <h3 class="mb-4" style="font-size: 2rem; font-weight: bold; color: #333;">Formulario de Pedido</h3>
                
                
                <form id="orderForm" method="POST" action="{{ route('guardar.pedido') }}">
    @csrf
    <input type="hidden" name="id_usuario" value="{{ auth()->check() ? auth()->id() : 0 }}">
    <input type="hidden" name="carrito" id="carrito" value=""> <!-- Aquí almacenamos el carrito en formato JSON -->

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu email" required>
    </div>
    <div class="mb-3">
        <label for="direccion_envio" class="form-label">Dirección de Envío</label>
        <input type="text" class="form-control" name="direccion_envio" id="direccion_envio" placeholder="Ingresa tu dirección" required>
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
            <!-- Cart items will be injected here by JavaScript -->
        </div>
        <p id="cartTotal" class="text-end mt-3 p-3 bg-light rounded" style="display: none;"></p>
    </div>
</div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Al enviar el formulario, asegurarse de agregar el carrito en formato JSON
    const carrito = localStorage.getItem('carrito_' + sessionStorage.getItem('id_user'));
    document.getElementById('carrito').value = carrito ? carrito : '{}'; // Asignar el carrito al campo oculto
});
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Function to update the cart display
function mostrarCarrito() {
    const idUsuario = sessionStorage.getItem('id_user');
    if (!idUsuario) {
        alert("Debe iniciar sesión.");
        return;
    }

    const carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};
    const cartItemsContainer = document.getElementById("cartItems");
    const cartTotalContainer = document.getElementById("cartTotal");
    let totalPrice = 0;

    // Clear the previous items
    cartItemsContainer.innerHTML = '';

    if (Object.keys(carrito).length === 0) {
        cartItemsContainer.innerHTML = '<p class="text-center text-muted">El carrito está vacío.</p>';
        cartTotalContainer.style.display = 'none';
    } else {
        // Loop through the items and display them
        for (const id in carrito) {
            const item = carrito[id];
            totalPrice += item.precio * item.cantidad;

            const itemElement = document.createElement('div');
            itemElement.classList.add('d-flex', 'align-items-center', 'mb-3', 'border', 'p-2');
            itemElement.innerHTML = `
                <img src="${item.imagen}" alt="${item.nombre}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0">${item.nombre}</h6>
                    <p class="mb-0 text-muted">Cantidad: ${item.cantidad}</p>
                    <p class="mb-0 text-primary">Precio: $${item.precio.toFixed(2)}</p>
                </div>
            `;
            cartItemsContainer.appendChild(itemElement);
        }

        cartTotalContainer.style.display = 'block';
        cartTotalContainer.innerHTML = `Total: $${totalPrice.toFixed(2)}`;
    }
}

// Call this function to populate the cart when the page loads
mostrarCarrito();

});

</script>
@endsection
