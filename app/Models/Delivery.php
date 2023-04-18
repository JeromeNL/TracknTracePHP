<?php

namespace App\Models;

use App\Models\enums\CompanyNames;
use App\Models\enums\DeliveryStatus;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Delivery extends Model
{
    use HasFactory, Searchable, Sortable, SoftDeletes;

    public array $sortable = ['id',
        'track_and_trace_code',
        'delivery_status',
        'created_at',
        'updated_at'];

    protected $fillable = [
        'track_and_trace_code',
        'delivery_status',
        'delivery_company',
        'expected_delivery_date',
        'package_id',
        'pickup_id',
    ];



    protected $casts = [
        'delivery_status' => DeliveryStatus::class,
        'delivery_company' => CompanyNames::class,
    ];

    protected $with = ['package', 'package.customer', 'package.webshop', 'package.customer.address', 'package.webshop.address'];

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function pickup() : BelongsTo
    {
        return $this->belongsTo(Pickup::class);
    }

    public function review() : HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'track_and_trace_code' => $this->track_and_trace_code,
            'delivery_status' => $this->delivery_status,
            'delivery_company' => $this->delivery_company,
            'expected_delivery_date' => $this->expected_delivery_date,
            'package_id' => $this->package_id,
            'pickup_id' => $this->pickup_id,
        ];
    }

    protected function makeAllSearchableUsing(EloquentBuilder $query): EloquentBuilder
    {
        return $query->with('package', 'package.customer', 'package.webshop', 'package.customer.address', 'package.webshop.address');
    }

    public function changeStatus(DeliveryStatus $deliveryStatus)
    {
        $this->delivery_status = $deliveryStatus;
        $this->save();
    }

    public function changePostalService(CompanyNames $companyName)
    {
        $this->delivery_company = $companyName;
        $this->save();
    }

    public static function getDeliveriesUserCanAccess(User $user)
    {
        if ($user->hasRole('SuperAdmin')) {
            return Delivery::paginate(15);
        } elseif ($user->webshop) {
            return Delivery::whereHas('package', function ($query) use ($user) {
                $query->where('webshop_id', $user->webshop->id);
            })->paginate(15);
        } elseif ($user->customer) {
            return Delivery::whereHas('package', function ($query) use ($user) {
                $query->where('customer_id', $user->customer->id);
            })->paginate(15);
        }
    }


}
