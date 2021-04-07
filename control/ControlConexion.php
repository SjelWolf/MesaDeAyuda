<?php

class ControlConexion {

    var $conn;

    function __construct() {
        $this->conn = null;
    }

    function abrirBd($servidor, $usuario, $password, $db) {
        try {
            $this->conn = new mysqli($servidor, $usuario, $password, $db);
            /* if ($this->conn->connect_errno) {
              printf("Connect failed: %s\n", $this->conn->connect_error);
              exit();
              } */
        } catch (Exception $e) {
            echo "Error al Establecer Conexión con el Servidor  " . $e->getMessage() . "\n";
        }
    }

    function cerrarBd() {
        try {
            $this->conn->close();
        } catch (Exception $e) {
            echo "Error al Establecer Conexión con el Servidor " . $e->getMessage() . "\n";
        }
    }

    function ejecutarComandoSql($sql) { //$$ $SQl debe ser insert into, update, delete
        try {
            $inserto = $this->conn->query($sql);
        } catch (Exception $e) {
            echo " Los Registros No Fueron Modificados: " . $e->getMessage() . "\n";
        }
        return $inserto; //metodo modificado del que se vio en clase, devuelve verdadero o falso, segun el resultado del query que se implmento
    }

    function ejecutarSelect($sql) {
        try {
            $recordSet = $this->conn->query($sql);
        } catch (Exception $e) {
            echo " Ha ocurrido un error: " . $e->getMessage() . "\n";
        }
        return $recordSet;
    }

}

?>