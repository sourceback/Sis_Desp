
<!doctype html>
<html lang="es">
  <head>
    <title>Sis_Desp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="registro/css/style.css">

    </head>
    <body>
    <section class="ftco-section">
        <div class="container">
            
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="align-content: center;">
                            <img src="/logo.lic.png" style="width: 250px; height: 200px; margin:  100px 100px 100px;">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                    
                    <form method="post" action="{{ route('login.perform') }}" class="signin-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group mb-3">
                            <label class="label" for="name">Correo</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password">Contraseña</label>
                      <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Enter</button>
                    </div>
                  </form>
                  
                </div>
              </div>
                </div>
            </div>
        </div>
    </section>

    <script src="registro/js/jquery.min.js"></script>
  <script src="registro/js/popper.js"></script>
  <script src="registro/js/bootstrap.min.js"></script>
  <script src="registro/js/main.js"></script>

    </body>
</html>

