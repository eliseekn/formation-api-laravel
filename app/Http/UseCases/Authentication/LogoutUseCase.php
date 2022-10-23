<?php

namespace App\Http\UseCases\Authentication;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class LogoutUseCase
{
    public function handle(User $user): JsonResponse
    {
        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Déconnexion réussie'
        ]);
    }
}