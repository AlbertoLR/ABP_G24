<?php
/**
 * En esta funcion se comprobara el login
 *
 * @author iago
 */

function estaRegistrado(){
    if (isset($_SESSION['Id_usuario'])){
        return TRUE;
    }
    else {
        header("Location: ../controller/CLogin.php");
        return FALSE;
    }
}
