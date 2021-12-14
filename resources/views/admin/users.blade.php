@extends('layouts.app')

@section('content')
<div class="container">

    <div class="navmenu">
        Usuarios / <a href="{{url('/admin/nuevo')}}" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="centro">
        lista de usuarios
    </div>
</div>
@endsection