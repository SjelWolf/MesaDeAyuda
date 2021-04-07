<?php
class Empleados{
     var $idEmpleado;
     var $Nombre;
     var $foto;
     var $hojaVida;
     var $telefono;
     var $email;
     var $direccion;
     var $X;
     var $Y;
     var $fkEmple_Jefe;
     var $fkArea;
     function __construct($idEmpleado, $Nombre, $foto, $hojaVida, $telefono, $email, $direccion, $X, $Y, $fkEmple_Jefe, $fkArea) {
         $this->idEmpleado = $idEmpleado;
         $this->Nombre = $Nombre;
         $this->foto = $foto;
         $this->hojaVida = $hojaVida;
         $this->telefono = $telefono;
         $this->email = $email;
         $this->direccion = $direccion;
         $this->X = $X;
         $this->Y = $Y;
         $this->fkEmple_Jefe = $fkEmple_Jefe;
         $this->fkArea = $fkArea;
     }
     function getIdEmpleado() {
         return $this->idEmpleado;
     }

     function getNombre() {
         return $this->Nombre;
     }

     function getFoto() {
         return $this->foto;
     }

     function getHojaVida() {
         return $this->hojaVida;
     }

     function getTelefono() {
         return $this->telefono;
     }

     function getEmail() {
         return $this->email;
     }

     function getDireccion() {
         return $this->direccion;
     }

     function getX() {
         return $this->X;
     }

     function getY() {
         return $this->Y;
     }

     function getFkEmple_Jefe() {
         return $this->fkEmple_Jefe;
     }

     function getFkArea() {
         return $this->fkArea;
     }

     function setIdEmpleado($idEmpleado) {
         $this->idEmpleado = $idEmpleado;
     }

     function setNombre($Nombre) {
         $this->Nombre = $Nombre;
     }

     function setFoto($foto) {
         $this->foto = $foto;
     }

     function setHojaVida($hojaVida) {
         $this->hojaVida = $hojaVida;
     }

     function setTelefono($telefono) {
         $this->telefono = $telefono;
     }

     function setEmail($email) {
         $this->email = $email;
     }

     function setDireccion($direccion) {
         $this->direccion = $direccion;
     }

     function setX($X) {
         $this->X = $X;
     }

     function setY($Y) {
         $this->Y = $Y;
     }

     function setFkEmple_Jefe($fkEmple_Jefe) {
         $this->fkEmple_Jefe = $fkEmple_Jefe;
     }

     function setFkArea($fkArea) {
         $this->fkArea = $fkArea;
     }


}
?>