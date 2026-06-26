<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Material;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente()
    {
        // 1. Preparar los datos del nuevo material y su categoría asociada
        $data = [
            'codigo' => 'MAT-NUEVO-123',
            'unidadMedida' => 'Unidad',
            'descripcion' => 'Descripción del material nuevo',
            'ubicacion' => 'Ubicación 123',
            'idCategoria' => 'CAT-NUEVA-123',
            'nombreCategoria' => 'Nueva Categoría'
        ];

        // 2. Ejecutar la petición HTTP POST al endpoint '/api/materiales'
        $response = $this->postJson('/api/materiales', $data);

        // 3. Aserciones sobre la respuesta HTTP:
        // - Comprobar que el código de estado sea 201 (Created)
        $response->assertStatus(201);

        // - Comprobar la estructura JSON exacta del cuerpo de la respuesta
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'codigo',
                'unidadMedida',
                'descripcion',
                'ubicacion',
                'idCategoria',
                'created_at',
                'updated_at',
                'categoria' => [
                    'idCategoria',
                    'nombre',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);

        // - Comprobar los valores de los datos devueltos en la respuesta JSON
        $response->assertJson([
            'status' => 'success',
            'message' => 'Material insertado con éxito y asociado a su categoría.',
            'data' => [
                'codigo' => 'MAT-NUEVO-123',
                'unidadMedida' => 'Unidad',
                'descripcion' => 'Descripción del material nuevo',
                'ubicacion' => 'Ubicación 123',
                'idCategoria' => 'CAT-NUEVA-123',
                'categoria' => [
                    'idCategoria' => 'CAT-NUEVA-123',
                    'nombre' => 'Nueva Categoría'
                ]
            ]
        ]);

        // 4. Aserciones sobre la base de datos (Persistencia):
        // - Verificar que el registro del material exista con todos sus campos
        $this->assertDatabaseHas('materiales', [
            'codigo' => 'MAT-NUEVO-123',
            'unidadMedida' => 'Unidad',
            'descripcion' => 'Descripción del material nuevo',
            'ubicacion' => 'Ubicación 123',
            'idCategoria' => 'CAT-NUEVA-123'
        ]);

        // - Verificar que la nueva categoría también se haya creado y guardado correctamente
        $this->assertDatabaseHas('categorias', [
            'idCategoria' => 'CAT-NUEVA-123',
            'nombre' => 'Nueva Categoría'
        ]);
    }

    /**
     * Nombre exacto solicitado por el examen (llama al método de prueba)
     */
    public function dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente()
    {
        $this->test_dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente();
    }
}
