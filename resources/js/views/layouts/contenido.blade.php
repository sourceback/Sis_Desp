
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Serv_Dom
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- sellect2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
  
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.css">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/locales-all.js"></script>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <style type="text/css">
  .select{
    width: 100%; 
    border: none !important;

  }
  .select-conteiner{
    background-color: white; 
    padding: 5px 10px 5px 10px; 
    border-radius: 50px; 
    border: 1px solid #D0CFD3; 

  }
  .form-group input{
    font-size: 14px;
    face: Calibri;
  }

  textarea.form-control {
    font-size: 14px;
  }

  label.subTitulos{
   font-size: 13px; 
  }
  </style>
  
</head>
<body class="user-profile">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="{{ route('home.index') }}" class="simple-text logo-mini">
          <h5>SD</h5>
        </a>
        <a href="{{ route('home.index') }}" class="simple-text logo-normal">
          Serv_<b>Dom</b>
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li id="liUsuario" class="{{ Request::is('usuarios') ? 'active' : '' }}">
            <a type="button" href="{{ route('usuarios.index') }}">
              <i class="now-ui-icons users_circle-08"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li id="liCrude" class="{{ Request::is('crudes') ? 'active' : '' }}">
            <a href="{{ route('crudes.index') }}">
              <i class="now-ui-icons shopping_credit-card"></i>
              <p>Crudes</p>
            </a>
          </li>
          <li id="liCrudi" class="{{ Request::is('crudis') ? 'active' : '' }}">
            <a href="{{ route('crudis.index') }}">
              <i class="now-ui-icons shopping_credit-card"></i>
              <p>Crudis</p>
            </a>
          </li>
          <li id="liCalendario" class="{{ Request::is('calendarios') ? 'active' : '' }}">
            <a href="{{ route('calendarios.index') }}">
              <i class="now-ui-icons transportation_bus-front-12"></i>
              <p>Calendarios</p>
            </a>
          </li>
          <li id="liRepartidore" class="">
            <a href="#">
              <i class="now-ui-icons transportation_bus-front-12"></i>
              <p>Repartidores</p>
            </a>
          </li>
          <li id="liRecepcionista" class="">
            <a href="#">
              <i class="now-ui-icons users_circle-08"></i>
              <p>Recepcionistas</p>
            </a>
          </li>
          <li id="liVenta" class="">
            <a href="#">
              <i class="now-ui-icons shopping_cart-simple"></i>
              <p>Ventas</p>
            </a>
          </li>
          <li id="liPedido" class="">
            <a href="#" >
              <i class="now-ui-icons shopping_bag-16"></i>
              <p>Pedidos</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <div class="content" style="padding-top: 10px;">
                  <p>{{ auth()->user()->name }}</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                  <a class="dropdown-item" href="#">Perfil</a>
                  <a class="dropdown-item" href="{{ route('logout.perform') }}">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
       
                  
                  @yield('ContenidoPrincipal')
              
              
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
        </div>
      </footer>
    </div>

  </div>

  <!--   Core JS Files   -->
  <script src="/fontawesome-free-6.1.1-web/js/all.js"></script>
  <script src="/assets/js/core/jquery.min.js"></script>
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!--  select2    -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  
  <!-- Chart JS -->
  <script src="/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="/assets/demo/demo.js"></script>

</body>

</html>
