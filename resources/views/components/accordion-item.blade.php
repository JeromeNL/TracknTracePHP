@props(['number', 'title', 'open' => false])

<div class="accordion-item">
    <h3 class="accordion-header">
        <button class="accordion-button {{$open ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$number}}"
                aria-expanded="true" aria-controls="collapse{{$number}}">{{$title}}
        </button>
    </h3>
    <div id="collapse{{$number}}" class="accordion-collapse collapse {{$open ? 'show' : ''}}" aria-labelledby="heading{{$number}}">
        <div class="accordion-body">
            {{ $slot }}
        </div>
    </div>
</div>
