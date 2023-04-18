@extends('layouts.app')

@section("content")
    <h1>Webshop bewerken</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{route('webshops.update', $webshop)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{trans('webshops.company')}}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{old('name') ?? $webshop->name}}">
        </div>
        <h5 class="mt-4">{{trans('webshops.address_details')}}</h5>
        <div class="form-group">
            <label for="street">{{trans('webshops.street')}}</label>
            <input id="street" type="text" class="form-control" name="street" value="{{old('street') ?? $webshop->address->street}}">
        </div>
        <div class="form-group">
            <label for="number">{{trans('webshops.housenumber')}}</label>
            <input id="number" type="text" class="form-control" name="number" value="{{old('number') ?? $webshop->address->number}}">
        </div>
        <div class="form-group">
            <label for="postal_code">{{trans('webshops.postalcode')}}</label>
            <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{old('postal_code') ?? $webshop->address->postal_code}}">
        </div>
        <div class="form-group">
            <label for="city">{{trans('webshops.place')}}</label>
            <input id="city" type="text" class="form-control" name="city" value="{{old('city') ?? $webshop->address->city}}">
        </div>
        <div class="form-group">
            <label for="country">{{trans('webshops.country')}}</label>
            <input id="country" type="text" class="form-control" name="country" value="{{old('country') ?? $webshop->address->country}}">
        </div>
        <h5 class="mt-4">{{trans('webshops.contact_details')}}</h5>
        <div class="form-group">
            <label for="phone">{{trans('webshops.phonenumber')}}</label>
            <input id="phone" type="text" class="form-control" name="phone" value="{{old('phone') ?? $webshop->phone}}">
        </div>
        <div class="form-group">
            <label for="email">{{trans('webshops.email')}}</label>
            <input id="email" type="text" class="form-control" name="email" value="{{old('email') ?? $webshop->email}}">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input id="website" type="text" class="form-control" name="website" value="{{old('website') ?? $webshop->website}}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">{{trans('webshops.save')}}</button>
    </form>
@endsection
