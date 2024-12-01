<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Models\User;
use App\Http\Controllers\PedidoController;
use Illuminate\Foundation\Testing\WithFaker;

class PedidoControllerTest extends TestCase
{
    use WithFaker;

    public function test_guardar_pedido_exitoso()
    {
        // Crea un usuario falso y autentícalo
        $user = User::factory()->make(['id' => 1]); // `make` no persiste en la base de datos
        $this->actingAs($user);

        // Simula un carrito de compras
        $carrito = [
            ['id_producto' => 1, 'precio' => 100, 'cantidad' => 2],
            ['id_producto' => 2, 'precio' => 50, 'cantidad' => 1],
        ];

        // Mock del controlador
        $mockController = Mockery::mock(PedidoController::class)->makePartial();
        $this->app->instance(PedidoController::class, $mockController);

        // Verifica que se llame al método esperado con los datos correctos
        $mockController->shouldReceive('guardarPedido')
            ->once()
            ->with(Mockery::on(function ($request) use ($carrito) {
                return $request->carrito === json_encode($carrito) &&
                    $request->direccion_envio === 'Calle Falsa 123';
            }))
            ->andReturn(response()->json(['success' => 'Pedido realizado con éxito.'], 200));

        // Envía la solicitud POST
        $response = $this->post('/guardar-pedido', [
            'carrito' => json_encode($carrito),
            'direccion_envio' => 'Calle Falsa 123',
        ]);

        // Verifica la respuesta
        $response->assertStatus(200);
        $response->assertJson(['success' => 'Pedido realizado con éxito.']);
    }

    public function test_guardar_pedido_falla_con_carrito_vacio()
    {
        // Crea un usuario falso y autentícalo
        $user = User::factory()->make(['id' => 1]);
        $this->actingAs($user);

        // Mock del controlador
        $mockController = Mockery::mock(PedidoController::class)->makePartial();
        $this->app->instance(PedidoController::class, $mockController);

        // Verifica que se llame al método esperado con un carrito vacío
        $mockController->shouldReceive('guardarPedido')
            ->once()
            ->with(Mockery::on(function ($request) {
                return $request->carrito === json_encode([]) &&
                    $request->direccion_envio === 'Calle Falsa 123';
            }))
            ->andReturn(response()->json(['error' => 'El carrito está vacío.'], 400));

        // Envía un carrito vacío
        $response = $this->post('/guardar-pedido', [
            'carrito' => json_encode([]),
            'direccion_envio' => 'Calle Falsa 123',
        ]);

        // Verifica la respuesta
        $response->assertStatus(400);
        $response->assertJson(['error' => 'El carrito está vacío.']);
    }
}
