@extends('layouts.app')

@section('content')
    <h1>{{trans('users.usermang')}}</h1>
    @if (flash()->message)
        <div class="alert alert-success">
            {{ flash()->message }}
        </div>
    @endif
    <a href="/register" id="create_account" class="btn btn-primary">{{trans('users.create_account')}}</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{trans('users.name')}}</th>
            <th scope="col">Email</th>
            <th scope="col">{{trans('users.create_date')}}</th>
            <th scope="col">{{trans('users.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{trans('users.more')}}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('users.edit', $user->id)}}">{{trans('users.edit')}}</a>
                            <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger dropdown-item">{{trans('users.delete')}}</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
