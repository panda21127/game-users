<?php

namespace App\Http\ApiV1\Modules\GameUsers\Controllers;

use App\Domain\GameUsers\Actions\AuthAction;
use App\Domain\GameUsers\Actions\RegisterAction;
use App\Http\ApiV1\Modules\GameUsers\Requests\GameUserRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(GameUserRequest $request, RegisterAction $action): Application|\Illuminate\Http\Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        try {
            $validated = $request->validated();
            $action->execute($validated);
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'errors' => [['code' => $e->getCode(), 'message' => $e->getMessage()]]], $e->getCode());
        }

        return response(null, Response::HTTP_ACCEPTED);
    }

    public function auth(GameUserRequest $request, AuthAction $action): JsonResponse
    {
        try {
            $validated = $request->validated();
            $returned_data = $action->execute($validated);

            return response()->json(['data' => ['id' => $returned_data]], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'errors' => [['code' => $e->getCode(), 'message' => $e->getMessage()]]], $e->getCode());
        }
    }
}
