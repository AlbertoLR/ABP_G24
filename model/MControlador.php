<?php
/**
 * En este archivo se detallara el modelo de controlador
 *
 * @author alberto
 */


class MControlador {
    var $idControlador;
    var $nombreCt;
    var $mysqli; //atributo manejador de la BD
    
    function __construct($idControlador,$nombreCt){
        $this->idControlador=$idControlador;
        $this->nombreCt=$nombreCt;
                
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->nombreCt<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Controlador WHERE nombreCt='$this->nombreCt'";
            $resultado=$this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya un ct con ese nombre
                $sql = "INSERT INTO Controlador (nombreCt) VALUES ('$this->nombreCt')";
                $this->mysqli->query($sql);
                return "Inserción realizada con éxito";
            }
            else { //si ya existe ese ct
                return "Ya existe en la base de datos";
            }
        }
        else{
            return "Introduzca los datos necesarios";
        }
    }
    
    //borra una tupla en la BD
    function delete(){
        $sql="SELECT * FROM Controlador WHERE idControlador='$this->idControlador'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Controlador WHERE (idControlador='$this->idControlador')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra el controlador";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM Controlador WHERE idControlador='$this->idControlador'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->nombreCt==""){ //si nombre esta vacio se le añade el q ya tiene
                $nombreCt=$tupla[1];
            }
            else{
                $nombreCt = $this->nombreCt;
            }
            $sql = "UPDATE Controlador SET nombreCt='$nombreCt' WHERE idControlador=$this->idControlador";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el controlador";
        }
    }
    
    function select(){
        if($this->nombreCt==""){ //si se hace un select con campo vacio se entiende como un SHOWALL
            $sql="SELECT * FROM Controlador";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM Controlador WHERE nombreCt LIKE '%$this->nombreCt%'";
            if(($resultado=$this->mysqli->query($sql))){
                return $resultado;
            }
            else{
                return "La busqueda no ha devuelto resultado";
            }
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM Controlador WHERE idControlador='$this->idControlador'";
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