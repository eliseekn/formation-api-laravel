<?php

namespace App\Http\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class DeleteUseCase
{
    public function handle(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produit supprimé avec succès'
        ]);
    }
}