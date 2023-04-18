@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="row">
        <div class="col-md-6 ">
            <h1>{{ trans('pickups.pickup_title') }}</h1>

           <form name="ophalen-aanvragen" method="POST" action="{{route("pickups.request")}}">
               @csrf
               <div class="form-group">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">{{ trans('pickups.select_delivery') }}</label>
                       <select class="form-control m-2" id="delivery_company" name="delivery_company">
                           @foreach($companies as $company)
                               <option value="{{$company->value}}">{{$company->value}}</option>
                           @endforeach
                       </select>
                       <input class="form-control m-2" type="date" id="start_date" name="pickup_date"
                              value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                       <input class="form-control m-2" type="time" id="start_time" name="pickup_time">
                       <input type="submit" class="btn btn-primary m-2" value="{{trans('pickups.request_button')}}"/>
                   </div>
               </div>
           </form>

        </div>

        <div class="col-md-6">
            <h1 class="m-1">{{trans('pickups.upcoming_pickups')}}</h1>
                <div class="container">
                    <div class="row">
                    @if($pickups->count() > 0)
                        <div class="card m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{trans('days.' .date("l", strtotime($pickups->first()->pickup_date)))}} {{$pickups->first()->pickup_date}}</h5>
                                <p>{{trans('pickups.pickupby')}} <b>{{$pickups->first()->delivery_company}}</b> {{trans('pickups.at')}} <b>{{$pickups->first()->pickup_time}}</b></p>
                                <p><b>{{\App\Models\Delivery::where('pickup_id', $pickups->first()->id)->count()}}</b>{{trans('pickups.willbepickedup')}}</p>
                            </div>
                        </div>
                        @endif

                        @if($pickups->count() > 1)
                        <div class="card m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{trans('days.' .date("l", strtotime($pickups->skip(1)->first()->pickup_date)))}} {{$pickups->first()->pickup_date}}</h5>
                                <p>{{trans('pickups.pickupby')}} <b>{{$pickups->skip(1)->first()->delivery_company}}</b>  {{trans('pickups.at')}} <b>{{$pickups->skip(1)->first()->pickup_time}}</b></p>
                                <p><b>{{\App\Models\Delivery::where('pickup_id', $pickups->skip(1)->first()->id)->count()}}</b>{{trans('pickups.willbepickedup')}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if($pickups->count() > 0)
                        <div class="row">
                            <div class="col text-end">
                                <a href="{{ route('pickups.all') }}" class="btn btn-primary mt-2 mx-4">{{trans('pickups.all_pickups')}}</a>
                            </div>
                        </div>
                    @else
                        <p>{{trans('pickups.nopickups')}}</p>
                    @endif
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
