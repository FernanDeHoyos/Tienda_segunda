<nav class="navbar fixed-top bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="/home">
      @auth
        <span class="user-initial">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
      @endauth
      <span class="ms-2">Tienda San Andrez</span>
    </a>
    <div class="d-flex align-items-center">
      @auth
        <span class="me-3">Hola, {{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger">Cerrar sesión</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-primary me-2">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="btn btn-success">Registrarse</a>
      @endauth
    </div>
  </div>
</nav>
@auth
<nav class="navbar fixed-top bg-light" style="top: 50px;"> <!-- Ajusta 'top' según el tamaño del primer navbar -->
  <div class="container d-flex">
   <div>
   <a href="{{ route('productos.index') }}" class="me-3">Lista de Productos</a>
   <a href="{{ route('productos.create') }}" class="">Agregar Producto</a>
   </div>
    <!-- Agrega más enlaces según sea necesario -->
  </div>
</nav>
@endauth
