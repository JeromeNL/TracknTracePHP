@extends('layouts.app')

@section('content')
    <h1>Webshops</h1>
    @if (flash()->message)
        <div class="alert alert-success">
            {{ flash()->message }}
        </div>
    @endif
    <a href="{{route('webshops.create')}}" class="btn btn-primary">{{trans('webshops.create_webshop')}}</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">@sortablelink('ID')</th>
            <th scope="col">{{trans('webshops.company')}}</th>
            <th scope="col">{{trans('webshops.create_date')}}</th>
            <th scope="col">{{trans('webshops.more')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($webshops as $webshop)
            <tr>
                <th scope="row">{{$webshop->id}}</th>
                <td>{{$webshop->name}}</td>
                <td>{{$webshop->created_at}}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{trans('webshops.actions')}}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('webshops.show', $webshop->id)}}">{{trans('webshops.details')}}</a>
                            <a class="dropdown-item" href="{{route('webshops.edit', $webshop->id)}}">{{trans('webshops.edit')}}</a>

                            <form action="{{route('webshops.destroy', $webshop->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger dropdown-item">{{trans('webshops.delete')}}</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $webshops->links() }}
@endsection
