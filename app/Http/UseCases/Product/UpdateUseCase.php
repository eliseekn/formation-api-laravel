<?php

namespace App\Http\UseCases\Product;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class UpdateUseCase
{
    public function handle(Product $product, array $data): JsonResponse
    {
        $product->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Produit modifié avec succès'
        ]);
    }
}