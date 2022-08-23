@extends('layouts.contenido')
@section('ContenidoPrincipal')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="title">Inicio</h5>
      </div>
      <div class="card-body">
        <p>{{ date('Y-m-d') }}</p>
          @yield('ContenidoPrincipal')
      </div>
    </div>
  </div>
</div>
@endsection