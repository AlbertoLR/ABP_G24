<?php
/**
 * En este archivo se detallara el modelo de PerfilUsuario
 *
 * @author Samu
 */


class MPerfilUsuario {
    var $Id_PerfilUsuario;
    var $Tipo;
    var $mysqli; //atributo manUsador de la BD
    
    function __construct($Id_PerfilUsuario,$Tipo){
        $this->Id_PerfilUsuario=$Id_PerfilUsuario;
        $this->Tipo=$Tipo;
       
        
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->Tipo<>""){ //el campo Tipo no esta vacio
            $sql="SELECT * FROM PerfilUsuario WHERE Tipo='$this->Tipo'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya un Us con ese Tipo
                $sql = "INSERT INTO PerfilUsuario (Tipo) VALUES ('$this->Tipo')";
                $this->mysqli->query($sql);
                return "Inserción realizada con éxito";
            }
            else { //si ya existe ese Us
                return "Ya existe en la base de datos";
            }
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    //borra una tupla en la BD
    function delete(){
        $sql="SELECT * FROM PerfilUsuario WHERE Id_PerfilUsuario='$this->Id_PerfilUsuario'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM PerfilUsuario WHERE (Id_PerfilUsuario='$this->Id_PerfilUsuario')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra el PerfilUsuario";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM PerfilUsuario WHERE Id_PerfilUsuario='$this->Id_PerfilUsuario'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->Tipo==""){ //si Tipo esta vacio se le añade el q ya tiene
                $Tipo=$tupla[1];
            }
            else{
                $Tipo= $this->Tipo;
           
            $sql = "UPDATE PerfilUsuario SET Tipo='$Tipo' WHERE Id_PerfilUsuario=$this->Id_PerfilUsuario";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
            }
        }else{
            return "No se encuentra el PerfilUsuario";
        }
    }
    
    function select(){
        if($this->Tipo==""){ //si se hace un select con campo vacio se entiende como un SHOWALL
            $sql="SELECT * FROM PerfilUsuario";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM PerfilUsuario WHERE Tipo='$this->Tipo'";
            if(($resultado=$this->mysqli->query($sql))){
                return $resultado;
            }
            else{
                return "La busqueda no ha devuelto resultado";
            }
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM PerfilUsuario WHERE Id_PerfilUsuario='$this->Id_PerfilUsuario'";
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