<!DOCTYPE html>
<?php
//Inclusion de las carpetas y los archivos de de modelo y control de las distintas entidades
include '../control/ControlAreas.php';
include '../Modelo/Areas.php';
include '../control/ControlConexion.php';
include '../control/ControlEmpleados.php';
include '../modelo/Empleados.php';
//-------------------FIN INclusion Modelos y Controles
//--------------------------------------------------- Instanciacion de la clase Empleado y control Empleados
$objEmpleados= new Empleados('', '', '', '', '', '', '', '', '', '', '');
$objControlEmpleados= new ControlEmpleados($objEmpleados);
$MatrizEmpleados1=$objControlEmpleados->listar();
///Esto se hace con el fin de llenar una mtriz con todos los empleados, los cuales e usarán más tarde para construri un select type llamando directamente desde la base de datos
//-------------------------------------Fin instanciación de la clase Control Empleados
//Este 'Si' se utiliza para mostrar en un parrafo que Acción fue la que se seleccionó para ejecutarse

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    //se guarda en una variable llamada accion el valor que se trae de los botones mediante el metodo POST
    echo '<h1> <center> <p> La Opción que se ha elegido es:  ' . $accion . '</p></center></h1>';
} else {
    $accion = null;
}

//Se asigna los valores guardados en POSt a diferentes variables donde se van a guardar los datos que se usarán para operar los diferentes metodos
$idArea = isset($_POST['txtidarea']) ? $_POST['txtidarea'] : null;
$NombreArea = isset($_POST['txtnombrearea']) ? $_POST['txtnombrearea'] : null;
$Encargado = isset($_POST['txtEmpleadoEncargado']) ? $_POST['txtEmpleadoEncargado'] : null;

switch ($accion) {// declaración de una Estructura Switch para manejar las diferentes opciones

    case 'Crear':
        $objArea = new Areas($idArea, $NombreArea, $Encargado);//Se instancia la clase areas y se declara un objeto de tipo areas y se crea una instancia area mediante el constructor
        $objControlAreas = new ControlAreas($objArea);//se instancia la clase control area y se crea un objeto de tipo control area
        $inserto = $objControlAreas->guardar(); //en la variable inserto se guarda el resultado del query, ya sea falso o verdadero y se usará para mostrar mensajes emergentes
        //que hablarán del estado del query
        if ($inserto) {
            echo '<script> alert("Registro Completado con éxito1")</script>';
            header('Refresh: 1; URL=VistaCrudAreasAux.php'); //una vez completada la accion, esto recargará la pagina y la actualizará
        } else {
            echo '<script> alert("El registro no se pudo guardar. Ya existe; no debe repetirse o los campos estan vacios")</script>';
        }

        $accion = null;
        break;
    case'Consultar':
        if (isset($_POST['txtidarea']) && $_POST['txtidarea'] != '') { //esto se hace para que el metodo consultar se ejecute necesariamente con un codigo, en caso contrario, se emitirira un mensaje donde avise que
            // //se necesita un codigo para realziar dicha operación
            $objArea1 = new Areas($idArea, '', '');//se instancia la clase area y se crea un objeto de tipo area que solo hara uso del id de area
            $objControlArea1 = new ControlAreas($objArea1);//Se declara y se instancia un objeto de tipo control de area
            $ExisteRegistro = $objControlArea1->consultarAUX($objArea1->getIdArea()); //metodo auxilair que nos ayudará a saber si una consulta devuelve un recordset vacio o no vacio, con el fin de comprobar si
            ////el registro si existe y asi ademas es no vacio
             //--Uso Auxiliar------Fin
            if ($ExisteRegistro) {
                $objArea2 = new Areas($idArea, '', '');//se instancia y se crea un objeto area solo con el codigo
                $objControlArea = new ControlAreas($objArea2);//se instancia y se crea un objeto de tipo control areas
                $objArea2 = $objControlArea->consultar($objArea2->getIdArea());//Se consulta mediante un id de area
               // session_start();//se crea una sesion apra guardar los datos, a cada atributo de la sesion se le asgina un nombre y se le asigna un valor
               // $_SESSION['idArea'] = $objArea2->getIdArea();
                //$_SESSION['NombreArea'] = $objArea2->getNombre();
                //$_SESSION['Encargado'] = $objArea2->getEmpleadoEncargado();
                //se le asigna el valor dentro de las sesiones a las variables que se usarán para mostrar el resultado en el formulario
                $idArea = $objArea2->getIdArea();
                $NombreArea = $objArea2->getNombre();
                $Encargado=$objArea2->getEmpleadoEncargado();
                //session_destroy(); //se destruye la sesion
                echo'<script>alert("Registro EnContrado")</script>';
            } else { //mensajes de alerta
                echo'<script>alert("Area No Encontrada")</script>';
            }
        } else {
            echo'<script>alert("Necesita el Codigo Para continuar la operación")</script>';
        }
        $accion = null;
        break;
    case 'Eliminar':
        //Creacion e instanciacion de objetos area usando la clase area, la clase control area y uso de metodo auxilair que verifica que el registro sí existe
        $objArea = new Areas($idArea, '', '');
        $objControlArea = new ControlAreas($objArea);
        $CodigoAUX = $objArea->getIdArea();
        $ExisteRegistro = $objControlArea->consultarAUX($idArea);
        //echo $ExisteRegistro;
        if ($ExisteRegistro) {//Si el registro existe, Ejecuta el eliminar,
            //en caso contrario notifica que el registro no existe
            $objControlArea->borrar($objArea->getIdArea());
            echo '<script> alert("Se ha Eliminado con Exito el Registro asociado al codigo: ' . $CodigoAUX . ' Recuerde Refrescar la pagina para ver la actualización de la Base de Datos")</script>';
            echo '<script> alert("La página Web Se actualizará automaticamente ")</script>';
            header('Refresh: 1; URL=VistaCrudAreasAux.php');  //una vez completada la accion, esto recargará la pagina y se actualizará los registros
        }
        //echo '<script> alert("Se ha Eliminado con Exito el Registro asociado al codigo: '.print_r($ExisteRegistro).' Recuerde Refrescar la pagina para ver la actualización de la Base de Datos")</script>';
        //echo 'Se ha eliminado';
        else {
            echo '<script> alert("El registro Asociado Al codigo : ' . $CodigoAUX . ' No Existe. \n Vuelva a Intentar con Otro Codigo \n Recuerde no Dejar El Codigo Vacío ")</script>';
        }
        $accion = null;
        //echo '<script> alert("Se ha Eliminado con Exito el Registro asociado al codigo: '.print_r($ExisteRegistro).' Recuerde Refrescar la pagina para ver la actualización de la Base de Datos")</script>';
        break;
    case 'Actualizar':
         //Creacion e instanciacion de objetos area usando la clase areas, la clase control areas y uso de metodo auxilair que verifica que el registro sí exista
        $objArea = new Areas($idArea, $NombreArea, $Encargado);
        $objControlAreas = new ControlAreas($objArea);
        $CodigoAUX = $objArea->getIdArea();
        $ExisteRegistro = $objControlAreas->consultarAUX($idArea);
        if ($ExisteRegistro) {
            //el registro existe, Ejecuta el actualizar,
            //en caso contrario notifica que el registro no existe

            $objControlAreas->modificar();
            echo '<script> alert("El regstro asociado al codigo: ' . $CodigoAUX . ' Ha sido modificado con éxito Recuerde Refrescar la pagina para ver la actualización de la Base de Datos")</script>';
            echo '<script> alert("La página Web Se actualizará automaticamente ")</script>';
            header('Refresh: 1; URL=VistaCrudAreasAux.php');
        //header('Refresh: 2;location:vistaClientes.php');
        }//window.location=vistaClientes.php
        else {
            echo '<script> alert("El regstro asociado al codigo: ' . $CodigoAUX . ' No ha podio modificarse. Es posible que el registro asociado a dicho codigo no exista. \n Intente de nuevo")</script>';
        }
        $accion = null;
        break;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/vistaAreas.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD De Áreas</title>
    </head>
    <body>
      <header>
        <div class="box-nav">
          <a href="./index.php"><div class="logo-header"><img src="../img/logo_size.jpg"></div></a>
          <section class="logo">
            <p><a href="#">MesaAyuda</a></p>
          </section>

          <nav class="nav">
            <ul>
              <li><a href="../index.php">HOME</a></li>
              <li><a href="../quienessomos.php">Quienes somos</a></li>
              <li><a href="../gestion.html">Gestiones Mesa de Ayuda</a></li>
              <li><a href="../integrantes.php">INTEGRANTES</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <main>

        <div class="container-main">
          <h1>CRUD De Áreas</h1>

          <form action="VistaCrudAreasAux.php" method="POST">

            <div class="row">
              <div class="col-md-6">
                <label><p>Identificacion Área</p></label>
                <input type="text" name="txtidarea" id="nombres" class='form-control' maxlength="10"  value="<?php echo'' . $idArea; ?>" >
              </div>

              <div class="col-md-6">
                <label><p>Nombre Área:</p></label>
                <input type="text" name="txtnombrearea" id="nombres" class='form-control' maxlength="50" value="<?php echo'' . $NombreArea; ?>" >
              </div>
              <div class="col-md-6">
                <label><p>Empleado Encargado Área:</p></label>
                <select name="txtEmpleadoEncargado" class="form-select form-select-lg mb-4"  aria-label=".form-select-lg example">
                  <?php foreach ($MatrizEmpleados1 as $Empleados) {
                        echo '<option value='.$Empleados->getIdEmpleado().'>'.$Empleados->getNombre().'</option>';} ?>
                  <option value="NULL" selected="selected">Encargado Sin Asignar</option>
                  </select>
              </div>
                     <div class="col-md-6">
                        <label><p>Visualización Nombre Área:</p></label>
                        <?php
                    $objEmpleado2=new Empleados($Encargado, '', '', '', '', '', '', '', '', '', '');
                    $objControlempleado2= new ControlEmpleados($objEmpleado2);
                    $objControlempleado2->consultar();
                    $Encargado=$objEmpleado2->getNombre();
                        if (empty($Encargado)) {

                            $Encargado='Encargado sin asignar';
                        }
                        ?>
                        <input type="text" name="txtnombrearea" id="nombres" class='form-control' maxlength="50" value="<?php echo'' .$Encargado.'' ?>" disabled="true" >
                    </div>
                        <button type="submit" class="btn" name="accion" value="Crear" >Crear Datos Area</button>
                        <button type="submit" class="btn" name="accion" value="Consultar">Consultar Datos Area</button>
                        <button type="submit" class="btn" name="accion" value="Eliminar">Eliminar Area</button>
                        <button type="submit" class="btn" name="accion" value="Actualizar">Actualizar Datos Área</button>

                </div>
            </form>
        </div>

        </main>

</body>
</html>
