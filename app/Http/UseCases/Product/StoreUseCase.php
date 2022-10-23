<?php

namespace App\Http\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class StoreUseCase
{
    public function handle(array $data): JsonResponse
    {
        Product::factory()->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Produit enregistré avec succès'
        ]);
    }
}