<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>MesaAyuda</title>
  <link rel="stylesheet" href="css/index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="img/logo_size.jpg">
</head>

<body>
  <header>
      <?php include "header.html"?>
  </header>

  <main>
    <div class="container-main">
      <div class="container-video">
        <h1 class="titulo-video">Tutoria | como manejar la Mesa de Ayuda</h1>
        <iframe class="iframe"  src="https://www.youtube.com/embed/Aqg3hZTpg1k?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer;
        autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>

      <div class="menucrud">
        <div class="vis sec1">
          <p>Accede aqui para poder realizar la gestion de las Areas de la empresa: consultas, actualizacion, borrado, insercion</p>
          <a href="vista/VistaCrudAreasAux.php" class="btn">
            Crud de Areas
          </a>
        </div>

        <div class="vis sec2">
          <p>Accede aqui para poder realizar la gestion de los empleados de la empresa: consultas, actualizacion, borrado, insercion</p>
          <a href="vista/VistaCrudCargosEmpleadosAux.php" class="btn">
            Crud de empleados
          </a>
        </div>

        <div class="vis sec3">
          <p>Accede aqui para poder realizar un requerimiento o insidencia</p>
          <a href="vista/VistaRequirimiento.php" class="btn">
            Realiza un Requerimiento
          </a>
        </div>

        <div class="vis sec4">
          <p>Accede aqui para poder realizar la gestion de los cargos de los empleados de la empresa: consultas, actualizacion, borrado, insercion</p>
          <a href="vista/VistaCrudCargosAux.php" class="btn">
            Crud de Cargos
          </a>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <?php include "footer.html"  ?>
  </footer>
</body>
</html>
