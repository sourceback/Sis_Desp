@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Crear {{ $arrInfo['ruta'] }}</h5>
          <p class="category">formulario {{ $arrInfo['ruta'] }}</p>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route($arrInfo['ruta'].'.store') }}" >
            @csrf
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="subTitulos">Concepto</label>
                  <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $arrInfo['arrRecord']['nombre']) }}">
                  @error('nombre') <small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label class="subTitulos">Clave</label>
                  <input type="text" class="form-control" name="clave" value="{{ old('clave', $arrInfo['arrRecord']['clave']) }}">
                  @error('clave')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                <label class="subTitulos">Estatus</label>
              <div class="form-group">
                <select class="form-control" id="estatus" name="estatus">
                    <option class="form-control" value="1" @if($arrInfo['arrRecord']['estatus']==1) selected="" @endif>Activo</option>
                    <option class="form-control" value="0" @if($arrInfo['arrRecord']['estatus']==0) selected="" @endif>Baja</option>
                </select>
                </div>
              </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="subTitulos">Monto</label>
                  <input type="text" class="form-control" maxlength="9" name="monto" value="{{ old('monto', $arrInfo['arrRecord']['monto']) }}">
                  @error('monto') <small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFechaH1">Fecha</label>
                  <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d',strtotime(old('fecha', $arrInfo['arrRecord']['fecha']))) }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="subTitulos">Estado de la cuenta</label>
              <div class="form-group">
                <select class="form-control" id="estado" name="estado">
                    <option class="form-control" value="1" @if($arrInfo['arrRecord']['estado']==1) selected="" @endif>Pagado</option>
                    <option class="form-control" value="0" @if($arrInfo['arrRecord']['estado']==0) selected="" @endif>No pagado</option>
                </select>
                </div>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="subTitulos">Expediente</label>
                    <div class="select-conteiner">
                      <select class="select" name="expediente_id" id="expediente_id" >
                          <?php $expedientes = App\Models\Expediente::where('estatus', 1)->where('id', old('expediente_id', $arrInfo['arrRecord']['expediente_id']))->limit(1)->get();  ?>
                          @foreach ($expedientes as $expediente)
                          <option class="form-control" value="{{ $expediente->id }}" >{{ $expediente->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                  @error('expediente_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="subTitulos">Comentario</label>
                    <textarea rows="4" name="comentarios" class="form-control" value="{{ old('comentarios', $arrInfo['arrRecord']['comentarios']) }}"></textarea>
                  </div>
              </div>
            </div>
            </div>
            <div style="border-top: 2px solid gray; opacity: 0.5;">
              <button type="submit" id="BtnEnviar" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip"><i class="fa-solid fa-floppy-disk"></i></button>
              <button type="button" id="BtnRegresar" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-arrow-left-long"></i></button>
            </div>
          </form>

      </div>
    </div>
  </div>
<script>
  document.getElementById("BtnRegresar").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.index') }}";  
   };

   $(document).ready(function(){
   $( "#expediente_id" ).select2({
        ajax: { 
          url: "{{route('expedientes.ajaxlist')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: $('input[name="_token"]').val(),
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          }
        },
        dropdownCssClass: 'select',
        selectionCssClass: 'select'
        
      });

    });

  
</script>
@endsection