<?php

namespace App\Models;

use App\Models\Traits\GetsTableName;
use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use GetsTableName;
    use UsesUuid;

    public const ID = 'id';
    public const NAME = 'name';
    public const AMOUNT_AVAILABLE = 'amount_available';
    public const COST = 'cost';
    public const SELLER_ID = 'seller_id';

    protected $fillable = [
        self::ID,
        self::NAME,
        self::AMOUNT_AVAILABLE,
        self::COST,
        self::SELLER_ID,
    ];


    public function seller() {
        return $this->belongsTo(Seller::class);
    }
}
