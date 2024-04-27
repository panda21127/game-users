<?php

namespace App\Http\ApiV1\Modules\GameUsers\Controllers;

use App\Domain\GameUsers\Actions\AuthAction;
use App\Domain\GameUsers\Actions\RegisterAction;
use App\Http\ApiV1\Modules\GameUsers\Requests\GameUserRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(GameUserRequest $request, RegisterAction $action): Application|\Illuminate\Http\Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        try {
            $validated = $request->validated();
            $error = $action->execute($validated);
            if ($error != null) {
                return response()->json($error->getMessage(), 400);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

        return response(null, Response::HTTP_ACCEPTED);
    }

    public function auth(GameUserRequest $request, AuthAction $action): JsonResponse
    {
        try {
            $validated = $request->validated();
            $returned_data = $action->execute($validated);
            if ($returned_data instanceof \Exception) {
                return response()->json($returned_data->getMessage(), 401);
            } else {
                return response()->json(['data' => $returned_data], 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
