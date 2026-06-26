<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Material;
use Illuminate\Http\JsonResponse;
=======
use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
>>>>>>> 1cdd63a812214f83d7c1990c546eaa3868e2bd42

class MaterialController extends Controller
{
    /**
<<<<<<< HEAD
     * Obtener la lista de materiales y las categorías asociadas.
     */
    public function index(): JsonResponse
    {
        $materiales = Material::with('categoria')->get();

        return response()->json($materiales);
=======
     * Almacena un nuevo material en la base de datos y lo asocia a una categoría.
     * Si la categoría no existe, la crea dinámicamente.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|unique:materiales,codigo',
            'unidadMedida' => 'required|string',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'idCategoria' => 'required|string',
            'nombreCategoria' => 'nullable|string', // Nombre opcional si se crea la categoría
        ], [
            'codigo.required' => 'El código del material es requerido.',
            'codigo.unique' => 'El código del material ya existe en la base de datos.',
            'unidadMedida.required' => 'La unidad de medida es requerida.',
            'descripcion.required' => 'La descripción es requerida.',
            'ubicacion.required' => 'La ubicación es requerida.',
            'idCategoria.required' => 'El ID de la categoría es requerido.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Usamos una transacción para asegurar la consistencia
            $result = DB::transaction(function () use ($request) {
                // 2. Buscar o crear la categoría asociada
                $categoria = Categoria::firstOrCreate(
                    ['idCategoria' => $request->idCategoria],
                    ['nombre' => $request->nombreCategoria ?? 'Categoría ' . $request->idCategoria]
                );

                // 3. Crear el material
                $material = Material::create([
                    'codigo' => $request->codigo,
                    'unidadMedida' => $request->unidadMedida,
                    'descripcion' => $request->descripcion,
                    'ubicacion' => $request->ubicacion,
                    'idCategoria' => $categoria->idCategoria,
                ]);

                // Cargar la relación para la respuesta
                $material->load('categoria');

                return $material;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Material insertado con éxito y asociado a su categoría.',
                'data' => $result
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error al insertar el material.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar un material existente.
     */
    public function update(Request $request, $codigo)
    {
        $material = Material::find($codigo);

        if (!$material) {
            return response()->json([
                'status' => 'error',
                'message' => 'Material no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'unidadMedida' => 'sometimes|required|string',
            'descripcion' => 'sometimes|required|string',
            'ubicacion' => 'sometimes|required|string',
            'idCategoria' => 'sometimes|required|string',
            'nombreCategoria' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::transaction(function () use ($request, $material) {
                if ($request->has('idCategoria')) {
                    $categoria = Categoria::firstOrCreate(
                        ['idCategoria' => $request->idCategoria],
                        ['nombre' => $request->nombreCategoria ?? 'Categoría ' . $request->idCategoria]
                    );
                    $material->idCategoria = $categoria->idCategoria;
                }

                if ($request->has('unidadMedida')) $material->unidadMedida = $request->unidadMedida;
                if ($request->has('descripcion')) $material->descripcion = $request->descripcion;
                if ($request->has('ubicacion')) $material->ubicacion = $request->ubicacion;

                $material->save();
            });

            // Recargar la relación
            $material->load('categoria');

            return response()->json([
                'status' => 'success',
                'message' => 'Material actualizado con éxito.',
                'data' => $material
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error al actualizar el material.',
                'error' => $e->getMessage()
            ], 500);
        }
>>>>>>> 1cdd63a812214f83d7c1990c546eaa3868e2bd42
    }
}
