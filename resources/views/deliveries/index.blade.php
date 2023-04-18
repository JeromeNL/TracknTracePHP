@extends('layouts.app')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@section('content')
    <h1>{{trans('deliveries.overview_deliveries')}}</h1>
    @can('manage-delivery')
     <h5><a id="import_button" class="btn btn-primary" href="{{route('deliveries.import')}}">{{trans('deliveries.import_deliveries')}}</a></h5>
     <button  id="multiple_labels_button"  type="submit" form="print-labels" class="btn btn-primary mb-2">{{trans('deliveries.printmultiplelabels')}}</button>
    @endcan

    <form method="get" action="{{route('deliveries.search')}}">
        <div class="input-group rounded">
            <input type="search" class="form-control rounded" name="search" placeholder="{{trans('deliveries.search')}}" aria-label="Search"
                   aria-describedby="search-addon"/>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th scope="col">@sortablelink('track_and_trace_code', "Track & trace code")</th>
            <th scope="col">@sortablelink('delivery_status', 'Status')</th>
            <th scope="col">@sortablelink('created_at', trans('deliveries.create_date'))</th>
            <th scope="col">@sortablelink('delivery_company', trans('deliveries.delivery_company'))</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <form id="print-labels" name="print-labels" action="{{route('deliveries.print-labels')}}" method="post">
        @foreach($deliveries as $delivery)
            @csrf
            <input type="hidden" value="PostNL" name="postalService">
            <tr>
                <td><input type="checkbox" name="{{$delivery->id}}"></td>
                <td>{{$delivery->track_and_trace_code}}</td>
                <td>{{$delivery->delivery_status}}</td>
                <td>{{$delivery->created_at}}</td>
                <td>{{$delivery->delivery_company}}</td>
                <td>
                    <div class="dropdown">
                        <button  id="dropdown_button" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{trans('deliveries.actions')}}
                        </button>
                        <div class="dropdown-menu">
                            <a id="dropdown_details" class="dropdown-item" href="{{route('deliveries.show', $delivery->id)}}">Details</a>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </form>
        </tbody>
    </table>

    {{ $deliveries->links() }}

@endsection
