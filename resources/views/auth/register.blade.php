<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" />
    <title>Registro</title>
    <style>
      body {
          background-color: #343a40; 
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>


<body class="d-flex justify-content-center align-items-center min-vh-100">
 <!-- Section: Design Block -->
<section class="text-center">
  <div class="card mb-3 mx-auto" style="max-width: 400px;">
    <div class="card-body py-5">

      <h2 class="fw-bold mb-5">Crear una cuenta</h2>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div data-mdb-input-init class="form-outline mb-4">
          <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" 
                 name="name" value="{{ old('name') }}" required autofocus placeholder=" " />
          <label class="form-label" for="name">Nombre</label>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
          <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                 name="email" value="{{ old('email') }}" required placeholder=" " />
          <label class="form-label" for="email">Correo Electrónico</label>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
          <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                 name="password" required placeholder=" " />
          <label class="form-label" for="password">Contraseña</label>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <!-- Confirm Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
          <input type="password" id="password-confirm" class="form-control" 
                 name="password_confirmation" required placeholder=" " />
          <label class="form-label" for="password-confirm">Confirmar Contraseña</label>
        </div>

        <!-- Register Button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Registrar</button>

        <!-- Login Link -->
        <div>
          <p class="mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="fw-bold">Inicia sesión aquí</a></p>
        </div>
      </form>

    </div>
  </div>
</section>
<!-- Section: Design Block -->

</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>

</html>