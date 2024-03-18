<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css"
      rel="stylesheet"
    />




  </head>
  <body>
    <h1></h1>
     <div class="container">
         @yield('contenido')
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>

    <script>
      $("#example").DataTable({
        "language":{
          "url":"https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
      });
    </script>
  </body>
</html>
