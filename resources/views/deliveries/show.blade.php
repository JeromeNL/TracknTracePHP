@extends('layouts.app')

<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/stars.css') }}">
</head>

@section('content')
    <h1>{{trans('deliveries.delivery')}} {{$delivery->id}}</h1>
    <div class="accordion" id="detailsbestelling">
        <x-accordion-item number="One" title="{{trans('deliveries.infoAboutReceiver')}}" open="true">
            <p><span class="fw-bold">{{trans('deliveries.customerID')}}</span> {{$customer->id}}</p>
            <p><span class="fw-bold">{{trans('deliveries.name')}}</span> {{$customer->firstname}} {{$customer->lastname}}</p>
            <p><span class="fw-bold">{{trans('deliveries.address')}}</span><br>
                {{$customer->address->street}} {{$customer->address->number}}
                <br>
                {{$customer->address->postal_code}} {{$customer->address->city}}
                <br>
                {{$customer->address->country}}
            </p>
        </x-accordion-item>

        <x-accordion-item number="Two" title="{{trans('deliveries.info_about_delivery')}}">
            <p><span class="fw-bold">Track & trace code:</span> {{$delivery->track_and_trace_code}}</p>
            <p><span class="fw-bold">Status:</span> {{$delivery->delivery_status}}</p>
            <p><span
                    class="fw-bold">{{trans('deliveries.create_date')}}: </span> {{\Carbon\Carbon::parse($delivery->created_at)->format('d/m/Y H:i')}}
            </p>
            <p><span
                    class="fw-bold">{{trans('deliveries.expected_datetime')}}</span> {{ \Carbon\Carbon::parse($delivery->expected_delivery_date)->format('d/m/Y H:i')}}
            @if($delivery->actual_delivery_date != null)
                <p><span
                        class="fw-bold">{{trans('deliveries.real_datetime')}}</span> {{ \Carbon\Carbon::parse($delivery->actual_delivery_date)->format('d/m/Y H:i')}}
                </p>
            @endif
        </x-accordion-item>

        <x-accordion-item number="Three" title="{{trans('deliveries.info_package')}}">
            <p><span class="fw-bold">{{trans('deliveries.package_id')}}:</span> {{$delivery->package->id}}</p>
            <p><span class="fw-bold">{{trans('deliveries.description')}}:</span> {{$delivery->package->description}}</p>
            <p><span class="fw-bold">{{trans('deliveries.weight')}}:</span> {{$delivery->package->weight}} kg</p>
        </x-accordion-item>

        @can('manage-delivery')
            @if($canPrintLabel)
                <x-accordion-item number="Four" title="{{trans('deliveries.printlabel')}}">
                    <h5>{{trans('deliveries.delivery_costs')}}</h5>
                    @foreach($deliveryCosts as $company => $deliveryCost)
                        <p><span class="fw-bold">{{$company}}: </span>@money($deliveryCost)</p>
                    @endforeach
                    <form method="post" action="{{route('delivery.print-delivery-label', $delivery)}}">
                        @csrf
                        <h5 class="form-label">{{trans('deliveries.whichcompany')}}</h5>
                        <select name="postalservice" required>
                            @foreach(array_keys($deliveryCosts) as $company)
                                <option value="{{$company}}">{{$company}}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="hidden" name="delivery" value="{{$delivery}}">
                        <button type="submit" class="btn btn-primary mt-3">{{trans('deliveries.print')}}</button>
                    </form>
                </x-accordion-item>
            @endif
                <x-accordion-item number="Five" title="{{trans('deliveries.showreview')}}">
                   @if($review == null)
                       <p>Er is nog geen review achtergelaten</p>
                    @else
                        <p><bold>{{trans('reviews.rating')}}:</bold> {{$review->rating}}</p>
                        <p><bold>{{trans('reviews.comment')}}:</bold> {{$review->comment}}</p>
                   @endif
                </x-accordion-item>

        @endcan

        @can('review-delivery')
            <x-accordion-item number="Six" title="Review">
                @if($delivery->review)
                    <h5>{{trans('general.reviewed')}}</h5>
                    <p>{{trans('general.thanks_again')}}</p>
                @else
                    <h5>{{trans('general.leave_review')}}</h5>
                    <p>{{trans('general.review_explain')}}</p>

                    <div class="rating-wrap">
                        <div class="center">
                            <form action="/deliveries/review/{{$delivery->id}}" method="POST">
                                @csrf
                                <div class="rating">
                                    <input type="hidden" name="delivery_id"
                                           value="{{$delivery->id}}">
                                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                    <input type="radio" id={{"star5"}} name={{"rating"}} value="5"/>
                                    <label for={{"star5"}} class="full" title="Awesome"></label>
                                    <input type="radio" id={{"star4.5"}} name={{"rating"}} value="4.5"/>
                                    <label for={{"star4.5"}} class="half"></label>
                                    <input type="radio" id={{"star4"}} name={{"rating"}} value="4"/>
                                    <label for={{"star4"}} class="full"></label>
                                    <input type="radio" id={{"star3.5"}} name={{"rating"}} value="3.5"/>
                                    <label for={{"star3.5"}} class="half"></label>
                                    <input type="radio" id={{"star3"}} name={{"rating"}} value="3"/>
                                    <label for={{"star3"}} class="full"></label>
                                    <input type="radio" id={{"star2.5"}} name={{"rating"}} value="2.5"/>
                                    <label for={{"star2.5"}} class="half"></label>
                                    <input type="radio" id={{"star2"}} name={{"rating"}} value="2"/>
                                    <label for={{"star2"}} class="full"></label>
                                    <input type="radio" id={{"star1.5"}} name={{"rating"}} value="1.5"/>
                                    <label for={{"star1.5"}} class="half"></label>
                                    <input type="radio" id={{"star1"}} name={{"rating"}} value="1"/>
                                    <label for={{"star1"}} class="full"></label>
                                    <input type="radio" id={{"star0.5"}} name={{"rating"}} value="0.5"/>
                                    <label for={{"star0.5"}} class="half"></label>
                                </div>
                                <textarea name="comment" class="form-control mb-3" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                                <input type="submit" name="Beoordeel" value="{{trans('general.rate')}}"
                                       class="btn bg-secondary">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                @endif
            </x-accordion-item>
        @endcan
    </div>
    <form action="{{route('deliveries.destroy', $delivery->id)}}" method="POST">
        @csrf
        @method('DELETE')
        @can('manage-delivery')
            <button type="submit" class="mt-3 btn btn-danger">{{trans('webshops.delete')}}</button>
        @endcan
    </form>

    @if(session('message'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('message') }}
        </div>
    @endif
@endsection
