<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Verzendlabel</title>
    <link rel="stylesheet" href="{{resource_path() . '/css/label.css'}}">
</head>
<body>
    @foreach($deliveries as $delivery)
        <div class="label">
        {{$postalService}}
        <div class="Content">
            <div class="Receiver">
                Ontvanger:
                <h2>{{$delivery->package->customer->firstname}} {{$delivery->package->customer->lastname}}</h2>
                <p>
                    {{$delivery->package->customer->address->street}} {{$delivery->package->customer->address->number}}<br>
                    {{$delivery->package->customer->address->postal_code}} {{$delivery->package->customer->address->city}}<br>
                    {{$delivery->package->customer->address->country}}
                </p>
            </div>
            <div class="Sender">
                Afzender:
                <h2>{{$delivery->package->webshop->name}}</h2>
                <p>
                    {{$delivery->package->webshop->address->street}} {{$delivery->package->webshop->address->number}}<br>
                    {{$delivery->package->webshop->address->postal_code}} {{$delivery->package->webshop->address->city}}<br>
                    {{$delivery->package->webshop->address->country}}
                </p>
            </div>

            <div class="qrcode">
                <img alt="Qr code" src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate(route('deliveries.show', $delivery))) !!} ">
            </div>

            <div class="track-and-trace">
                <p>Track en trace code: {{$delivery->track_and_trace_code}}</p>
            </div>
        </div>
        </div>
    @endforeach
</body>
</html>
