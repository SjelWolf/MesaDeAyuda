<?php

class Cargos{
    
    var $idCargo;
    var $NombreCargo;
    function __construct($idCargo, $NombreCargo) {
        $this->idCargo = $idCargo;
        $this->NombreCargo = $NombreCargo;
    }
    function getIdCargo() {
        return $this->idCargo;
    }

    function getNombreCargo() {
        return $this->NombreCargo;
    }

    function setIdCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    function setNombreCargo($NombreCargo) {
        $this->NombreCargo = $NombreCargo;
    }


    
    
}

?>