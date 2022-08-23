
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Subir archivo</h5>
          <p class="title">Registro {{ $arrInfo['arrRecord']['nombre'] }}</p>
        </div>
        <div class="card-body">
        <div col-md-12>		
            <div class="card-body">
	            <div class="container" >
                <form method="post" action="{{ route($arrInfo['ruta'].'.archivodo', $arrInfo['arrRecord']['id']) }}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                    @csrf          
                </form>

			         </div>
          </div>
			 <div style="border-top: 2px solid gray; opacity: 0.5; ">
          <button type="button" id="BtnRegresar" class="btn btn-light btn-icon rounded" style="width: 1px; height: 20px;" data-toggle="tooltip"><i class="fa-solid fa-arrow-left-long"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
<script>
  Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
    maxFilesize: 2, // Tamaño máximo en MB
     dictDefaultMessage: "Arrastre una imagen al recuadro para subirlo",
     acceptedFiles: "image/*,.pdf", 
};
  document.getElementById("BtnRegresar").onclick = function() {
    window.location.href="{{ route($arrInfo['ruta'].'.edit', $arrInfo['arrRecord']['id']) }}";  
   };
</script>
@endsection