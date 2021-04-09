<?php

class CargoEmpleados{
     
    var $fkCargo;
    var $fkEmple;
    var $fechaIni;
    var $fechaFin;
    function __construct($fkCargo, $fkEmple, $fechaIni, $fechaFin) {
        $this->fkCargo = $fkCargo;
        $this->fkEmple = $fkEmple;
        $this->fechaIni = $fechaIni;
        $this->fechaFin = $fechaFin;
    }
    function getFkCargo() {
        return $this->fkCargo;
    }

    function getFkEmple() {
        return $this->fkEmple;
    }

    function getFechaIni() {
        return $this->fechaIni;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function setFkCargo($fkCargo) {
        $this->fkCargo = $fkCargo;
    }

    function setFkEmple($fkEmple) {
        $this->fkEmple = $fkEmple;
    }

    function setFechaIni($fechaIni) {
        $this->fechaIni = $fechaIni;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }


    
}
?>