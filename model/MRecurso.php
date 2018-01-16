<?php
/**
 * En este archivo se detallara el modelo de Recurso
 *
 * @author iago
 */


class MRecurso {
    var $Id_Recurso;
    var $Nombre;
    var $Capacidad;
   
    var $mysqli; //atributo manUsador de la BD
    
    function __construct($Id_Recurso,$Nombre,$Capacidad){
        $this->Id_Recurso=$Id_Recurso;
        $this->Nombre=$Nombre;
        $this->Capacidad=$Capacidad;
      
        
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->Nombre<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Recurso WHERE Nombre='$this->Nombre'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya un Us con ese nombre
                $sql = "INSERT INTO Recurso (Nombre,Capacidad) VALUES ('$this->Nombre','$this->Capacidad')";
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
        $sql="SELECT * FROM Recurso WHERE Id_Recurso='$this->Id_Recurso'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Recurso WHERE (Id_Recurso='$this->Id_Recurso')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra el Recurso";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM Recurso WHERE Id_Recurso='$this->Id_Recurso'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->Nombre==""){ //si nombre esta vacio se le añade el q ya tiene
                $Nombre=$tupla[1];
            }
            else{
                $Nombre= $this->Nombre;
            }if($this->Capacidad==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Capacidad=$tupla[2];
            }
            else{
                $Capacidad= $this->Capacidad;
            
            }
            $sql = "UPDATE Recurso SET Nombre='$Nombre',Capacidad='$Capacidad' WHERE Id_Recurso=$this->Id_Recurso";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el Recurso";
        }
    }
    
    function select(){
        if($this->Nombre==""){ //si se hace un select con campo vacio se entiende como un SHOWALL
            $sql="SELECT * FROM Recurso";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM Recurso WHERE Nombre='$this->Nombre'";
            if(($resultado=$this->mysqli->query($sql))){
                return $resultado;
            }
            else{
                return "La busqueda no ha devuelto resultado";
            }
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM Recurso WHERE Id_Recurso='$this->Id_Recurso'";
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