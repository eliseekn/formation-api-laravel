<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Authentication\LogoutUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request, LogoutUseCase $useCase): JsonResponse
    {
        return $useCase->handle(
            $request->user('sanctum')
        );
    }
}
