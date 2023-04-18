<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class Address extends Model
{
    protected $fillable = [
        'street',
        'number',
        'city',
        'postal_code',
        'country',
    ];
    use HasFactory, Searchable;

    public function customer() : HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function webshop() : HasOne
    {
        return $this->hasOne(Webshop::class);
    }
}
