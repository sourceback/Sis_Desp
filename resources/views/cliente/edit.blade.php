@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Editar {{ $arrInfo['ruta'] }}</h5>
          <p class="category">usuario {{ $arrInfo['ruta'] }}</p>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route($arrInfo['ruta'].'.update', $arrInfo['arrRecord']['id']) }}" >
            @csrf
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" max="100"  name="nombre" value="{{ old('name', $arrInfo['arrRecord']['nombre']) }}">
                  @error('nombre')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-5 pr-1">
                <div class="form-group">
                  <label>Clave</label>
                  <input type="text" class="form-control" max="45"  name="clave" value="{{ old('clave', $arrInfo['arrRecord']['clave']) }}">
                  @error('clave')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label for="exampleInputEstatu1">Estatus</label>
                  <select class="form-control" name="estatus">
                      <option class="form-control" value="1" @if($arrInfo['arrRecord']['estatus']==1) selected="" @endif>Activo</option>
                      <option class="form-control" value="0" @if($arrInfo['arrRecord']['estatus']==0) selected="" @endif>Baja</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label for="exampleInputEstatu1">Tipo</label>
                  <select class="form-control" name="tipo">
                      <option class="form-control" value="1" @if($arrInfo['arrRecord']['tipo']==1) selected="" @endif>MORAL</option>
                      <option class="form-control" value="0" @if($arrInfo['arrRecord']['tipo']==0) selected="" @endif>FISICA</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Direccion</label>
                  <input type="text" class="form-control" max="100" name="direccion" value="{{ old('direccion', $arrInfo['arrRecord']['direccion']) }}">
                  @error('direccion')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-2 pr-1">
                <div class="form-group">
                  <label>RFC</label>
                  <input type="text" class="form-control" max="45" name="rfc" value="{{ old('rfc', $arrInfo['arrRecord']['rfc']) }}">
                  @error('rfc')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Ciudad</label>
                  <input type="text" class="form-control" max="45"  name="ciudad" value="{{ old('ciudad', $arrInfo['arrRecord']['ciudad']) }}">
                  @error('ciudad')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Codigo postal</label>
                  <input type="text" class="form-control" max="45"  name="codigo_postal" value="{{ old('codigo_postal', $arrInfo['arrRecord']['codigo_postal']) }}">
                  @error('codigo_postal')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>Telefono</label>
                  <input type="text" class="form-control" max="45" name="telefono" value="{{ old('telefono', $arrInfo['arrRecord']['telefono']) }}">
                  @error('telefono')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-8 pr-1">
                <div class="form-group">
                  <label>Correo</label>
                  <input type="text" class="form-control" max="45" name="correo" value="{{ old('correo', $arrInfo['arrRecord']['correo']) }}">
                  @error('correo')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Profesion</label>
                  <input type="text" class="form-control" max="45" name="profesion" value="{{ old('profesion', $arrInfo['arrRecord']['profesion']) }}">
                  @error('profesion')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label>Comentario</label>
                    <textarea rows="4" name="comentarios" class="form-control" value="{{ old('comentarios', $arrInfo['arrRecord']['comentarios']) }}"></textarea>
                    @error('comentarios')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
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