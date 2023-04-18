@extends('layouts.app')

@section('content')
    <h1>Webshop {{$webshop->name}}</h1>
    <div class="row">
        <div class="col-6">
            <h5>{{trans('webshops.address_details')}}</h5>
            <p>{{$webshop->address->street}} {{$webshop->address->number}}</p>
            <p>{{$webshop->address->postal_code}} {{$webshop->address->city}}</p>
            <p>{{$webshop->address->country}}</p>
        </div>
        <div class="col-6">
            <h5>{{trans('webshops.contact_details')}}</h5>
            <p>{{trans('webshops.phonenumber')}}: {{$webshop->phone}}</p>
            <p>{{trans('webshops.email')}}: <a href="mailto: {{$webshop->email}}">{{$webshop->email}}</a></p>
            <p>Website: <a href="{{$webshop->website}}">{{$webshop->website}}</a></p>
        </div>
@endsection
