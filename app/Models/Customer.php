<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    public function address() : BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function user() : HasOne
    {
        return $this->hasOne(User::class);
    }


}


