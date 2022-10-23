<?php

namespace App\Http\UseCases\Authentication;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginUseCase
{
    public function handle(array $data): JsonResponse
    {
        $user = User::query()
            ->where('email', $data['email'])
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Adresse email ou mot de passe incorrecte'
            ], 401);
        }

        //envoi de la réponse avec un json_encode
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $user->createToken('client-token')->plainTextToken
        ]);
    }
}