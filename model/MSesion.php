<?php
/**
 * En este archivo se detallara el modelo de sesion
 *
 * @author iago
 */

class MSesion {
    var $idSesion;
    var $idUser;
    var $idTabla;
    var $nombreSesion;
    var $horaInicio;
    var $duracion;
    var $comentario;
    var $mysqli; //atributo manejador de la BD
    
    function __construct($idSesion,$idUser,$idTabla,$nombreSesion,$horaInicio,$duracion,$comentario) {
        $this->idSesion=$idSesion;
        $this->idUser=$idUser;
        $this->idTabla=$idTabla;
        $this->nombreSesion=$nombreSesion;
        $this->horaInicio=$horaInicio;
        $this->duracion=$duracion;
        $this->comentario=$comentario;
        
        include_once "../core/ConexionBD.php";
        $this->mysqli= conexionBD();
    }
    
    function insert(){
        if($this->idTabla<>"" && $this->nombreSesion<>""){
            $sql = "INSERT INTO Sesion (idUsuario,idTabla,nombreSesion,horaInicio,duracion,comentario) VALUES ('$this->idUser','$this->idTabla','$this->nombreSesion','$this->horaInicio','$this->duracion','$this->comentario')";
            $this->mysqli->query($sql);
            return "Inserción realizada con éxito";
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    function delete(){
        $sql="SELECT * FROM Sesion WHERE idSesion='$this->idSesion'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Sesion WHERE (idSesion='$this->idSesion')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra la sesion";
        }
    }
    
    function update(){
        $sql="SELECT * FROM Sesion WHERE idSesion='$this->idSesion'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->idTabla==""){ //si esta vacio se le añade el q ya tiene
                $idTabla=$tupla[2];
            }
            else{
                $idTabla=$this->idTabla;
            }
            if($this->nombreSesion==""){
                $nombreSesion=$tupla[3];
            }
            else{
                $nombreSesion=$this->nombreSesion;
            }
            if($this->comentario==""){
                $comentario=$tupla[6];
            }
            else{
                $comentario=$this->comentario;
            }
            $sql = "UPDATE Sesion SET idTabla='$idTabla',nombreSesion='$nombreSesion',comentario='$comentario' WHERE idSesion=$this->idSesion";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el ejercicio";
        }
    }
    
    function selectUser(){
        $sql="SELECT Sesion.idSesion,Sesion.nombreSesion,Tabla.idTabla,Tabla.nombre,Sesion.horaInicio FROM Sesion,Tabla WHERE Sesion.idTabla=Tabla.idTabla AND Sesion.idUsuario='$this->idUser'";
        if($this->idTabla<>"") $sql.=" AND Sesion.idTabla='$this->idTabla'";
        if($this->nombreSesion<>"") $sql.=" AND Sesion.nombreSesion LIKE '%$this->nombreSesion%'";
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectTipo($idPerfil,$idEntrenador){
        if($idPerfil==3) $sql="SELECT Sesion.idSesion,Sesion.nombreSesion,Tabla.idTabla,Tabla.nombre,Sesion.horaInicio,Usuario.DNI,Usuario.Nombre,Usuario.Apellido FROM Sesion,Tabla,Usuario WHERE Sesion.idTabla=Tabla.idTabla AND Sesion.idUsuario=Usuario.Id_usuario AND Usuario.Id_entrenador='$idEntrenador'";
        elseif($idPerfil==4) $sql="SELECT Sesion.idSesion,Sesion.nombreSesion,Tabla.idTabla,Tabla.nombre,Sesion.horaInicio,Usuario.DNI,Usuario.Nombre,Usuario.Apellido FROM Sesion,Tabla,Usuario WHERE Sesion.idTabla=Tabla.idTabla AND Sesion.idUsuario=Usuario.Id_usuario AND Usuario.Id_PerfilUsuario=$idPerfil";
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectEntrenador($nombreTabla,$DNI,$idEntrenador){
        //sql1 users PEF propios | sql2 users normales
        $sql1="SELECT Sesion.idSesion,Sesion.nombreSesion,Tabla.idTabla,Tabla.nombre,Sesion.horaInicio,Usuario.DNI,Usuario.Nombre,Usuario.Apellido FROM Sesion,Tabla,Usuario WHERE Sesion.idTabla=Tabla.idTabla AND Sesion.idUsuario=Usuario.Id_usuario AND Usuario.Id_entrenador='$idEntrenador' AND Usuario.Id_PerfilUsuario=3";
        $sql2="SELECT Sesion.idSesion,Sesion.nombreSesion,Tabla.idTabla,Tabla.nombre,Sesion.horaInicio,Usuario.DNI,Usuario.Nombre,Usuario.Apellido FROM Sesion,Tabla,Usuario WHERE Sesion.idTabla=Tabla.idTabla AND Sesion.idUsuario=Usuario.Id_usuario AND Usuario.Id_PerfilUsuario=4";
        if($nombreTabla<>""){
            $sql1.=" AND Tabla.nombre LIKE '%$nombreTabla%'";
            $sql2.=" AND Tabla.nombre LIKE '%$nombreTabla%'";
        }
        if($DNI<>""){
            $sql1.=" AND Usuario.DNI LIKE '%$DNI%'";
            $sql2.=" AND Usuario.DNI LIKE '%$DNI%'";
        }
        if($this->nombreSesion<>""){
            $sql1.=" AND Sesion.nombreSesion LIKE '%$this->nombreSesion%'";
            $sql2.=" AND Sesion.nombreSesion LIKE '%$this->nombreSesion%'";
        }
        if($this->horaInicio<>""){
            $sql1.=" AND Sesion.horaInicio LIKE '%$this->horaInicio%'";
            $sql2.=" AND Sesion.horaInicio LIKE '%$this->horaInicio%'";
        }
        $sql=$sql1." UNION ".$sql2;
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectID(){
        $sql="SELECT Sesion.idSesion,Sesion.nombreSesion,Tabla.idTabla,Tabla.nombre,Sesion.horaInicio,Sesion.duracion,Sesion.comentario FROM Sesion,Tabla WHERE Sesion.idTabla=Tabla.idTabla AND Sesion.idSesion='$this->idSesion'";
        if(($resultado=$this->mysqli->query($sql))){
            $tupla=$resultado->fetch_row();
            return $tupla;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
            
    function tablasUser(){
        $sql="SELECT AsignacionTabla.idTabla,Tabla.nombre FROM AsignacionTabla,Tabla WHERE AsignacionTabla.idTabla=Tabla.idTabla AND AsignacionTabla.idUsuario='$this->idUser'";
        if($resultado= $this->mysqli->query($sql)){
            return $resultado;
        }
        else{
            return "El usuario no tiene asignado tablas";
        }
    }
    
    function detalleTabla(){
        $sql="SELECT Tabla.idTabla,Tabla.nombre,Ejercicio.idEjercicio,Ejercicio.nombreEj,Ejercicio.tipoEj,EjercicioTabla.tiempo,EjercicioTabla.repeticion,EjercicioTabla.serie FROM Tabla,Ejercicio,EjercicioTabla WHERE Ejercicio.idEjercicio=EjercicioTabla.idEjercicio AND Tabla.idTabla=EjercicioTabla.idTabla AND Tabla.idTabla='$this->idTabla'";
        if($resultado= $this->mysqli->query($sql)){
            return $resultado;
        }
        else{
            return "No se econtro la tabla";
        }
    }


    public function __destruct(){
        desconexionBD($this->mysqli);
    }
}
