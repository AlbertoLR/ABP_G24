<?php
/**
 * En este archivo se detallara el controlador de login
 *
 * @author iago
 */

session_start();

include '../model/MLogin.php';
include '../view/VLogin.php';
include '../view/MESSAGE_View.php';

if(!isset($_REQUEST['dni'])){
    new VLogin();
}
 else {
    $dni=$_REQUEST['dni'];
    $password=$_REQUEST['password'];
    
    $user=new MLogin($dni);
    if($tuplaUser=$user->selectDNI()){
        if($password==$tuplaUser[4]){
            $_SESSION['Id_usuario']=$tuplaUser[0];
            $_SESSION['Nombre']=$tuplaUser[1];
            $_SESSION['DNI']=$dni;
            $_SESSION['Id_PerfilUsuario']=$tuplaUser[3];
            
            new MESSAGE_View("Bienvenido $tuplaUser[1]","../index.php");
        }
        else {
            new MESSAGE_View("Contraseña incorrecta","../index.php");
        }
    }
    else{
        new MESSAGE_View("El usuario no existe","../index.php");
    }
}