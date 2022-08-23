@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="content">
  <div class="row">        
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Listado {{ $arrInfo['ruta'] }}</h5>
          <p class="category">Tabla {{ $arrInfo['ruta'] }}</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="example">
          <thead class="text-primary">
              <th>#</th>
              <th>No.expediente</th>
              <th>Clientes</th>
              <th>Clave</th>
              <th>Nombre</th>
              <th>Estatus</th>
          </thead> 
          <tbody>
          @php $varCurrentRow = 0; @endphp
          @foreach ($arrInfo['arrRecords'] as $row)
          @php $varCurrentRow += 1; @endphp
          <php $varCuenta += php?>
            <tr id="gridRow{{ $row->id }}">
              <td>{{ $varCurrentRow }}</td>
              <td>{{ $row->noexpediente }}</td>
              <td>{{ $row->cliente->nombre}}</td>
              <td>{{ $row->clave}}</td>
              <td>{{ $row->nombre}}</td>
              <td>{{ $row->estatus == 1 ? 'Activo' : 'Baja';}}</td>
              <td>
                <div>
                    <a type="button" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip" href="{{ route($arrInfo['ruta'].'.edit', $row->id) }}" data-toggle="tooltip"><i class="fa-solid fa-user-pen"></i></a>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
      <div style="border-top: 2px solid gray; opacity: 0.5;">
          <button type="button" id="BtnCrear" class="btn btn-solid btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip"><i class="fa-solid fa-user"></i></button>
          <button type="button" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px" data-toggle="modal" data-target="#modalBuscar"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- moodal Buscar --}}
<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="modalBuscarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBuscarLabel">Buscar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <form method="get" action="{{ route($arrInfo['ruta'].'.index') }}" >
          @csrf
        <div class="content" style="padding: 5px 10px 5px 10px;">
          <div class="row">
            <div class="col-md-12 ">
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre,clave o No.expediente</label>
                <input type="text" class="form-control" name="nombre" value="{{ $arrInfo['arrSearch']['nombre'] }}">
              </div>
            </div>
            <div class="col-md-12 ">
              <div class="form-group" >
                  <label>Tipos de expedientes</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="tipoexpediente_id[]" id="tipoexpediente_id">
                          <?php $tipoexpedientes = App\Models\Tipoexpediente::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['tipoexpediente_id'])->get();?>
                          @foreach ($tipoexpedientes as $tipoexpediente)
                          <option class="form-control" value="{{ $tipoexpediente->id }}" selected>{{ $tipoexpediente->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            </div>
            <div class="col-md-12 ">
              <div class="form-group" >
                  <label>Abogado</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="abogado_id[]" id="abogado_id">
                          <?php $abogados = App\Models\Abogado::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['abogado_id'])->get();?>
                          @foreach ($abogados as $abogado)
                          <option class="form-control" value="{{ $abogado->id }}" selected>{{ $abogado->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            </div>
            <div class="col-md-12 ">
              <div class="form-group">
                  <label>Etapa del expediente</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="etapa_id[]" id="etapa_id">
                          <?php $etapas = App\Models\Etapa::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['etapa_id'])->get();?>
                          @foreach ($etapas as $etapa)
                          <option class="form-control" value="{{ $etapa->id }}" selected>{{ $etapa->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            </div>
            <div class="col-md-12 ">
              <div class="form-group" >
                  <label>Clientes</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="cliente_id[]" id="cliente_id">
                          <?php $clientes = App\Models\Cliente::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['cliente_id'])->get();?>
                          @foreach ($clientes as $cliente)
                          <option class="form-control" value="{{ $cliente->id }}" selected>{{ $cliente->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            </div>
            <div class="col-md-12 ">
              <div class="form-group" >
                  <label>Instancias</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="instancia_id[]" id="instancia_id">
                          <?php $instancias = App\Models\Instancia::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['instancia_id'])->get();?>
                          @foreach ($instancias as $instancia)
                          <option class="form-control" value="{{ $instancia->id }}" selected>{{ $instancia->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            </div>

            <div class="col-md-12 ">
              <div class="form-group" >
                  <label>Materias</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="materia_id[]" id="materia_id">
                          <?php $materias = App\Models\Materia::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['materia_id'])->get();?>
                          @foreach ($materias as $materia)
                          <option class="form-control" value="{{ $materia->id }}" selected>{{ $materia->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 ">
              <div class="form-group">
                <label for="exampleInputFechaD1">Desde</label>
                <input type="date" class="form-control" name="fechaD" value="{{ $arrInfo['arrSearch']['fechaD'] <= 1970-01-01  ? date('Y-m-d') : $arrInfo['arrSearch']['fechaD']; }}">
              </div>
            </div>
            <div class="col-md-6 ">
              <div class="form-group">
                <label for="exampleInputFechaH1">Hasta</label>
                <input type="date" class="form-control" name="fechaH" value="{{ $arrInfo['arrSearch']['fechaH'] <= 1970-01-01  ? date('Y-m-d') : $arrInfo['arrSearch']['fechaH']; }}">
              </div>
            </div>
          </div>
          <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-12 ">
                <label class="subTitulos">Estatus de la fecha</label>
              <div class="select-conteiner">
                <select class="form-control" style="width: 100%;" id="estatusFecha" name="fechaT">
                    <option class="form-control" value="1" @if($arrInfo['arrSearch']['fechaT']=='1') selected="" @endif>Ignorar</option>
                    <option class="form-control" value="2" @if($arrInfo['arrSearch']['fechaT']==2) selected="" @endif>Buscar por fecha</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-12 ">
                <div class="form-group">
                <label class="subTitulos">Estatus</label>
              <div class="select-conteiner" >
                <select class="form-control" style="width: 100%;" id="estatus" name="estatus">
                    <option class="form-control" value="1" @if($arrInfo['arrSearch']['estatus']==1) selected="" @endif>Activo</option>
                    <option class="form-control" value="0" @if($arrInfo['arrSearch']['estatus']==0) selected="" @endif>Baja</option>
                </select>
                </div>
              </div>
              </div>
            
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="valor" value="1">
        <button type="button" class="btn btn-secondary btn-icon rounded" style="width: 1px; height: 20px" data-dismiss="modal"><i class="fa-solid fa-rectangle-xmark"></i></button>
        <button type="submit" class="btn btn-primary btn-icon rounded" style="width: 1px; height: 20px"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- termina el modal buscar --}}
<script>
  
  document.getElementById("BtnCrear").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.create') }}";  
  };

  $(document).ready(function(){
   $( "#estatus" ).select2({
        dropdownCssClass: 'select',
        selectionCssClass: 'select',
        minimumResultsForSearch: Infinity
   });
   $( "#estatusFecha" ).select2({
        dropdownCssClass: 'select',
        selectionCssClass: 'select',
        minimumResultsForSearch: Infinity
   });

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