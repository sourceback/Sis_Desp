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
              <th>Expedientes</th>
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
              <td>{{ $row->expediente->nombre}}</td>
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
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $arrInfo['arrSearch']['nombre'] }}">
              </div>
            </div>
            <div class="col-md-12 ">
              <div class="form-group" >
                  <label>Expedientes</label>
                    <div class="select-conteiner">
                      <select class="select" multiple style="width: 100%;" name="expediente_id[]" id="expediente_id">
                          <?php $expedientes = App\Models\Expediente::where('estatus', 1)->whereIn('id', $arrInfo['arrSearch']['expediente_id'])->get();?>
                          @foreach ($expedientes as $expediente)
                          <option class="form-control" value="{{ $expediente->id }}" selected>{{ $expediente->nombre }}</option>
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
              <div class="form-group">
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
                  <label for="exampleInputEstatu1">Estatus</label>
                  <select class="form-control" name="estatus">
                      <option class="form-control" value="1" @if($arrInfo['arrSearch']['estatus']==1) selected="" @endif>Activo</option>
                      <option class="form-control" value="0" @if($arrInfo['arrSearch']['estatus']==0) selected="" @endif>Baja</option>
                  </select>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 ">
                <div class="form-group"> 
                  <label for="exampleInputEstatu1">Estado de la cuenta</label>
                  <select class="form-control" name="estado">
                      <option class="form-control" value="1" @if($arrInfo['arrSearch']['estado']==1) selected="" @endif>Pagado</option>
                      <option class="form-control" value="0" @if($arrInfo['arrSearch']['estado']==0) selected="" @endif>No pagado</option>
                  </select>
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