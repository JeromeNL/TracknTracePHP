@extends('layouts.app')

@section('content')
    <h1>{{trans('users.edit_users')}}</h1>
    <form method="post" action="{{route('users.update', $user)}}">
        @csrf

        @method('PUT')
        <div class="form-group">
            <labeL for="name">{{trans('users.name')}}</labeL>
            <input id="name" type="text" class="form-control" name="name" value="{{old('name') ?? $user->name}}">
        </div>

        <div class="form-group mt-3">
            <label for="roles">{{trans('users.role')}}</label>
            <select multiple name="roles[]" class="form-control" id="roles[]">
                @foreach($roles as $role)
                    <option value="{{$role->id}}"
                        @if($user->roles->contains($role->id))
                            selected
                        @endif
                    >{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="webshop">Webshop</label>
            <select name="webshop" class="form-control" id="webshop">
                @foreach($webshops as $webshop)
                    <option value="{{$webshop->id}}">{{$webshop->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">{{trans('users.save')}}</button>
    </form>
@endsection
