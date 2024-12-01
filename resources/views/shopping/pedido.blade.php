@extends('layouts.app')

@section('show')
<div class="container mt-5">
    <div class="alert alert-success">
        ¡Pedido realizado con éxito! Recibirás un correo de confirmación en breve.
    </div>

    <!-- Mostrar los pedidos realizados -->
    <h3 class="mt-4">Tus Pedidos</h3>
    @if($pedidos->isEmpty())
        <p>No has realizado ningún pedido aún.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <!-- Convertir la fecha a Carbon si es necesario -->
                        <td>{{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}</td>
                        <td>${{ number_format($pedido->total, 2) }}</td>
                        <td>{{ $pedido->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('home') }}" class="btn btn-primary">Volver a la tienda</a>
</div>
@endsection
