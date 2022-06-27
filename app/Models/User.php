<?php

namespace App\Models;

use App\Models\Traits\GetsTableName;
use App\Models\Traits\UsesUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use UsesUuid;
    use GetsTableName;

    public const ID = 'id';
    public const USERNAME = 'username';
    public const PASSWORD = 'password';
    public const ROLE = 'role';
    public const DEPOSIT = 'deposit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::USERNAME,
        self::PASSWORD,
        self::ROLE,
        self::DEPOSIT
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function products() {
        return $this->hasMany(Product::class, 'seller_id', 'id');
    }
}
