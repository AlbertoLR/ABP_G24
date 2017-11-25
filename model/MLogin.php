<?php
/**
 *En este archivo se detallara el modelo de login
 *
 * @author iago
 */

class MLogin {
    var $dni;
    var $mysqli;
    
    function __construct($dni) {
        $this->dni=$dni;
        
        include_once "../ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    function selectDNI(){
        $sql="SELECT * FROM Usuario WHERE DNI='$this->dni'";
        if(($resultado=$this->mysqli->query($sql))){
            $tupla=$resultado->fetch_row();
            return $tupla;
        }
        else{
            return false;
        }
    }
}
