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
              <div class="col-md-4 ">
                <div class="form-group">
                  <label>No. expediente</label>
                  <input type="text" class="form-control" max="10"  name="noexpediente" value="{{ old('noexpediente', $arrInfo['arrRecord']['noexpediente']) }}">
                  @error('noexpediente')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group">
                  <label class="subTitulos">Nombre</label>
                  <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $arrInfo['arrRecord']['nombre']) }}">
                  @error('nombre') <small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group">
                  <label class="subTitulos">Clave</label>
                  <input type="text" class="form-control" name="clave" value="{{ old('clave', $arrInfo['arrRecord']['clave']) }}">
                  @error('clave')<small>  <strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 ">
                <div class="form-group">
                <label class="subTitulos">Estatus</label>
              
                <select class="form-control" id="estatus" name="estatus">
                    <option class="form-control" value="1" @if($arrInfo['arrRecord']['estatus']==1) selected="" @endif>Activo</option>
                    <option class="form-control" value="0" @if($arrInfo['arrRecord']['estatus']==0) selected="" @endif>Baja</option>
                </select>
                              
                </div>
              </div>

              <div class="col-md-2 ">
                <div class="form-group">
                <label class="subTitulos">Estado del expediente</label>
              
                <select class="form-control" id="estadoexpedi" name="estadoexpedi">
                    <option class="form-control" value="0" @if($arrInfo['arrRecord']['estadoexpedi']==1) selected="" @endif>PREPARACION</option>
                    <option class="form-control" value="1" @if($arrInfo['arrRecord']['estadoexpedi']==0) selected="" @endif>PROCESO</option>
                    <option class="form-control" value="2" @if($arrInfo['arrRecord']['estadoexpedi']==0) selected="" @endif>TERMINADO</option>
                </select>
                
              </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFechaD1">Fecha de inicio</label>
                    <input type="date" class="form-control" name="fechaini" value="{{ date('Y-m-d',strtotime(old('fechaini', $arrInfo['arrRecord']['fechaini']))) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFechaH1">Fecha final</label>
                    <input type="date" class="form-control" name="fechafin" value="{{ date('Y-m-d',strtotime(old('fechafin', $arrInfo['arrRecord']['fechafin']))) }}">
                  </div>
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Etapa del expediente</label>
                    <div class="select-conteiner">
                      <select class="select" name="etapa_id" id="etapa_id" >
                          <?php $etapas = App\Models\Etapa::where('estatus', 1)->where('id', old('etapa_id', $arrInfo['arrRecord']['etapa_id']))->limit(1)->get();  ?>
                          @foreach ($etapas as $etapa)
                          <option class="form-control" value="{{ $etapa->id }}" >{{ $etapa->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('etapa_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Clientes</label>
                    <div class="select-conteiner">
                      <select class="select" name="cliente_id" id="cliente_id" >
                          <?php $clientes = App\Models\Cliente::where('estatus', 1)->where('tipo_cliente', 1)->where('id', old('cliente_id', $arrInfo['arrRecord']['cliente_id']))->limit(1)->get();  ?>
                          @foreach ($clientes as $cliente)
                          <option class="form-control" value="{{ $cliente->id }}" >{{ $cliente->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('cliente_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Contraparte</label>
                    <div class="select-conteiner">
                      <select class="select" name="contraparte_id" id="contraparte_id" >
                          <?php $contrapartes = App\Models\Cliente::where('estatus', 1)->where('tipo_cliente', 0)->where('id', old('contraparte_id', $arrInfo['arrRecord']['contraparte_id']))->limit(1)->get();  ?>
                          @foreach ($contrapartes as $contraparte)
                          <option class="form-control" value="{{ $contraparte->id }}" >{{ $contraparte->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('contraparte_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Materia de juicio</label>
                    <div class="select-conteiner">
                      <select class="select" name="materia_id" id="materia_id" >
                          <?php $materias = App\Models\Materia::where('estatus', 1)->where('id', old('materia_id', $arrInfo['arrRecord']['materia_id']))->limit(1)->get();  ?>
                          @foreach ($materias as $materia)
                          <option class="form-control" value="{{ $materia->id }}" >{{ $materia->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('materia_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Instancia</label>
                    <div class="select-conteiner">
                      <select class="select" name="instancia_id" id="instancia_id" >
                          <?php $instancias = App\Models\Instancia::where('estatus', 1)->where('id', old('instancia_id', $arrInfo['arrRecord']['instancia_id']))->limit(1)->get();  ?>
                          @foreach ($instancias as $instancia)
                          <option class="form-control" value="{{ $instancia->id }}" >{{ $instancia->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('instancia_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Tipo expediente</label>
                    <div class="select-conteiner">
                      <select class="select" name="tipoexpediente_id" id="tipoexpediente_id" >
                          <?php $tipoexpedientes = App\Models\Tipoexpediente::where('estatus', 1)->where('id', old('tipoexpediente_id', $arrInfo['arrRecord']['tipoexpediente_id']))->limit(1)->get();  ?>
                          @foreach ($tipoexpedientes as $tipoexpediente)
                          <option class="form-control" value="{{ $tipoexpediente->id }}" >{{ $tipoexpediente->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('tipoexpediente_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="form-group" >
                  <label class="subTitulos">Abogado contraparte</label>
                    <div class="select-conteiner">
                      <select class="select" name="abogado_id" id="abogado_id" >
                          <?php $abogados = App\Models\Abogado::where('estatus', 1)->where('id', old('abogado_id', $arrInfo['arrRecord']['abogado_id']))->limit(1)->get();  ?>
                          @foreach ($abogados as $abogado)
                          <option class="form-control" value="{{ $abogado->id }}" >{{ $abogado->nombre }}</option>
                          @endforeach
                      </select>
                  </div>@error('abogado_id')<small><strong style="color: red;">{{ $message }}</strong></small>@enderror
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
   

   $( "#cliente_id" ).select2({
        ajax: { 
          url: "{{route('clientes.ajaxlist')}}",
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

   $( "#contraparte_id" ).select2({
        ajax: { 
          url: "{{route('clientes.ajaxlist2')}}",
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

   $( "#etapa_id" ).select2({
        ajax: { 
          url: "{{route('etapas.ajaxlist')}}",
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

   $( "#abogado_id" ).select2({
        ajax: { 
          url: "{{route('abogados.ajaxlist')}}",
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
   
   $( "#materia_id" ).select2({
        ajax: { 
          url: "{{route('materias.ajaxlist')}}",
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

   $( "#tipoexpediente_id" ).select2({
        ajax: { 
          url: "{{route('tipoexpedientes.ajaxlist')}}",
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

   $( "#instancia_id" ).select2({
        ajax: { 
          url: "{{route('instancias.ajaxlist')}}",
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