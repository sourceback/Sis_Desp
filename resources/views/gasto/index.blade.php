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
          @if($arrInfo['arrIngreso'] >= $arrInfo['arrEgreso'])<h5 style="text-align: center; color: green;">$ +{{ number_format($arrInfo['arrIngreso']-$arrInfo['arrEgreso'], 2, '.', ',') }}</h5>@endif
          @if($arrInfo['arrIngreso'] < $arrInfo['arrEgreso'])<h5 style="text-align: center; color: red;">$ -{{ number_format($arrInfo['arrEgreso']-$arrInfo['arrIngreso'], 2, '.', ',')  }}</h5>@endif
          <div class="table-responsive">
            <div class="row">
          <div class="col-md-6">
            <h5 style="text-align: center;">Ingresos</h5>
            <table class="table" id="example">
                <thead class="text-primary">
                    <th>#</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Monto</th>
                </thead>
                <tbody>
                @php $varCurrentRow = 0; @endphp
                @foreach ($arrInfo['arrRecords'] as $row)
                @if($row->tipo == 0) 
                @php $varCurrentRow += 1; @endphp
                <php $varCuenta += ?>
                  <tr>
                    <td>{{ $varCurrentRow }}</td>
                    <td>{{ $row->clave}}</td>
                    <td>{{ $row->nombre}}</td>
                    <td>{{ number_format($row->monto, 2, '.', ',') }}</td>
                    <td>
                      <div>
                          <a type="button" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip" href="{{ route($arrInfo['ruta'].'.edit', $row->id) }}" data-toggle="tooltip"><i class="fa-solid fa-user-pen"></i></a>
                      </div>
                    </td>
                  </tr>
                @endif
                @endforeach
                </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <h5 style="text-align: center;">Egresos</h5>
            <table class="table" id="example">
                <thead class="text-primary">
                    <th>#</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Monto</th>
                </thead> 
                <tbody>
                @php $varCurrentRow = 0; @endphp
                @foreach ($arrInfo['arrRecords'] as $row)
                @if($row->tipo == 1) 
                @php $varCurrentRow += 1; @endphp
                <php $varCuenta += ?>
                  <tr>
                    <td>{{ $varCurrentRow }}</td>
                    <td>{{ $row->clave}}</td>
                    <td>{{ $row->nombre}}</td>
                    <td>{{ number_format($row->monto, 2, '.', ',') }}</td>
                    <td>
                      <div>
                          <a type="button" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip" href="{{ route($arrInfo['ruta'].'.edit', $row->id) }}" data-toggle="tooltip"><i class="fa-solid fa-user-pen"></i></a>
                      </div>
                    </td>
                  </tr>
                @endif
                @endforeach
                </tbody>
            </table>
          </div>
          </div>
          <div style="border-top: 2px solid gray; opacity: 0.5;">
              <button type="submit" id="BtnCrear" class="btn btn-solid btn-icon rounded" style="width: 1px; height: 20px"  data-toggle="tooltip"><i class="fa-solid fa-user"></i></button>
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
      <div class="modal-body">
        <form method="get" action="{{ route($arrInfo['ruta'].'.index') }}" >
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $arrInfo['arrSearch']['nombre'] }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputFechaD1">Desde</label>
                <input type="date" class="form-control" name="fechaD" value="{{ $arrInfo['arrSearch']['fechaD'] <= 1970-01-01  ? date('Y-m-d') : $arrInfo['arrSearch']['fechaD']; }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputFechaH1">Hasta</label>
                <input type="date" class="form-control" name="fechaH" value="{{ $arrInfo['arrSearch']['fechaH'] <= 1970-01-01  ? date('Y-m-d') : $arrInfo['arrSearch']['fechaH']; }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputFechaT1">Estatus de la fecha</label>
                <select class="form-control" name="fechaT">
                    <option class="form-control" value="1" @if($arrInfo['arrSearch']['fechaT']=='1') selected="" @endif>Ignorar</option>
                    <option class="form-control" value="2" @if($arrInfo['arrSearch']['fechaT']==2) selected="" @endif>Buscar por fecha</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEstatu1">Estatus</label>
                <select class="form-control" name="estatus">
                    <option class="form-control" value="1" @if($arrInfo['arrSearch']['estatus']==1) selected="" @endif>Activo</option>
                    <option class="form-control" value="0" @if($arrInfo['arrSearch']['estatus']==0) selected="" @endif>Baja</option>
                    <option class="form-control" value="2" @if($arrInfo['arrSearch']['estatus']==2) selected="" @endif>Todos</option>
                </select>
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
<script type="text/javascript">
  
  document.getElementById("BtnCrear").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.create') }}";  
  };


</script>
@endsection