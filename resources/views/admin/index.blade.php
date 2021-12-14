@extends('layouts.app')

@section('content')
<div class="container">
    <div>Bienvenido:</div>
    <div>
        <ul>
            <li>Nombre: {{$user->person->name}}</li>
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