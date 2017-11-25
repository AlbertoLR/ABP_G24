<?php
/**
 * En este archivo se detallara el modelo de accion
 *
 * @author alberto
 */


class MAccion {
    var $idAccion;
    var $nombreAc;
    var $mysqli; //atributo manejador de la BD
    
    function __construct($idAccion,$nombreAc){
        $this->idAccion=$idAccion;
        $this->nombreAc=$nombreAc;
                
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->nombreAc<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Accion WHERE nombreAc='$this->nombreAc'";
            $resultado=$this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya una acción con ese nombre
                $sql = "INSERT INTO Accion (nombreAc) VALUES ('$this->nombreAc')";
                $this->mysqli->query($sql);
                return "Inserción realizada con éxito";
            }
            else { //si ya existe esa accion
                return "Ya existe en la base de datos";
            }
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    //borra una tupla en la BD
    function delete(){
        $sql="SELECT * FROM Accion WHERE idAccion='$this->idAccion'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Accion WHERE (idAccion='$this->idAccion')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra la acción";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM Accion WHERE idAccion='$this->idAccion'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->nombreAc==""){ //si nombre esta vacio se le añade el que ya tiene
                $nombreAc=$tupla[1];
            }
            else{
                $nombreAc=$this->nombreAc;
            }
            $sql = "UPDATE Accion SET nombreAc='$nombreAc' WHERE idAccion=$this->idAccion";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra la acción";
        }
    }
    
    function select(){
        if($this->nombreAc==""){ //si se hace un select con campo vacio se entiende como un SHOWALL
            $sql="SELECT * FROM Accion";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM Accion WHERE nombreAc LIKE '%$this->nombreAc%'";
            if(($resultado=$this->mysqli->query($sql))){
                return $resultado;
            }
            else{
                return "La busqueda no ha devuelto resultado";
            }
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM Accion WHERE idAccion='$this->idAccion'";
        if(($resultado=$this->mysqli->query($sql))){
            $tupla=$resultado->fetch_row();
            return $tupla;
        }
        else{
            return "La busqueda no ha devuelto resultado";
        }
    }
    
    public function __destruct(){
        desconexionBD($this->mysqli);
    }
}
?>