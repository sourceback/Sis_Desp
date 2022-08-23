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
                  <label class="subTitulos">Nombre</label>
                  <input type="text" class="form-control" name="nombre" value="{{ old('name', $arrInfo['arrRecord']['nombre']) }}">
                </div>
              </div>
              <div class="col-md-5 pr-1">
                <div class="form-group">
                  <label class="subTitulos">Clave</label>
                  <input type="text" class="form-control"  name="clave" value="{{ old('clave', $arrInfo['arrRecord']['clave']) }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                <label class="subTitulos">Estatus</label>
              <div class="select-conteiner" >
                <select class="form-control" id="estatus" name="estatus">
                    <option class="form-control" value="1" @if($arrInfo['arrRecord']['estatus']==1) selected="" @endif>Activo</option>
                    <option class="form-control" value="0" @if($arrInfo['arrRecord']['estatus']==0) selected="" @endif>Baja</option>
                </select>
                </div>
              </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group" >
                  <label class="subTitulos">Crude</label>
                    <div class="select-conteiner">
                      <select class="select" name="crude_id" id="crude_id" required="required">
                          <?php $crudes = App\Models\Crude::where('estatus', 1)->where('id', old('crude_id', $arrInfo['arrRecord']['crude_id']))->limit(1)->get();  ?>
                          @foreach ($crudes as $crude)
                          <option class="form-control" value="{{ $crude->id }}" >{{ $crude->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                    <label class="subTitulos">Comentario</label>
                    <textarea rows="4" name="comentarios" class="form-control">{{ old('comentarios', $arrInfo['arrRecord']['comentarios']) }}</textarea>
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
{{-- SUBIT ARCHIVOS --}}
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
            @foreach($arrInfo['arrRecord']->archivos as $row)
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
{{-- ¨+++++++++++++++++++++++++++++++++++* --}}
<script>

  document.getElementById("BtnRegresar").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.index') }}";  
  };

  document.getElementById("BtnEliminar").onclick = function() {
      event.preventDefault();
      document.getElementById("frmEliminar").submit();  
  };

//subir archivos
  document.getElementById("BtnArchivo").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.archivo', $arrInfo['arrRecord']['id']) }}";  
  };
//----------------

  $(document).ready(function(){
   $( "#estatus" ).select2({
        dropdownCssClass: 'select',
        selectionCssClass: 'select',
        minimumResultsForSearch: Infinity
   });

   $( "#crude_id" ).select2({

        ajax: { 
          url: "{{route('crudes.ajaxlist')}}",
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