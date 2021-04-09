<!DOCTYPE html>
<html>
	<head>
        <link href='../css/styles.css' rel='stylesheet' type='text/css'>
				

		<meta charset="utf-8">
		<title>Detalles requerimiento</title>
	</head>
	<body>

        <div class="container">
          <div class="frame">
            <div class="nav">
              <ul class"links">
               <center> <li class="signin-active"><a class="btn">Detalles requerimiento</a></li></center>
              </ul>
            </div>
            <div style="overflow : auto; ">
              <form class="form-signin" action="" method="post" name="form">
                <label >Identificacion detalle</label>
                <input class="form-styling" type="text" name="iddetalle" placeholder="" />
                <label >fecha</label>
                <input class="form-styling" type="text" name="fecha" placeholder="" />
                <label >observacion</label>
                <input class="form-styling" type="text" name="observacion" placeholder="" />
                <label >identificacion requerimiento</label>
                <input class="form-styling" type="text" name="fkRequerimiento" placeholder="" />
                <label >identificaicon estado</label>
                <input class="form-styling" type="text" name="fkestado" placeholder="" />
                <label >identificacion empleado</label>
                <input class="form-styling" type="text" name="fkempleado" placeholder="" />
                <label >identificacion empleado asignado</label>
                <input class="form-styling" type="text" name="fkasignado" placeholder="" />

                <div class="btn-animate">
                  <a class="btn-signin">Guardar</a> <a class="btn-signin">Borrar</a>
                  <br>
                  <a class="btn-signin">Modificar</a>
                  <br>
                  <a class="btn-signin">Actualizar</a>
                </div>
              </form>

            </div>
          </div>
        </div>
  </body>

</html>
