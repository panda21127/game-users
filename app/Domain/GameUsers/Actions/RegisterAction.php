<?php

namespace App\Domain\GameUsers\Actions;

use App\Domain\GameUsers\Models\GameUser;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RegisterAction
{
    public function execute(array $data): ?\Exception
    {
        $user = new GameUser();
        if (GameUser::where('username', $data['username'])->exists()) {
            throw new BadRequestException("User already exists");
        }
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->save();

        return null;
    }
}
