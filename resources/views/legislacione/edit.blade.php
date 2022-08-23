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
                  <input type="text" class="form-control" max="45" name="clave" value="{{ old('clave', $arrInfo['arrRecord']['clave']) }}">
                  @error('clave')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label for="exampleInputEstatu1">Estatus</label>
                  <select class="form-control" name="estatus">
                      <option class="form-control" value="1" @if($arrInfo['arrRecord']['estatus']==1) selected="" @endif>Activo</option>
                      <option class="form-control" value="0" @if($arrInfo['arrRecord']['estatus']==0) selected="" @endif>Baja</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2 pr-1">
                <div class="form-group">
                  <label for="exampleInputEstatu1">Tipo de legislacion</label>
                  <select class="form-control" name="tipo">
                      <option class="form-control" value="ESTATAL" @if($arrInfo['arrRecord']['tipo']=='ESTATAL') selected="" @endif>ESTATAL</option>
                      <option class="form-control" value="FEDERAL" @if($arrInfo['arrRecord']['tipo']=='FEDERAL') selected="" @endif>FEDERAL</option>
                      <option class="form-control" value="MUNICIPAL" @if($arrInfo['arrRecord']['tipo']=='MUNICIPAL') selected="" @endif>MUNICIPAL</option>
                  </select>
                </div>
              </div>
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
              <button type="button" id="BtnArchivo" name="BtnArchivo" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-folder"></i></button>
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
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Archivos</h5>
        </div>
        <div class="card-body">
            <div class="col-md-12" >
            <div class="row">
            @foreach($arrInfo['arrRecord']->archivolegislaciones as $row)
            <div style="text-align:center; padding-left: 20px;padding-right: 20px; ">
            <img src="/documento.png"><p>{{ $row->nombre }}</p>
            <div style="text-align: center;">

              <form method="post" id="frmDescargar" role="form"  name="frmDescargar" action="{{ route($arrInfo['ruta'].'.download', $row->id ) }}">
                @csrf
                    <button type="submit" id="BtnDescargarImagen" name="BtnDescargarImagen" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-circle-arrow-down"></i></button>
                </form>

                <form method="post" id="frmEliminarImagen" role="form" name="frmEliminarImagen" action="{{ route($arrInfo['ruta'].'.eliminarimagen', $row->id ) }}">
                @csrf
                @method('DELETE')
                    <button type="submit" id="BtnEliminarImagen"  name="BtnEliminarImagen" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i></button>
                </form>

            </div>
            </div>
            @endforeach
            </div>  
            </div>
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
  document.getElementById("BtnArchivo").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.archivolegislaciones', $arrInfo['arrRecord']['id']) }}";  
  };

</script>
@endsection