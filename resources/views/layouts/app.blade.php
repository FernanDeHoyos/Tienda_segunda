<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset(path: 'assets/styles.css')}}">
    <style>
        .user-initial {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            margin-right: 8px;
            font-size: 1rem;
        }
        .navbar-brand-centered {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
    <title>Home</title>
</head>
<body>

@include('layouts.navbar')


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"
></script>
</body>
</html>
