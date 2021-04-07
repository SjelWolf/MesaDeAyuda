<!DOCTYPE html>
<?php
//Inclusion de las carpetas y los archivos de de modelo y control de las distintas entidades
include '../Control/ControlAreas.php';
include '../Modelo/Areas.php';
include '../Control/ControlConexion.php';
include '../Control/ControlEmpleados.php';
include '../Modelo/Empleados.php';
//-------------------FIN INclusion Modelos y Controles
//--------------------------------------------------- Instanciacion de la clase Empleado y control Empleados
$objEmpleados= new Empleados('', '', '','', '','' ,'','' ,'' ,'' ,'' );
$objControlEmpleados= new ControlEmpleados($objEmpleados);
$MatrizEmpleados1=$objControlEmpleados->listar();
///Esto se hace con el fin de llenar una mtriz con todos los empleados, los cuales e usarán más tarde para construri un select type llamando directamente desde la base de datos
//-------------------------------------Fin instanciación de la clase Control Empleados
//Este 'Si' se utiliza para mostrar en un parrafo que Acción fue la que se seleccionó para ejecutarse

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
//se guarda en una variable llamada accion el valor que se trae de los botones mediante el metodo POST
    echo '<h1> <center> <p style=" font-size: 45px;font-family:Comic Sans MS" > La Opción que se ha elegido es:  ' . $accion . '</p></center></h1>';
//echo'<p style=" font-size: 45px;font-family:Britannic" ></p>';
} else {
    $accion = null;
}

//Se asigna los valores guardados en POSt a diferentes variables donde se van a guardar los datos que se usarán para operar los diferentes metodos
$idArea = isset($_POST['txtidarea']) ? $_POST['txtidarea'] : null;
$NombreArea = isset($_POST['txtnombrearea']) ? $_POST['txtnombrearea'] : null;
$Encargado = isset($_POST['txtEmpleadoEncargado']) ? $_POST['txtEmpleadoEncargado'] : null;

switch ($accion) {// declaración de una Estructura Switch para manejar las diferentes opciones

    case 'Crear':
        $objArea = new Areas($idArea, $NombreArea,$Encargado);//Se instancia la clase areas y se declara un objeto de tipo areas y se crea una instancia area mediante el constructor
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
            $objArea1 = new Areas($idArea, '','');//se instancia la clase area y se crea un objeto de tipo area que solo hara uso del id de area
            $objControlArea1 = new ControlAreas($objArea1);//Se declara y se instancia un objeto de tipo control de area
            $ExisteRegistro = $objControlArea1->consultarAUX($objArea1->getIdArea()); //metodo auxilair que nos ayudará a saber si una consulta devuelve un recordset vacio o no vacio, con el fin de comprobar si
            ////el registro si existe y asi ademas es no vacio
             //--Uso Auxiliar------Fin
            if ($ExisteRegistro) {
                $objArea2 = new Areas($idArea, '','');//se instancia y se crea un objeto area solo con el codigo
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
        $objArea = new Areas($idArea, '','');
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
        $objArea = new Areas($idArea, $NombreArea,$Encargado);
        $objControlAreas = new ControlAreas($objArea);
        $CodigoAUX = $objArea->getIdArea();
        $ExisteRegistro = $objControlAreas->consultarAUX($idArea);
        if ($ExisteRegistro){
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
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>C.R.U.D De Áreas</title>
    </head>

    <body>
    <center> <H1 style=" font-style: bold; font-size: 65px;font-family:'Bradley Hand ITC'" >C.R.U.D De Áreas</H1> </center>



    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><center><h2 style=" font-size: 45px;font-family:'Maiandra GD'" >Ingreso de Datos Inicial</h2></center></div>
                    <br>
                    <br>
                    <div class="col-sm-8"><center><h2 style=" font-size: 25px;font-family:'Maiandra GD'" >Nota: Si desea modificar un registro,:<br>
                                Consulte el usuario que desee modificar, luego ingrese los datos que vaya a modificar y seleccione modificar <br>
                          </h2></center></div>

                    <div class="col-sm-4">
                        <a href="../index.php" class="btn btn-secondary add-new"><i class="fa fa-arrow-left"></i> Volver al indice</a>
                    </div>
                </div>
            </div>
        </div>
        <form action="VistaCrudAreasAux.php" method="POST">

            <div class="row">
                <div class="col-md-6">
                    <label><p style=" font-size: 45px;font-family:'Britannic'" >Identificacion Área</p></label>
                    <input type="text" name="txtidarea" id="nombres" class='form-control' maxlength="10"  value="<?php echo'' . $idArea; ?>" >
                </div>

                <div class="col-md-6">
                    <label><p style=" font-size: 45px;font-family:'Britannic'" >Nombre Área:</p></label>
                    <input type="text" name="txtnombrearea" id="nombres" class='form-control' maxlength="50" value="<?php echo'' . $NombreArea; ?>" >
                </div>
                   <div class="col-md-6">
                        <label><p style=" font-size: 45px;font-family:'Maiandra GD'" >Empleado Encargado Área:</p></label>
                         <select name="txtEmpleadoEncargado" class="form-select form-select-lg mb-4"  aria-label=".form-select-lg example">
                        <?php foreach ($MatrizEmpleados1 as $Empleados){

                        ?>


                            <?php
                            echo '<option value='.$Empleados->getIdEmpleado().'>'.$Empleados->getNombre().'</option>';
                        ?>

                           <?php
                        }?>
                             <option value="NULL" selected="selected">Encargado Sin Asignar</option>
                        </select>
                        <!--<input type="text" name="txtnombrearea" id="nombre" class='form-control' maxlength="50">-->
                    </div>
                 <div class="col-md-6">
                    <label><p style=" font-size: 45px;font-family:'Britannic'" >Visualización Nombre Área:</p></label>
                    <?php
                $objEmpleado2=new Empleados($Encargado, '', '', '', '', '', '', '', '', '', '');
                $objControlempleado2= new ControlEmpleados($objEmpleado2);
                $objControlempleado2->consultar();
                $Encargado=$objEmpleado2->getNombre();
                    if (empty($Encargado)){
                        //echo '<p> Junior </p>';
                        $Encargado='Encargado sin asignar';
                    }
                    ?>
                    <input type="text" name="txtnombrearea" id="nombres" class='form-control' maxlength="50" value="<?php echo'' .$Encargado.'' ?>" disabled="true" >
                </div>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <center>
                    <button type="submit" class="btn btn-success" name="accion" value="Crear" >Crear Datos Area</button>
                    <button type="submit" class="btn btn-info" name="accion" value="Consultar">Consultar Datos Area</button>
                    <button type="submit" class="btn btn-danger" name="accion" value="Eliminar">Eliminar Area</button>
                    <button type="submit" class="btn btn-primary" name="accion" value="Actualizar">Actualizar Datos Área</button>
                </center>
            </div>
        </form>
    </div>

</body>
</html>
