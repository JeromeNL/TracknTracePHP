<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Review extends Model
{

    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'delivery_id',
        'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function delivery() : BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }



}
