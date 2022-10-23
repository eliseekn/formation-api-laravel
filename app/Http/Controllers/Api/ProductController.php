<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Http\Requests\Api\Product\UpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\UseCases\Product\DeleteUseCase;
use App\Http\UseCases\Product\StoreUseCase;
use App\Http\UseCases\Product\UpdateUseCase;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function store(StoreRequest $request, StoreUseCase $useCase): JsonResponse
    {
        return $useCase->handle(
            $request->validated()
        );
    }

    public function update(UpdateRequest $request, UpdateUseCase $useCase, Product $product): JsonResponse
    {
        return $useCase->handle(
            $product, $request->validated()
        );
    }

    public function destroy(DeleteUseCase $useCase, Product $product): JsonResponse
    {
        return $useCase->handle($product);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    public function index(): ProductCollection
    {
        return new ProductCollection(
            Product::query()->paginate()
        );
    }
}
