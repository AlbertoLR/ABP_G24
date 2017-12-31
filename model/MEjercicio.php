<?php
/**
 * En este archivo se detallara el modelo de ejercicio
 *
 * @author iago
 */


class MEjercicio {
    var $idEjercicio;
    var $nombreEj;
    var $descripcionEj;
    var $tipoEj;
    var $mysqli; //atributo manejador de la BD
    
    function __construct($idEjercicio,$nombreEj,$descripcionEj,$tipoEj){
        $this->idEjercicio=$idEjercicio;
        $this->nombreEj=$nombreEj;
        $this->descripcionEj=$descripcionEj;
        $this->tipoEj=$tipoEj;
        
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->nombreEj<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Ejercicio WHERE nombreEj='$this->nombreEj'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya un ej con ese nombre
                $sql = "INSERT INTO Ejercicio (nombreEj,descripcionEj,tipoEj) VALUES ('$this->nombreEj','$this->descripcionEj','$this->tipoEj')";
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
    
    //borra una tupla en la BD
    function delete(){
        $sql="SELECT * FROM Ejercicio WHERE idEjercicio='$this->idEjercicio'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Ejercicio WHERE (idEjercicio='$this->idEjercicio')";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra el ejercicio";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM Ejercicio WHERE idEjercicio='$this->idEjercicio'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->nombreEj==""){ //si nombre esta vacio se le añade el q ya tiene
                $nombreEj=$tupla[1];
            }
            else{
                $nombreEj= $this->nombreEj;
                $sql="SELECT * FROM Ejercicio WHERE nombreEj='$nombreEj'";
                $resultado= $this->mysqli->query($sql);
                    if ($resultado->num_rows==1) {
                        return "Ya existe un ejercicio con ese nombre";
                    }
            }
            if($this->descripcionEj==""){ //si descripcion esta vacia se le añade el q ya tiene
                $descripcionEj=$tupla[2];
            }
            else{
                $descripcionEj= $this->descripcionEj;
            }
            if($this->tipoEj==""){ //si descripcion esta vacia se le añade el q ya tiene
                $tipoEj=$tupla[3];
            }
            else{
                $tipoEj= $this->tipoEj;
            }
            
            $sql = "UPDATE Ejercicio SET nombreEj='$nombreEj',descripcionEj='$descripcionEj',tipoEj='$tipoEj' WHERE idEjercicio=$this->idEjercicio";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el ejercicio";
        }
    }
    
    function select(){
        if($this->nombreEj=="" && $this->tipoEj==""){ //si se hace un select con campos vacio se entiende como un SHOWALL
            $sql="SELECT * FROM Ejercicio";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM Ejercicio WHERE ";
            $segundo=FALSE;
            if($this->nombreEj<>""){
                $sql.="nombreEj LIKE '%$this->nombreEj%'";
                $segundo=TRUE;
            }
            if($this->tipoEj<>""){
                if($segundo){
                    $sql.=" AND ";
                }
                $sql.="tipoEj='$this->tipoEj'";
                $segundo=TRUE;
            }
        }
        if (!($resultado = $this->mysqli->query($sql))){
                return 'Error en la consulta sobre la base de datos';
            }
        else{
            return $resultado;
        }
    }

    function selectID(){
        $sql="SELECT * FROM Ejercicio WHERE idEjercicio='$this->idEjercicio'";
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