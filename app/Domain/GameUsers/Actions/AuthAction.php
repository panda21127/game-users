<?php

namespace App\Domain\GameUsers\Actions;

use App\Domain\GameUsers\Models\GameUser;
use Illuminate\Validation\UnauthorizedException;

class AuthAction
{
    public function execute(array $data)
    {
        try {
            $user = GameUser::where('username', $data['username'])->first();
            if ($user->password === $data['password']) {
                print($user->id);
                return $user->id;
            } else {
                throw new UnauthorizedException("Wrong password");
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
