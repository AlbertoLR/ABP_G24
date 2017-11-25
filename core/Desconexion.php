<?php
/**
 * En este archivo se cerrara la conexion
 *
 * @author iago
 */

session_start();
include '../view/MESSAGE_View.php';
$login=$_SESSION['loginUser'];
session_destroy();
new MESSAGE_View("Desconexion del usuario $login realizada con exito", "index.php");
?>