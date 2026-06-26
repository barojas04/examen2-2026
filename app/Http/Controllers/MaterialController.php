<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\JsonResponse;

class MaterialController extends Controller
{
    /**
     * Obtener la lista de materiales y las categorías asociadas.
     */
    public function index(): JsonResponse
    {
        $materiales = Material::with('categoria')->get();

        return response()->json($materiales);
    }
}
