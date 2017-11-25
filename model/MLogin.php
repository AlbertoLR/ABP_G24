<?php
/**
 *En este archivo se detallara el modelo de login
 *
 * @author iago
 */

class MLogin {
    var $login;
    var $password;
    var $mysqli;
    
    function __construct($login) {
        $this->login=$login;
        
        include_once "../ConexionBD.php";
        $this->mysqli=conexionBD();
    }
    
    function selectLogin($login){
        $sql="SELECT * FROM USUARIOS WHERE login='$this->login'";
        if(($resultado=$this->mysqli->query($sql))){
            $tupla=$resultado->fetch_row();
            return $tupla;
        }
        else{
            return false;
        }
    }
}
