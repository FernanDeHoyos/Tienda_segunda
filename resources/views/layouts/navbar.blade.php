<!-- Primer navbar (oscuro) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <!-- Logo y nombre de la tienda -->
    <a class="navbar-brand" href="/home">
      @auth
      <span class="user-initial"
      style="font-size: 1.3rem; font-weight: bold; background-color: #f0ad4e; color: white; padding: 5px 10px; border-radius: 50%;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
    @endauth
      <span class="ms-2" style="font-size: 1.4rem; font-weight: bold; color: #fff;">Tienda San Andrez</span>
    </a>

    <!-- Botones de login, registro y usuario -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

   
      <div class="d-flex ms-auto align-items-center centerNav">
        @auth
      <span class="me-3 text-white">Hola, {{ auth()->user()->name }}</span>
      <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-sign-out-alt"></i> Salir
        </button>
      </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">Iniciar sesión</a>
    <a href="{{ route('register') }}" class="btn btn-success btn-sm">Registrarse</a>
  @endauth
      </div>
   
  </div>
</nav>

@auth
 <!-- Segundo navbar (claro) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navStyle" style="top: 60px;">
  <div class="container">
    <!-- Grupo de enlaces alineados a la izquierda -->
    <div class="navbar-nav me-auto">
      <a href="{{ route('productos.index') }}" class="nav-link me-3">Mis productos</a>
      <a href="{{ route('productos.create') }}" class="nav-link me-3">Agregar Producto</a>
    </div>

    <!-- Grupo de enlaces alineados a la derecha -->
    <div class="navbar-nav ms-auto">
      <a href="{{ route('shopping.index') }}" class="nav-link me-3">Ver productos</a>
      <a href="{{ route('shopping.compras') }}" class="nav-link me-3">Comprar de carrito</a>
      <a href="{{ route('shopping.pedido') }}" class="nav-link me-3">Mis compras</a>

      <!-- Icono de carrito -->
      <a href="#" class="nav-link d-flex align-items-center" id="cartButton">
        <i class="fas fa-shopping-cart me-1"></i>
        <span class="badge bg-primary ms-1" id="cart-count">0</span>
        <!-- Contador de artículos en el carrito -->
      </a>
    </div>
  </div>
</nav>

@endauth


<!-- Modal del carrito -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-3">
        <div id="cartItemsContainer" class="list-group"></div>
        <p id="emptyCartMessage" class="text-center text-muted" style="display: none;">Carrito vacío</p>
      </div>
      <div id="cartTotal" class="text-end mt-3" style="font-size: 1.2rem; font-weight: bold;"></div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        <a href="{{ route('shopping.compras') }}" class="btn btn-primary btn-sm">Comprar</a>
      </div>
    </div>
  </div>
</div>



<script>
    const userId = @json(auth()->id());
    console.log('ID del usuario autenticado:', userId);
    sessionStorage.setItem('id_user',userId);
</script>
<script src="{{ asset(path: 'js/cart.js') }}"></script>

<style>
  .navStyle {
    margin-bottom: 30px;
  }
 /* Estilo para el modal pequeño */
.modal-dialog.modal-sm {
  max-width: 400px;
}

/* Estilo para el contenido del modal */
.modal-content {
  border-radius: 8px;
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
  padding: 10px;
}

/* Estilo para los elementos de los productos en el carrito */
.cart-item {
  padding: 10px;
  border-bottom: 1px solid #f1f1f1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 8px;
}

.cart-item img {
  max-width: 40px;
  max-height: 40px;
  border-radius: 5px;
  object-fit: cover;
}

.cart-item .product-info {
  margin-left: 10px;
  flex-grow: 1;
}

.cart-item .product-info p {
  margin: 0;
  font-size: 0.9rem;
}

.cart-item .btn-danger {
  background-color: #e63946;
  border-color: #e63946;
  color: #fff;
  padding: 5px 8px;
  font-size: 0.9rem;
}

.cart-item .btn-danger:hover {
  background-color: #d62828;
  border-color: #d62828;
}

/* Estilo para el mensaje del carrito vacío */
#emptyCartMessage {
  font-size: 1.1rem;
  font-weight: bold;
  color: #888;
}

/* Estilo para el total */
#cartTotal {
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
  margin-top: 12px;
}

/* Estilo del botón de cerrar en el modal */
.modal-header .btn-close {
  color: #007bff;
  font-size: 1.2rem;
}

/* Estilo para el botón de compra */
.modal-footer .btn-primary {
  background-color: #4caf50;
  border-color: #4caf50;
  font-size: 0.9rem;
  padding: 6px 12px;
  border-radius: 5px;
}

.modal-footer .btn-primary:hover {
  background-color: #45a049;
  border-color: #45a049;
}

/* Ajuste en los márgenes y tamaños */
.modal-body p {
  margin: 0;
  padding-top: 10px;
}


</style>

