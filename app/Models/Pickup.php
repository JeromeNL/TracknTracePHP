<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Pickup extends Model
{
    use Searchable;

    protected $fillable = [
        'pickup_date',
        'pickup_time',
        'delivery_company',
    ];

    public function delivery() : HasMany
    {
        return $this->hasMany(Delivery::class);
    }



}
