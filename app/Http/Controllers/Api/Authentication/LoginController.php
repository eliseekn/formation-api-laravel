<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\UseCases\Authentication\LoginUseCase;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, LoginUseCase $useCase): JsonResponse
    {
        return $useCase->handle(
            $request->validated()
        );
    }
}
