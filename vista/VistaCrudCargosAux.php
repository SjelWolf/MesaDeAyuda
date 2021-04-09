<!DOCTYPE html>
<?php
//inclusion de todos los controles,de los modelos que se usaran para el uso de los metodos.
include '../control/ControlCargos.php';
include '../modelo/Cargos.php';
include '../control/ControlConexion.php';
// En esta parte se instancia la clase area y se crea el objeto tipo empleado llamado objCargo1 y se usa el metodo
//  lista que devuelve una matriz de objetos tipo area y se guarda en una Matriz de area
$objCargo = new Cargos('', '');
$objControlCargo = new ControlCargos($objCargo);
$MatrizUsuarios = $objControlCargo->listar();
$objCargo1;  //se declara una variable llamada objCargo
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
//se guarda en una variable llamada accion el valor que se trae de los botones mediante el metodo POST
    echo '<h1><p> La Opción que se ha elegido es:  ' . $accion . '</p></h1>';

} else {
    $accion = null;
}
//Se asigna los valores guardados en POSt a diferentes variables donde se vana guardar los datos que se usarán para operar los diferentes metodos
$idcargo = isset($_POST['txtcodigocargo']) ? $_POST['txtcodigocargo'] : null;
$NombreCargo = isset($_POST['txtnombrecargo']) ? $_POST['txtnombrecargo'] : null;
switch ($accion) {// declaración de una Estructura Switch para manejar las diferentes opciones

    case 'Crear':

        $objCargo= new Cargos($idcargo, $NombreCargo);//Se instancia la clase areas y se declara un objeto de tipo areas y se crea un area mediante el constructor
        $objControlCargo = new ControlCargos($objCargo);//se instancia la clase control area y se crea un objeto de tipo control area
        $inserto = $objControlCargo->guardar(); //en la variable inserto se guarda el resultado del query, ya sea falso o verdadero y se usará para mostrar mensajes emergentes
        //que hablarán del estado del query
        if ($inserto) {
            echo '<script> alert("Registro Completado con éxito1")</script>';
            header('Refresh: 1; URL=VistaCrudcargosAux.php'); //una vez completada la accion, esto recargará la pagina y se actualizará los registros que se estan mostrando en las tablas, los cuales se traen directamente
            //de la base dedatos
        } else {
            echo '<script> alert("El registro no se pudo guardar; Ya existe; no debe repetirse o los campos estan vacios")</script>';
        }

        $accion = null;
        break;
    case'Consultar':
        //print_r($_POST);
        //print_r($_SESSION);
        if (isset($_POST['txtcodigocargo']) && $_POST['txtcodigocargo'] != '') { //esto se hace para que el metodo consultar se ejecute con un codigo, en caso contrario, se emitirira un mensaje donde avise que
            // //se necesita un codigo para realziar dicha operación
            //$ObjClientes1->setCodigo($_POST['codigo']);
            //Solo para uso del Auxiliar esta parte--- Inicio
            $objCargo1 = new Cargos($idcargo, '');//se instancia la clase area y se crea un objeto de tipo area que solo hara uso del codigo
            $objControlCargo1 = new ControlCargos($objCargo1);//Se declara y se instancia un objeto de tipo control de area
            $ExisteRegistro = $objControlCargo1->consultarAUX(); //metodo auxilair que nos ayudará a saber si una consulta devuelve un recordset vacio o no vacio
             //--Uso Auxiliar------Fin
            if ($ExisteRegistro) {
                $objCargo = new Cargos($idcargo, '');//se instancia y se crea un objeto area solo con el codigo
                $objControlcargo = new ControlCargos($objCargo);//se instancia y se crea un objeto de tipo control areas
                $objCargo = $objControlcargo->consultar();//Se consulta mediante un id de area
                session_start();//se crea una sesion apra guardar los datos, a cada atributo de la sesion se le asgina un nombre y se le asigna un valor
              //  $_SESSION['idcargo'] =
                //$_SESSION['NombreCargo'] =
                //$_SESSION['Encargado'] = $objArea->getEmpleadoEncargado();
                //se le asigna el valor dentro de las sesiones a las variables que se usarán para mostrar el resultado en el formulario
                //$_SESSION['idcargo'];
                $idcargo = $objCargo->getIdCargo() ;
                $NombreCargo = $objCargo->getNombreCargo();
                        //$_SESSION['NombreCargo'];
                //$Encargado=$_SESSION['Encargado'];
                session_destroy(); //se destruye la sesion
                echo'<script>alert("Registro EnContrado")</script>';
            } else { //mensajes de alerta
                echo'<script>alert("Cargo No Encontrado")</script>';
            }
        } else {
            echo'<script>alert("Necesita el Codigo Para continuar la operación")</script>';
        }
        $accion = null;
        break;
    case 'Eliminar':
        //Creacion e instanciacion de objetos area usando la clase empleados, la clase control area y uso de metodo auxilair que verifica que el registro sí existe
        $objCargo = new Cargos($idcargo,$NombreCargo);
        $objControlCargo = new ControlCargos($objCargo);
        $CodigoAUX = $objCargo->getIdCargo();
        $ExisteRegistro = $objControlCargo->consultarAUX();
        //echo $ExisteRegistro;
        if ($ExisteRegistro) {//Si el registro existe, Ejecuta el eliminar,
            //en caso contrario notifica que el registro no existe
            $objControlCargo->borrar();
            echo '<script> alert("Se ha Eliminado con Exito el Registro asociado al codigo: ' . $CodigoAUX . ' Recuerde Refrescar la pagina para ver la actualización de la Base de Datos")</script>';
            echo '<script> alert("La página Web Se actualizará automaticamente ")</script>';
            header('Refresh: 1; URL=VistaCrudcargosAux.php');  //una vez completada la accion, esto recargará la pagina y se actualizará los registros que se estan mostrando en las tablas, los cuales se traen directamente
            //de la base dedatos
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
        $objCargo = new Cargos($idcargo, $NombreCargo);
        $objControlCargo = new ControlCargos($objCargo);
        $CodigoAUX = $objCargo->getIdCargo();
        $ExisteRegistro = $objControlCargo->consultarAUX();
        if ($ExisteRegistro) {
             //el registro existe, Ejecuta el actualizar,
            //en caso contrario notifica que el registro no existe

            $objControlCargo->modificar();
            echo '<script> alert("El regstro asociado al codigo: ' . $CodigoAUX . ' Ha sido modificado con éxito Recuerde Refrescar la pagina para ver la actualización de la Base de Datos")</script>';
            echo '<script> alert("La página Web Se actualizará automaticamente ")</script>';
            header('Refresh: 1; URL=VistaCrudcargosAux.php');
            //header('Refresh: 2;location:vistaClientes.php');
        }//window.location=vistaClientes.php
        else {
            echo '<script> alert("El regstro asociado al codigo: ' . $CodigoAUX . ' No ha podio modificarse. Es posible que el registro asociado a dicho codigo no exista. \n INtente de nuevo")</script>';
        }
        $accion = null;
        break;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/vistaCargos.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD de Cargo</title>
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
          <h1>CRUD de Cargo</h1>
            <form action="VistaCrudCargosAux.php" method="POST">

                <div class="row">
                        <div class="col-md-6">
                            <label><p>Código del Cargo</p></label>
                            <input type="number" name="txtcodigocargo" id="codigo" class='form-control' maxlength="10" value="<?php echo'' .$idcargo.'' ?>">
                        </div>

                        <div class="col-md-6">
                            <label><p>Nombre Del Cargo:</p></label>
                            <input type="text" name="txtnombrecargo" id="nombre" class='form-control' maxlength="50" value="<?php echo'' .$NombreCargo.'' ?>">
                        </div>

                        <button type="submit" class="btn" name="accion" value="Crear" >Crear Datos Cargo</button>
                        <button type="submit" class="btn" name="accion" value="Consultar">Consultar Datos Cargo</button>
                        <button type="submit" class="btn" name="accion" value="Eliminar">Eliminar Cargo</button>
                        <button type="submit" class="btn" name="accion" value="Actualizar">Actualizar Datos Cargo</button>

                </div>
            </form>
        </div>

      </main>

</body>
</html>
