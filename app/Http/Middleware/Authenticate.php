<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // si non connecté au lieu de renvoyer vers la route login on renvoie un réponse json
            throw new HttpResponseException(
                response()->json(["Vous n'êtes pas autorisé à effectuer cette action."], 403)
            );
        }
    }
}
