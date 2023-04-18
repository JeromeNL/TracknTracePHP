<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Laravel\Scout\Searchable;

class Package extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'description',
        'weight',
        'customer_id',
        'webshop_id',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function webshop() : BelongsTo
    {
        return $this->belongsTo(Webshop::class);
    }

    public function delivery() : HasMany
    {
        return $this->hasMany(Delivery::class);
    }

    public function CalculateDeliveryCost() : array
    {
        $postNL = $this->weight * 0.5;
        $DHL = $this->weight * 0.4 + 5;
        $UPS = $this->weight * 0.3 + 10;

        return [
            'PostNL' => $postNL,
            'DHL' => $DHL,
            'UPS' => $UPS,
        ];
    }
}
