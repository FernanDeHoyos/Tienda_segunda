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
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="top: 60px;">
    <div class="container">
    <div class="navbar-nav">
      <a href="{{ route('productos.index') }}" class="nav-link me-3">Lista de Productos</a>
      <a href="{{ route('productos.create') }}" class="nav-link me-3">Agregar Producto</a>

      <!-- Icono de carrito -->
      <a href="#" class="nav-link d-flex align-items-center" id="cartButton">
      <i class="fas fa-shopping-cart me-1"></i> 
      <span class="badge bg-primary ms-1" id="cart-count">0</span> <!-- Contador de artículos en el carrito -->
      </a>
    </div>
    </div>
  </nav>
@endauth


<!-- Agrega el modal del carrito (antes de </body>) -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="cartItemsContainer"></div>
        <p id="emptyCartMessage" class="text-center text-muted" style="display: none;">El carrito está vacío.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="{{ route('shopping.compras') }}" class="btn btn-primary btn-block">Comprar</a>
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

