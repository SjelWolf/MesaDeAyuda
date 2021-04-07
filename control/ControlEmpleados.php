<?php

//para llamar a un metodo, hay que instaklar la clase, es decir crear un objeto de la clase.
//en php $nombreObjeto=new nombre clase=(argumentos)
//para llamar un metodo se escribe  $nombreobjeto_>nombremetodo(argumentos)

class ControlEmpleados {

    var $objEmpleados; //Variable de un objeto que sera de tipo Empleado

    function __construct($objEmpleados) {
        $this->objEmpleados = $objEmpleados; //constructor de la clase Enpleado
    }

    function guardar() {
        //metodo de insercion en la tabla Empleados, hace uso de todos los atributos de la clase Empleados
        $idEmpleado = $this->objEmpleados->getIdEmpleado();
        $nombre = $this->objEmpleados->getNombre();
        $foto = $this->objEmpleados->getFoto();
        $hojaVida = $this->objEmpleados->getHojaVida();
        $telefono = $this->objEmpleados->getTelefono();
        $direccion = $this->objEmpleados->getDireccion();
        $X= $this->objEmpleados->getX();
        $Y= $this->objEmpleados->getY();
        $email= $this->objEmpleados->getEmail();
        $fkEmpleJefe= $this->objEmpleados->getFkEmple_Jefe();
        $fkArea= $this->objEmpleados->getFkArea();


       // $fkEmple = $this->objEmpleados->getEmpleadoEncargado();
        //$comandoSQL="insert into clientes values("insert into clientes values ('".$codigo."','".$nombre."','"  .$telefono."','".$email."',".$credito.")");
         $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        //SW2 se usa para informar si el comando sql se ejecuto de forma correta, si es asi devuelve verdadero y si no devuelve falso, Se usa para hacer comprobaciones En el formulario
        $sw2 = $objControlConexion->ejecutarComandoSql("insert into empleado values ('" . $idEmpleado . "','" . $nombre . "','".$foto."','".$hojaVida."','".$telefono."','".$email."','".$direccion."',".$X.",".$Y.",".$fkEmpleJefe.",'".$fkArea."')");
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
        $idEmpleado= $this->objEmpleados->getIdEmpleado();
        //$this->objEmpleados->setIdEmpleado($idEmpleado);
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $resultado = $objControlConexion->ejecutarSelect("Select * from empleado where IDEMPLEADO = " . $idEmpleado . ";");
        if ($resultado) {
            while ($mostrar = $resultado->fetch_array()) {
                $this->objEmpleados->setNombre($mostrar['NOMBRE']);
                $this->objEmpleados->setFoto($mostrar['FOTO']);
                $this->objEmpleados->setHojaVida($mostrar['HOJAVIDA']);
                $this->objEmpleados->setTelefono($mostrar['TELEFONO']);
                $this->objEmpleados->setEmail($mostrar['EMAIL']);
                $this->objEmpleados->setDireccion($mostrar['DIRECCION']);
                $this->objEmpleados->setX($mostrar['X']);
                 $this->objEmpleados->setY($mostrar['Y']);
                  $this->objEmpleados->setFkEmple_Jefe($mostrar['fkEMPLE_JEFE']);
                   $this->objEmpleados->setFkArea($mostrar['fkAREA']);

                //$this->objEmpleados->setTelefono($mostrar['FKEMPLE']);
                //$this->objEmpleados->setIdArea($mostrar['idArea']);
            }
        } //Metodo que consulta si un registro existe y lo aigna a una variable llamada resultado, se usa el fetch array para cambiar de los encabezados a los datos y se encapsulan
        $objControlConexion->cerrarBd();
        return $this->objEmpleados;
    }

    function consultarAUX() {
        $idEmpleado = $this->objEmpleados->getIdEmpleado();
        //$this->objEmpleados->setIdEmpleado($idEmpleado);
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $resultado = $objControlConexion->ejecutarSelect("Select * from empleado where IDEMPLEADO = " . $idEmpleado . ";");
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
        $idEmpleado = $this->objEmpleados->getIdEmpleado();
        $nombre = $this->objEmpleados->getNombre();
        $foto = $this->objEmpleados->getFoto();
        $hojaVida = $this->objEmpleados->getHojaVida();
        $telefono = $this->objEmpleados->getTelefono();
        $direccion = $this->objEmpleados->getDireccion();
        $X= $this->objEmpleados->getX();
        $Y= $this->objEmpleados->getY();
        $email= $this->objEmpleados->getEmail();
        $fkEmpleJefe= $this->objEmpleados->getFkEmple_Jefe();
        $fkArea= $this->objEmpleados->getFkArea();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $objControlConexion->ejecutarComandoSql("update empleado set NOMBRE='" . $nombre . "', FOTO='".$foto."', HOJAVIDA='".$hojaVida."', TELEFONO='".$telefono."', EMAIL='".$email."', DIRECCION='".$direccion."', X=".$X.",Y=".$Y.", fkEMPLE_JEFE='".$fkEmpleJefe."',fkAREA='".$fkArea."' where IDEMPLEADO = '" . $idEmpleado . "';");
        $objControlConexion->cerrarBd();
 //UPDATE `empleado` SET NOMBRE ='YUGI Trampas',FOTO='Ruta2',HOJAVIDA='Ruta 4',TELEFONO='5855',EMAIL='55',DIRECCION='Ckdd',X=-5.5998,Y=12.22,fkEMPLE_JEFE=NULL,fkAREA=40 WHERE IDEMPLEADO='2'
        //Encapsulacion de datos mediante get, se guardan en variables y se guardan en variables que posteriormente se usaran para modificar un registro
    }

    function borrar() {
        //$this->objEmpleados->setCodigo($codigo);
        $idEmpleado = $this->objEmpleados->getIdEmpleado();
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $objControlConexion->ejecutarComandoSql("delete from empleado  where IDEMPLEADO = '" . $idEmpleado . "';");
        $objControlConexion->cerrarBd();
        //elimina registros Segun el codigo que se envie
    }

    function listar() {
         //este metodo busca todos los registros de la tabla, los guarda en cinco variables, crea un objeto de la clase area y los envia a una matriz, hace uso de fetch array
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "", "mesa_ayuda");
        $resultado = $objControlConexion->ejecutarSelect("Select * from empleado;");
        $matriz = array();
        $i = 0;
        if ($resultado) {
            while ($mostrar = $resultado->fetch_array()) {
        //echo $mostrar['codigo'] . $mostrar['nombre'] . $mostrar['telefono'].$mostrar['email'].$mostrar['credito'].'<br>' ;
        $idEmpleado=$mostrar['IDEMPLEADO'];
        $nombre=$mostrar['NOMBRE'];
        $foto=$mostrar['FOTO'];
        $hojaVida = $mostrar['HOJAVIDA'];
        $telefono = $mostrar['TELEFONO'];
        $direccion = $mostrar['DIRECCION'];
        $X=$mostrar['X'];
        $Y=$mostrar['Y'];
        $email=$mostrar['EMAIL'];
        $fkEmpleJefe=$mostrar['fkEMPLE_JEFE'];
        $fkArea=$fkArea=$mostrar['fkAREA'];


                $objEmpleados = new Empleados($idEmpleado,$nombre,$foto,$hojaVida,$telefono,$email,$direccion,$X,$Y,$fkEmpleJefe,$fkArea);
                $matriz[$i] = $objEmpleados;
                $i++;
            }
        }
        return $matriz;
    }

}

?>
