@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Editar {{ $arrInfo['ruta'] }}</h5>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route($arrInfo['ruta'].'.update', $arrInfo['arrRecord']['id']) }}" >
            @csrf
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $arrInfo['arrRecord']['name']) }}">
                  </div>
                </div>
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username', $arrInfo['arrRecord']['username']) }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $arrInfo['arrRecord']['email']) }}">
                  </div>
                </div>
                  <div class="col-md-2 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEstatu1">Estatus</label>
                      <select class="form-control" name="estatus">
                          <option class="form-control" value="1" @if($arrInfo['arrRecord']['estatus']==1) selected="" @endif>Activo</option>
                          <option class="form-control" value="0" @if($arrInfo['arrRecord']['estatus']==0) selected="" @endif>Baja</option>
                      </select>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contrase??a</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                  </div>
                </div>
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirmar contrase??a</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                  </div>
                </div>
              </div>
            </div>
            <div style="border-top: 2px solid gray; opacity: 0.5;">
              <button type="submit" id="BtnActualizar" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip"><i class="fa-solid fa-user-pen"></i></button>
              <button type="button" id="BtnRegresar" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-arrow-left-long"></i></button>
              <button type="button" id="BtnEliminar" name="BtnEliminar" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-trash"></i></button>
            </div>
          </form>
          <form method="post" id="frmEliminar" role="form" action="{{ route($arrInfo['ruta'].'.destroy', $arrInfo['arrRecord']['id']) }}">
            @csrf
            @method('DELETE')
          </form>
        </div>
    </div>
  </div>
</div>
</div>

<script>
  var frmEliminar = document.getElementById('frmEliminar')

  document.getElementById("BtnRegresar").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.index') }}";  
  };
  
  document.getElementById("BtnEliminar").onclick = function( event ) {
    event.preventDefault();
    frmEliminar.submit();
  };

</script>
@endsection