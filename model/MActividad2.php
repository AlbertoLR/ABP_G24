<?php
/**
 * En este archivo se detallara el modelo de Actividad
 *
 * @author Samu
 */


class MActividad2 {
    var $Id_Actividad;
    var $Nombre;
    var $Sala;
    var $HoraInicio;
    var $HoraFin;
    var $Dia;
    var $mysqli; //atributo manUsador de la BD
    
    function __construct($Id_Actividad,$Nombre,$Sala,$Capacidad,$HoraInicio,$HoraFin,$Dia){
        $this->Id_Actividad=$Id_Actividad;
        $this->Nombre=$Nombre;
        $this->Sala=$Sala;
        $this->Capacidad=$Capacidad;
        $this->HoraInicio=$HoraInicio;
        $this->HoraFin=$HoraFin;
        $this->Dia=$Dia;
        
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->Nombre<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Actividad WHERE Nombre='$this->Nombre'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya un Us con ese nombre
                $sql = "INSERT INTO Actividad (Nombre,Sala,Capacidad,HoraInicio,HoraFin,Dia) VALUES ('$this->Nombre','$this->Sala','$this->Capacidad','$this->HoraInicio','$this->HoraFin','$this->Dia')";
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
        $sql="SELECT * FROM Actividad WHERE Id_Actividad='$this->Id_Actividad'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Actividad WHERE (Id_Actividad='$this->Id_Actividad')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra la Actividad";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM Actividad WHERE Id_Actividad='$this->Id_Actividad'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->Nombre==""){ //si nombre esta vacio se le añade el q ya tiene
                $Nombre=$tupla[1];
            }
            else{
                $Nombre= $this->Nombre;
            }if($this->Sala==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Sala=$tupla[2];
            }
            else{
                $Sala= $this->Sala;
            }
             if($this->Capacidad==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Capacidad=$tupla[3];
            }
            else{
                $Capacidad= $this->Capacidad;
            
             }if($this->HoraInicio==""){ //si descripcion esta vacia se le añade el q ya tiene
                $HoraInicio=$tupla[4];
            }
            else{
                $HoraInicio= $this->HoraInicio;
             }if($this->HoraFin==""){ //si descripcion esta vacia se le añade el q ya tiene
                $HoraFin=$tupla[5];
            }
            else{
                $HoraFin= $this->HoraFin;
            
            
             }if($this->Dia==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Dia=$tupla[6];
            }
            else{
                $Dia= $this->Dia;
            }
            
            $sql = "UPDATE Actividad SET Nombre='$Nombre',Sala='$Sala',Capacidad='$Capacidad',HoraInicio='$HoraInicio',HoraFin='$HoraFin',Dia='$Dia' WHERE Id_Actividad=$this->Id_Actividad";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el Actividad";
        }
    }
    
    function select(){
        if($this->Nombre==""){ //si se hace un select con campo vacio se entiende como un SHOWALL
            $sql="SELECT * FROM Actividad";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM Actividad WHERE Nombre='$this->Nombre'";
            if(($resultado=$this->mysqli->query($sql))){
                return $resultado;
            }
            else{
                return "La busqueda no ha devuelto resultado";
            }
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM Actividad WHERE Id_Actividad='$this->Id_Actividad'";
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