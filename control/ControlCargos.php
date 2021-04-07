<?php

//para llamar a un metodo, hay que instaklar la clase, es decir crear un objeto de la clase.
//en php $nombreObjeto=new nombre clase=(argumentos)
//para llamar un metodo se escribe  $nombreobjeto_>nombremetodo(argumentos)

class ControlCargos {

    var $objCargo; //Variable de un objeto que sera de tipo Empleado

    function __construct($objCargo) {
        $this->objCargo = $objCargo; //constructor de la clase Enpleado
    }

    function guardar() {
        //metodo de insercion en la tabla Empleados, hace uso de todos los atributos de la clase Empleados
        //$idCargo = $this->objCargo->getIdCargo();
        $nombre = $this->objCargo->getNombreCargo();
        //$fkEmple = $this->objCargo->getEmpleadoEncargado();
        //$comandoSQL="insert into clientes values("insert into clientes values ('".$codigo."','".$nombre."','"  .$telefono."','".$email."',".$credito.")");
         $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        //SW2 se usa para informar si el comando sql se ejecuto de forma correta, si es asi devuelve verdadero y si no devuelve falso, Se usa para hacer comprobaciones En el formulario
        $sw2 = $objControlConexion->ejecutarComandoSql("insert into cargo(NOMBRE) values ('" . $nombre . "')");
        if ($sw2) {
            echo '<script>alert("Registro Exitoso")</script>';
        } else { ////////////mensajes de alerta
            echo '<script>alert("Clave Primaria Repetida o Campos Vacios")</script>';
        }
        $objControlConexion->cerrarBd();
        return $sw2;
        //ejecutarComandoSql
        //ejecutarSelect
    }

    function consultar() {
        $idCargo = $this->objCargo->getIdCargo();
        //$this->objCargo->setIdEmpleado($idEmpleado);
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $resultado = $objControlConexion->ejecutarSelect("Select * from cargo where IDCARGO = " . $idCargo . ";");
        if ($resultado) {
            while ($mostrar = $resultado->fetch_array()) {
                $this->objCargo->setNombreCargo($mostrar['NOMBRE']);
                //$this->objCargo->setTelefono($mostrar['FKEMPLE']);
                //$this->objCargo->setIdArea($mostrar['idArea']);
            }
        } //Metodo que consulta si un registro existe y lo aigna a una variable llamada resultado, se usa el fetch array para cambiar de los encabezados a los datos y se encapsulan
        $objControlConexion->cerrarBd();
        return $this->objCargo;
    }

    function consultarAUX() {
        $idCargo = $this->objCargo->getIdCargo();
        //$this->objCargo->setIdEmpleado($idEmpleado);
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $resultado = $objControlConexion->ejecutarSelect("Select * from cargo where IDCARGO = " . $idCargo . ";");
        $SW;
        if ($resultado->num_rows === 0) {
            $SW = false;
        } else {
            $SW = true;
        }
        $objControlConexion->cerrarBd();
        return $SW;
         //metodo auxiliar de consulta, al igual que el consultar normal, este metodo devuelve verdadero si el recordset que devuelve el
         // ejecutar select contiene datos, en caso contrario devuelve falso
        //si la consulta que se realiza arrroja un conjunto de datos vacio
    }

    function modificar() {
        $idCargo = $this->objCargo->getIdCargo();
        $nombre = $this->objCargo->getNombreCargo();
        //$idArea = $this->objCargo->getIdArea();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $objControlConexion->ejecutarComandoSql("update cargo set NOMBRE='" . $nombre ."' where IDCARGO = " . $idCargo . ";");
        $objControlConexion->cerrarBd();
        //Encapsulacion de datos mediante get, se guardan en variables y se guardan en variables que posteriormente se usaran para modificar un registro
    }

    function borrar() {
        //$this->objCargo->setCodigo($codigo);
        $idCargo = $this->objCargo->getIdCargo();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $objControlConexion->ejecutarComandoSql("delete from cargo  where IDCARGO = " . $idCargo . ";");
        $objControlConexion->cerrarBd();
        //elimina registros Segun el codigo que se envie
    }

    function listar() {
         //este metodo busca todos los registros de la tabla, los guarda en cinco variables, crea un objeto de la clase area y los envia a una matriz, hace uso de fetch array
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $resultado = $objControlConexion->ejecutarSelect("Select * from cargo;");
        $matriz = array();
        $i = 0;
        if ($resultado) {
            while ($mostrar = $resultado->fetch_array()) {
                //echo $mostrar['codigo'] . $mostrar['nombre'] . $mostrar['telefono'].$mostrar['email'].$mostrar['credito'].'<br>' ;
                $nombre = $mostrar['NOMBRE'];
                $idCargo = $mostrar['IDCARGO'];
                //$EmpleadoEncargado = $mostrar['FKEMPLE'];
                //$idArea = $mostrar['idArea'];
                $objCargo = new Cargos($idCargo, $nombre);
                $matriz[$i] = $objCargo;
                $i++;
            }
        }
        return $matriz;
    }

}

?>