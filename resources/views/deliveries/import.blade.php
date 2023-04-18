@extends('layouts.app')

@section('content')
    <h1>{{trans('deliveries.import_orders')}}</h1>

    @if (flash()->message)
        <div class="alert alert-danger" role="alert">
            {{flash()->message}}
        </div>
    @endif

    <p class="text-danger">{{trans('deliveries.warning')}}</p>

    <h5>{{trans('deliveries.requirements_file')}}</h5>
    <p>{{trans('deliveries.explain')}}</p>
    <ul>
        <li>expected_delivery_date</li>
        <li>description</li>
        <li>weight</li>
        <li>customer_firstname</li>
        <li>customer_lastname</li>
        <li>customer_email</li>
        <li>customer_phone</li>
        <li>customer_street</li>
        <li>customer_housenumber</li>
        <li>customer_city</li>
        <li>customer_postalcode</li>
        <li>customer_country</li>
    </ul>

    <p>{{trans('deliveries.template')}} <a href="{{route('deliveries.importexample')}}">{{trans('deliveries.file')}}</a></p>

    <form action="{{route('deliveries.import')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">{{trans('deliveries.file')}}</label>
            <input class="form-control" type="file" accept=".csv,.xlsx" id="file" name="file">
        </div>
        <button id="import_button" type="submit" class="btn btn-primary">{{trans('deliveries.import')}}</button>
@endsection
