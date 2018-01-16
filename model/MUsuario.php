<?php
/**
 * En este archivo se detallara el modelo de Usuario
 *
 * @author iago
 */


class MUsuario {
    var $Id_usuario;
    var $Nombre;
    var $Apellido;
    var $DNI;
    var $Telefono;
    var $Id_PerfilUsuario;
    var $password;
    var $mysqli; //atributo manUsador de la BD
    
    function __construct($Id_usuario,$Nombre,$Apellido,$DNI,$Telefono,$Id_PerfilUsuario,$password){
        $this->Id_usuario=$Id_usuario;
        $this->Nombre=$Nombre;
        $this->Apellido=$Apellido;
        $this->DNI=$DNI;
        $this->Telefono=$Telefono;
        $this->Id_PerfilUsuario=$Id_PerfilUsuario;
         $this->password=$password;
        //incluimos de manera unitaria la funcion de conexion a la BD
        include_once "../core/ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    //inserta una nueva tupla en la BD
    function insert(){
        if($this->Nombre<>""){ //el campo nombre no esta vacio
            $sql="SELECT * FROM Usuario WHERE Nombre='$this->Nombre'";
            $resultado= $this->mysqli->query($sql);
            if ($resultado->num_rows==0) { //comprobamos q no exita ya un Us con ese nombre
                $sql = "INSERT INTO Usuario (Nombre,Apellido,DNI,Telefono,Id_PerfilUsuario,password) VALUES ('$this->Nombre','$this->Apellido','$this->DNI','$this->Telefono','$this->Id_PerfilUsuario','$this->password')";
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
        $sql="SELECT * FROM Usuario WHERE Id_usuario='$this->Id_usuario'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a borrar
            $sql = "DELETE FROM Usuario WHERE Id_usuario='$this->Id_usuario'";
            $this->mysqli->query($sql);
            return "Borrado correctamente";
        }
        else{
            return "No se encuentra el Usuario";
        }
    }
    
    //edita una tupla en la BD 
    function update(){
        $sql="SELECT * FROM Usuario WHERE Id_usuario='$this->Id_usuario'";
        $resultado= $this->mysqli->query($sql);
        if ($resultado->num_rows==1) { //si encuentra la tupla a editar
            $tupla=$resultado->fetch_row();
            if($this->Nombre==""){ //si nombre esta vacio se le añade el q ya tiene
                $Nombre=$tupla[1];
            }
            else{
                $Nombre= $this->Nombre;


                }if($this->Apellido==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Apellido=$tupla[2];
            }
            else{
                $Apellido= $this->Apellido;




            }if($this->DNI==""){ //si descripcion esta vacia se le añade el q ya tiene
                $DNI=$tupla[3];
            }
            else{
                $DNI= $this->DNI;



            }if($this->Telefono==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Telefono=$tupla[4];
            }
            else{
                $Telefono= $this->Telefono;




            }if($this->Id_PerfilUsuario==""){ //si descripcion esta vacia se le añade el q ya tiene
                $Id_PerfilUsuario=$tupla[5];
            }
            else{
                $Id_PerfilUsuario= $this->Id_PerfilUsuario;
            }
            $sql = "UPDATE Usuario SET Nombre='$Nombre',Apellido='$Apellido',DNI='$DNI',Telefono='$Telefono',Id_PerfilUsuario='$Id_PerfilUsuario' WHERE Id_usuario=$this->Id_usuario";
            $this->mysqli->query($sql);
            return "Modificado correctamente";
        }
        else{
            return "No se encuentra el Usuario";
        }
    }
    
    function select(){
        if($this->DNI==""){ //si se hace un select con campo vacio se entiende como un SHOWALL
            $sql="SELECT * FROM Usuario";
            $resultado=$this->mysqli->query($sql);
            return $resultado;
        }
        else{
            $sql="SELECT * FROM Usuario WHERE DNI='$this->DNI'";
            if(($resultado=$this->mysqli->query($sql))){
                return $resultado;
            }
            else{
                return "La busqueda no ha devuelto resultado";
            }
        }
    }
    
    function selectID(){
        $sql="SELECT * FROM Usuario WHERE Id_usuario='$this->Id_usuario'";
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