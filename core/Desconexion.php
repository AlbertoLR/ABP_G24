<?php
/**
 * En este archivo se cerrara la conexion
 *
 * @author iago
 */

session_start();
include '../view/MESSAGE_View.php';
$nombre=$_SESSION['Nombre'];
session_destroy();
new MESSAGE_View("Desconexion del usuario $nombre realizada con exito", "../index.php");
?>
