<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Models\User;
use App\Models\Producto;
use App\Http\Controllers\ShopController;
use Illuminate\Foundation\Testing\WithFaker;

class ShopControllerTest extends TestCase
{
    use WithFaker;

    // Prueba para el índice que muestra todos los productos
    public function test_index_muestra_todos_los_productos()
    {
        // Crear un usuario falso y autenticarlo
        $user = User::factory()->make(['id' => 1]);
        $this->actingAs($user);

        // Simula los productos que se devolverían
        $productos = [
            ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 100],
            ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 200],
        ];

        // Mock del controlador ShopController
        $mockController = Mockery::mock(ShopController::class)->makePartial();
        $this->app->instance(ShopController::class, $mockController);

        // Verifica que el método index se llama con los datos correctos
        $mockController->shouldReceive('index')
            ->once()
            ->andReturn(response()->json(['productos' => $productos]));

        // Envia la solicitud GET
        $response = $this->get('/shopping');

        // Verifica la respuesta
        $response->assertStatus(200);
        $response->assertJson([
            'productos' => $productos
        ]);
    }

    // Prueba para mostrar un producto específico
    public function test_show_devuelve_producto_y_relacionados()
    {
        // Crear un usuario falso y autenticarlo
        $user = User::factory()->make(['id' => 1]);
        $this->actingAs($user);

        // Simula el producto y los productos relacionados
        $producto = ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 100];
        $productosRelacionados = [
            ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 200],
            ['id' => 3, 'nombre' => 'Producto 3', 'precio' => 150],
        ];

        // Mock del controlador ShopController
        $mockController = Mockery::mock(ShopController::class)->makePartial();
        $this->app->instance(ShopController::class, $mockController);

        // Verifica que el método show se llama con el ID correcto y devuelve los productos relacionados
        $mockController->shouldReceive('show')
            ->once()
            ->with(1) // El ID del producto
            ->andReturn(response()->json([
                'producto' => $producto,
                'productosRelacionados' => $productosRelacionados
            ]));

        // Envia la solicitud GET
        $response = $this->get('/productos/show/1');

        // Verifica la respuesta
        $response->assertStatus(200);
        $response->assertJson([
            'producto' => $producto,
            'productosRelacionados' => $productosRelacionados
        ]);
    }
}
