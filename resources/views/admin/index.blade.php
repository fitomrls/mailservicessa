@extends('layouts.app')

@section('content')
<div class="container">

    <div class="navmenu">
        <a href="{{url('admin/users')}}" class="btn btn-primary">Usuarios</a>
    </div>

    <h1 class="user-name">Bienvenido: <span>{{$user->person->name}}</span></h1>
    <div class="centro">
        <ul class="user-info">
            <li>Email: {{$user->email}}</li>
            <li>Identificador: {{$user->person->identifier}}</li>
            <li>Celular: {{$user->person->mobile}}</li>
            <li>ID: {{$user->person->docid}}</li>
            <li>Fecha Nac: {{$user->person->bdate}}</li>
            <li>Cod Ciudad: {{$user->person->citycod}}</li>
        </ul>
    </div>
</div>
@endsection