<?php
/**
 * En este archivo se detallara el modelo de tabla
 *
 * @author iago
 */

class MTabla {
    var $idTabla;
    var $nombreTabla;
    var $tipoTabla;
    var $mysqli; //atributo manejador de la BD
    
    function __construct($idTabla,$nombreTabla,$tipoTabla){
        $this->idTabla=$idTabla;
        $this->nombreTabla=$nombreTabla;
        $this->tipoTabla=$tipoTabla;
        
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }

    function insert(){
        if($this->nombreTabla<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Tabla WHERE nombre='$this->nombreTabla'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya
                $sql = "INSERT INTO Tabla (nombre,tipoTabla) VALUES ('$this->nombreTabla','$this->tipoTabla')";
                $this->mysqli->query($sql);
                return "Inserción realizada con éxito";
            }
            else { //si ya existe ese ej
                return "Ya existe en la base de datos";
            }
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    function delete(){
        $sql="SELECT * FROM Tabla WHERE idTabla='$this->idTabla'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Tabla WHERE idTabla='$this->idTabla'";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra la tabla";
        }
    }
    
    //borra la asignacion de ej previa
    function deleteAsignacionEj(){
        $sql = "DELETE FROM EjercicioTabla WHERE (idTabla='$this->idTabla')";
        $this->mysqli->query($sql);
        return "Borrado correctamente";
    }
    
    function deleteAsignacionTabla(){
        $sql = "DELETE FROM AsignacionTabla WHERE (idTabla='$this->idTabla')";
        $this->mysqli->query($sql);
        return "Borrado correctamente";
    }
            
    function update(){
        $sql="SELECT * FROM Tabla WHERE idTabla='$this->idTabla'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->nombreTabla==""){ //si nombre esta vacio se le añade el q ya tiene
                $nombreTabla=$tupla[1];
            }
            else{
                $nombreTabla= $this->nombreTabla;
            }
            $sql = "UPDATE Tabla SET nombre='$nombreTabla' WHERE idTabla=$this->idTabla";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el ejercicio";
        }
    }
    
    function select($idEntrenador){
        if($this->nombreTabla=="" && $this->tipoTabla==""){
            $sql="SELECT * FROM Tabla WHERE tipoTabla='Predeterminada' UNION SELECT Tabla.* FROM Tabla,AsignacionTabla,Usuario WHERE Tabla.tipoTabla='Personalizada' AND Tabla.idTabla=AsignacionTabla.idTabla AND AsignacionTabla.idUsuario=Usuario.Id_usuario AND Usuario.Id_entrenador='$idEntrenador'";
        }
        elseif($this->nombreTabla<>"" && $this->tipoTabla==""){
            $sql="SELECT * FROM Tabla WHERE tipoTabla='Predeterminada' AND nombre LIKE '%$this->nombreTabla%' UNION SELECT Tabla.* FROM Tabla,AsignacionTabla,Usuario WHERE Tabla.tipoTabla='Personalizada' AND Tabla.nombre='$this->nombreTabla' AND Tabla.idTabla=AsignacionTabla.idTabla AND AsignacionTabla.idUsuario=Usuario.Id_usuario AND Usuario.Id_entrenador='$idEntrenador'";
        }
        elseif($this->tipoTabla=="Predeterminada"){
            $sql="SELECT * FROM Tabla WHERE tipoTabla='$this->tipoTabla'";
            if($this->nombreTabla<>""){
                $sql.=" AND nombre LIKE '%$this->nombreTabla%'";
            }
        }
        elseif($this->tipoTabla=="Personalizada"){
            $sql="SELECT Tabla.* FROM Tabla,AsignacionTabla,Usuario WHERE Tabla.tipoTabla='$this->tipoTabla' AND Tabla.idTabla=AsignacionTabla.idTabla AND AsignacionTabla.idUsuario=Usuario.Id_usuario AND Usuario.Id_entrenador='$idEntrenador'";
            if($this->nombreTabla<>""){
                $sql.=" AND Tabla.nombre LIKE '%$this->nombreTabla%'";
            }
        }
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM Tabla WHERE idTabla='$this->idTabla'";
        if(($resultado=$this->mysqli->query($sql))){
            $tupla=$resultado->fetch_row();
            return $tupla;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    
    function selectNombre(){
        $sql="SELECT * FROM Tabla WHERE nombre='$this->nombreTabla'";
        if(($resultado=$this->mysqli->query($sql))){
            $tupla=$resultado->fetch_row();
            return $tupla;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectUser($idUsuario){
        $sql="SELECT Tabla.* FROM Tabla,AsignacionTabla,Usuario WHERE Tabla.idTabla=AsignacionTabla.idTabla AND AsignacionTabla.idUsuario=Usuario.Id_usuario AND Usuario.Id_usuario='$idUsuario'";
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectAsignacionesPEF($idEntrenador){
        $sql="SELECT Tabla.idTabla,Tabla.nombre,Tabla.tipoTabla,Usuario.Nombre,Usuario.DNI,Usuario.Id_usuario FROM Tabla,AsignacionTabla,Usuario WHERE Tabla.idTabla=AsignacionTabla.idTabla AND AsignacionTabla.idUsuario=Usuario.Id_usuario AND Usuario.Id_entrenador='$idEntrenador'";
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    function selectAsignacionesNorm(){
        $sql="SELECT Tabla.idTabla,Tabla.nombre,Tabla.tipoTabla,Usuario.Nombre,Usuario.DNI,Usuario.Id_usuario FROM Tabla,AsignacionTabla,Usuario WHERE Tabla.idTabla=AsignacionTabla.idTabla AND AsignacionTabla.idUsuario=Usuario.Id_usuario AND Usuario.Id_PerfilUsuario='4'";
        if(($resultado=$this->mysqli->query($sql))){
            return $resultado;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
        
    //asigna un ej a una tabla
    function asignarEjercicio($idEjercicio,$tiempo,$repeticion,$serie){
        if($this->idTabla<>"" && $idEjercicio<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM EjercicioTabla WHERE idTabla='$this->idTabla' AND idEjercicio='$idEjercicio'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya
                $sql = "INSERT INTO EjercicioTabla (idTabla,idEjercicio,tiempo,repeticion,serie) VALUES ('$this->idTabla','$idEjercicio','$tiempo','$repeticion','$serie')";
                $this->mysqli->query($sql);
                return "Inserción realizada con éxito";
            }
            else { //si ya existe
                return "Ya existe en la base de datos";
            }
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    //asigna una tabla a un usuario
    function asignarTabla($idUsuario){
        if($this->idTabla<>"" && $idUsuario<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM AsignacionTabla WHERE idTabla='$this->idTabla' AND idUsuario='$idUsuario'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya
                $sql = "INSERT INTO AsignacionTabla (idTabla,idUsuario) VALUES ('$this->idTabla','$idUsuario')";
                $this->mysqli->query($sql);
                return "Inserción realizada con éxito";
            }
            else { //si ya existe
                return "Ya existe en la base de datos";
            }
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    //quita la tabla a unos usuarios
    function quitarTabla($idUsuario){
        $sql="SELECT * FROM AsignacionTabla WHERE idTabla='$this->idTabla' AND idUsuario='$idUsuario'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql="DELETE FROM AsignacionTabla WHERE idTabla='$this->idTabla' AND idUsuario='$idUsuario'";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra el usuario";
        }
    }
    
    //devuelve los ejercicios q tienen asignados la tabla
    function ejsTabla(){
        $sql="SELECT Ejercicio.idEjercicio,Ejercicio.nombreEj,Ejercicio.tipoEj,EjercicioTabla.tiempo,EjercicioTabla.repeticion,EjercicioTabla.serie FROM Ejercicio,EjercicioTabla,Tabla WHERE Ejercicio.idEjercicio=EjercicioTabla.idEjercicio AND EjercicioTabla.idTabla=Tabla.idTabla AND Tabla.idTabla='$this->idTabla'";
        if($resultado= $this->mysqli->query($sql)){
            return $resultado;
        }
        else{
            return "El usuario no tiene asignado tablas";
        }
    }
    
    //devuelve los usuarios q tiene asignado este entrenador
    function usuariosPropios($idEntrenador){
        $sql="SELECT * FROM Usuario WHERE Id_entrenador='$idEntrenador'";
        if($resultado= $this->mysqli->query($sql)){
            return $resultado;
        }
        else{
            return "El entrenador no tiene asignado usuarios";
        }
    }
    
    function usuariosNormales(){
        $sql="SELECT * FROM Usuario WHERE Id_PerfilUsuario=4";
        if($resultado= $this->mysqli->query($sql)){
            return $resultado;
        }
        else{
            return "No hay usuarios normales";
        }
    }
    
    //cuenta el numero de tablas asignadas q tiene un user
    function numTablasUser($idUser){
        $sql="SELECT idTabla FROM AsignacionTabla WHERE idUsuario='$idUser'";
        $toret=$this->mysqli->query($sql);
        return $toret->num_rows;
    }
    
    public function __destruct(){
        desconexionBD($this->mysqli);
    }
}