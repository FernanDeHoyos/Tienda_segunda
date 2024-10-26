<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Aquí puedes agregar algunos estilos CSS si lo deseas */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, {{ Auth::user()->nombre }}</h1>
    <p>Email: {{ Auth::user()->email }}</p>
    <!-- Muestra otros datos del usuario según sea necesario -->
</body>
</html>
