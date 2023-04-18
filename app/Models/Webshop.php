<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Webshop extends Model
{
    use HasFactory, Searchable, Sortable, SoftDeletes;

    public array $sortable = ['id',
        'created_at',
        'updated_at'];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'website',
    ];

    public function address() : BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function packages() : HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function employees() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
