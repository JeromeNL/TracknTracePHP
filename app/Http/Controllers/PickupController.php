<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePickupRequest;
use App\Models\Delivery;
use App\Models\enums\CompanyNames;
use App\Models\enums\DeliveryStatus;
use App\Models\Pickup;
use App\Models\Webshop;
use Illuminate\Http\Request;
use ReflectionClass;
use function PHPUnit\Framework\isEmpty;

class PickupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->webshop) {
            $deliveries = Delivery::whereHas('package', function ($query) {
                $query->where('webshop_id', auth()->user()->webshop->id);
            })->paginate(15);

            $companyNames = array();
            $reflection = new ReflectionClass(CompanyNames::class);
            foreach($reflection->getConstants() as $value){
                $companyNames[] = $value;
            }

            $webshop = auth()->user()->webshop;
            $deliveries = $webshop->deliveries;

            $upcomingPickups = Pickup::where('pickup_date', '>=', date('Y-m-d'))->get();
            $upcomingPickups->take(2);

            return view('pickups.index', [compact('deliveries'), 'companies' => $companyNames, 'pickups' => $upcomingPickups]);
        }
        return view('home');
    }

    public function all(){
        if(auth()->user()->webshop) {
            $deliveries = Delivery::whereHas('package', function ($query) {
                $query->where('webshop_id', auth()->user()->webshop->id);
            })->paginate(15);

            $webshop = auth()->user()->webshop;
            $deliveries = $webshop->deliveries;
            $upcomingPickups = Pickup::where('pickup_date', '>=', date('Y-m-d'))->get();

            return view('pickups.all', [compact('deliveries'),  'pickups' => $upcomingPickups]);
        }
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePickupRequest $request)
    {
        $request->validated();

        $webshop = Webshop::find(auth()->user()->webshop_id);
        $delivery_company = $request->delivery_company;

        $deliveries = Delivery::whereHas('package', function ($query) use ($webshop) {
            $query->where('webshop_id', $webshop->id);
        })->get();

        $currentDeliveries = $deliveries
            ->where('delivery_status', DeliveryStatus::Uitgeprint)
            ->where('delivery_company', CompanyNames::tryFrom($delivery_company));


        if($currentDeliveries->isEmpty()){
            return back()->with('warning', trans('pickups.nopackagestopickup'));
        }
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));
        if($request->pickup_date < $tomorrow){
          return back()->with('warning', trans('pickups.toolate'));
        }

        if($request->pickup_date == date('Y-m-d', strtotime('tomorrow')) &&
              date('H:i:s', strtotime('+2 hours')) > '15:00:00'){
            return back()->with('warning', trans('pickups.toolate'));
        }

        $newPickup = Pickup::create($request->all());

        foreach($currentDeliveries as $delivery){
            $delivery->delivery_status = DeliveryStatus::AangemeldVoorBezorging;
            $delivery->pickup_id = $newPickup->id;
            $delivery->save();
        }
        return back()->with('success',  trans('pickups.packagesrequested', [
            'amount' => $currentDeliveries->count(),
            'delivery_company' => $currentDeliveries->first()->delivery_company->value,
            'pickup_date' => $newPickup->pickup_date,
            ]));
    }
}
