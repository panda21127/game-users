<?php

namespace App\Domain\GameUsers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 */

class GameUser extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = [];
}
