<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
           StackR
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth()
                <ul class="navbar-nav me-auto">
                    @can('show-delivery')
                        <li class="nav-item"><a class="nav-link" href="{{route('deliveries.index')}}">{{trans('general.deliveries')}}</a></li>
                    @endcan
                    @can('manage-delivery')
                        <li class="nav-item"><a class="nav-link" href="{{route('pickups.index')}}">{{trans('general.pickups')}}</a></li>
                    @endcan

                    @can('manage-users')
                        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">{{trans('general.usermanagement')}}</a>
                        <li class="nav-item"><a class="nav-link" href="{{route('webshops.index')}}">{{trans('general.webshops')}}</a></li>
                        </li>
                    @endcan
                </ul>
            @endauth

            <div class="dropdown">
                <button id="current_language" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{app()->getLocale() == 'en' ? 'English' : ''}}
                    {{app()->getLocale() == 'nl' ? 'Nederlands' : ''}}
                    {{app()->getLocale() == 'de' ? 'Deutsch' : ''}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url('locale/en')}}">{{trans('general.english')}} </a></li>
                    <li><a class="dropdown-item" href="{{url('locale/nl')}}">{{trans('general.dutch')}}</a></li>
                    <li><a class="dropdown-item" href="{{url('locale/de')}}">{{trans('general.german')}}</a></li>
                </ul>
            </div>

            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{trans('general.login')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customers.register') }}">{{trans('general.register')}}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a id="logout_button" class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                {{ trans('general.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
