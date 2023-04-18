@extends('layouts.app')

@section('content')

    <div class="container ">
        <a href="{{ url('/pickups') }}" class="btn btn-secondary mb-2">{{trans('pickups.back')}}</a>
        <div class="row">
            <div class="col-md">
                <h1 class="m-1">{{trans('pickups.upcoming_pickups')}}</h1>
                <div class="container">
                    <div class="row">
                        @if($pickups->count() == 0)
                            <p>Er zijn geen aankomende ophaalmomenten ingepland.</p>
                        @endif
                        @foreach($pickups as $pickup)
                            <div class="card m-1" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{trans('days.' .date("l", strtotime($pickup->pickup_date)))}} {{$pickup->pickup_date}}</h5>
                                    <p>{{trans('pickups.pickupby')}} <b>{{$pickup->delivery_company}}</b> {{trans('pickups.at')}} <b>{{$pickup->pickup_time}}</b></p>
                                    <p><b>{{\App\Models\Delivery::where('pickup_id', $pickup->id)->count()}}</b>{{trans('pickups.willbepickedup')}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

@endsection
