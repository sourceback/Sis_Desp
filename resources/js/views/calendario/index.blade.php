@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="container" style="padding-top: 30px;">
  <div id="agenda">
    
  </div>
</div>
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formulario" action="">
        @csrf
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre del evento</label>
                  <input type="text" class="form-control" name="title" value="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Descripcion</label>
                  <input type="text" class="form-control" name="comentarios" value="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label >Fecha</label>
                  <input type="date" class="form-control" name="start" value="">
                </div>
              </div>
            </div>
        </div>
      </form>
      <div class="modal-footer">

        <button type="button" id="btnEliminar" class="btn btn-danger btn-icon rounded" style="width: 1px; height: 20px" data-dismiss="modal"><i class="fa-solid fa-trash-can"></i></button>
        <button type="button" id="btnModificar" class="btn btn-primary btn-icon rounded" style="width: 1px; height: 20px" data-dismiss="modal"><i class="fa-solid fa-highlighter"></i></button>
        <button type="button" id="btnGuardar" class="btn btn-secondary btn-icon rounded" style="width: 1px; height: 20px" data-dismiss="modal"><i class="fa-solid fa-floppy-disk"></i></button>
        
      </div>
    </div>
  </div>
</div>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 <script>


      document.addEventListener('DOMContentLoaded', function() {
      let formulario = document.querySelector('form');
          
        var calendarEl = document.getElementById('agenda');
        var calendar = new FullCalendar.Calendar(calendarEl, { 
          initialView: 'dayGridMonth',
          locale: 'es',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
          },
          events: "http://127.0.0.1:8000/calendarios/show",

         
          dateClick: function(info) {
            formulario.reset();
            formulario.start.value=info.dateStr;

            $('#evento').modal('show');
          },
          eventClick:function(info){
            var evento= info.event;
            axios.post("http://127.0.0.1:8000/calendarios/edit/"+info.event.id).then((respuesta)=>{

            
            formulario.title.value = respuesta.data.title;
            formulario.comentarios.value = respuesta.data.comentarios;
            formulario.start.value = respuesta.data.start;


            $("#evento").modal("show");
              }).catch(
                error=>{
                  if (error.response) {

                    console.log(error.response.data);
                  }
                }
              )
          },



        });

        calendar.render();

        document.getElementById('btnGuardar').addEventListener('click',function(){
          const datos = new FormData(formulario);
          

          axios.post("http://127.0.0.1:8000/calendarios/store", datos).then((respuesta)=>{
            calendar.refetchEvents();
            $("#evento").modal("hide");
          }).catch(
            error=>{
              if (error.response) {

                console.log(error.response.data);
              }
            }
          )


          });
        });

    </script>
@endsection