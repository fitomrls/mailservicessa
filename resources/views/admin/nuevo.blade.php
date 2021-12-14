@extends('layouts.app')

@section('content')
<div class="container">

    <div class="navmenu">
        <a href="{{url('/admin/usuarios')}}" class="btn btn-primary">Usuarios</a>
        / Nuevo
    </div>

    <div class="form-nuevo" id="user-form">
        <form>
            <div class="mb-3">
                <label for="identifier" class="form-label">Identificador</label>
                <input type="number" class="form-control" id="inputidentifier" aria-describedby="identifierHelp">                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="inputNombre" aria-describedby="nombrelHelp">                
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="number" class="form-control" name="inputCelular" aria-describedby="celularlHelp">
            </div>
            <div class="mb-3">
                <label for="docid" class="form-label">Cédula</label>
                <input type="text" class="form-control" name="inputDocId" aria-describedby="docIdlHelp">                
            </div>
            <div class="mb-3">
                <label for="bdate" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="inpuBdate" aria-describedby="bDateHelp">                
            </div>
            <div class="mb-3">
                <label for="citycod" class="form-label">Cod. Ciudad</label>
                <input type="citycod" class="form-control" name="citycod" aria-describedby="cityCodHelp">                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Repetir Password</label>
                <input type="repassword" class="form-control" id="exampleInputRePassword1">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $("#user-form").submit(function(e){
        var identi = $("#inputidentifier").val();
        console.log("identi", identi);
        return false;
    });
</script>

@endsection