<?php

class Areas { //Modelo de la clase Area, con sus atributos, constructor , getters y setters

    var $idArea;
    var $Nombre;
    var $EmpleadoEncargado;

    function __construct($idArea, $Nombre,$EmpleadoEncargado) {
        $this->idArea = $idArea;
        $this->Nombre = $Nombre;
        $this->EmpleadoEncargado=$EmpleadoEncargado;
    }
    
      function setIdArea($idArea) {
        $this->idArea = $idArea;
    }

    function getIdArea() {
        return $this->idArea;
    }
    function getNombre() {
        return $this->Nombre;
    }

    function getEmpleadoEncargado() {
        return $this->EmpleadoEncargado;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setEmpleadoEncargado($EmpleadoEncargado) {
        $this->EmpleadoEncargado = $EmpleadoEncargado;
    }


}
?>