<?php
/**
 * En este archivo se detallara el controlador de ejercicio
 *
 * @author iago
 */

session_start();

//incluidos todas las vistas y el modelo de ejercicio
include '../model/MEjercicio.php';
include '../view/VAltaEjercicio.php';
include '../view/VBajaEjercicio.php';
include '../view/VModificarEjercicio.php';
include '../view/VConsultarEjercicio.php';
include '../view/VVerDetalleEjercicio.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

switch ($_REQUEST['action']){
    case 'alta':
        if(!isset($_REQUEST['nombreEj'])){
            new VAltaEjercicio();
        }
        else{
            $nombreEj=$_REQUEST['nombreEj'];
            $descripcionEj=$_REQUEST['descripcionEj'];
            $tipoEj=$_REQUEST['tipoEj'];

            $ejercicio=new MEjercicio("",$nombreEj,$descripcionEj,$tipoEj);
            $respuesta=$ejercicio->insert();
            new MESSAGE_View($respuesta, "../index.php");
        }
        break;
    
    case 'baja':
        if(!isset($_REQUEST['idEjercicio'])){
            $selectAll=new MEjercicio("","","","");
            $listaEjercicios=$selectAll->select();
            new VBajaEjercicio($listaEjercicios);
        }
        elseif(!isset($_REQUEST['confirmar'])) {
            $idEjercicio=$_REQUEST['idEjercicio'];
            $modelo=new MEjercicio($idEjercicio,"","","");
            $ejercicioBorrar=$modelo->selectID();
            VBajaEjercicio::solicitarConfirmacion($ejercicioBorrar);
        }
        else{
            if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar el ej
                $idEjercicio=$_REQUEST['idEjercicio'];

                $ejercicio=new MEjercicio($idEjercicio,"","","");
                $respuesta=$ejercicio->delete();
                new MESSAGE_View($respuesta, "../index.php");
            }
        }
            break;
    
    case 'consulta':
        if(!isset($_REQUEST['tipoEj'])){
            new VConsultarEjercicio();
        }
        else{
            $tipoEj=$_REQUEST['tipoEj'];

            $ejercicio=new MEjercicio("","","",$tipoEj);
            $resultado=$ejercicio->selectTipo();
            VConsultarEjercicio::mostrar($resultado);
        }
        break;
            
    case 'verDetalle':
        $idEjercicio=$_REQUEST['idEjercicio'];
        $modelo=new MEjercicio($idEjercicio,"","","");
        $ejercicio=$modelo->selectID();
        new VVerDetalleEjercicio($ejercicio);
        break;
    
    case 'modificacion':
        if(!isset($_REQUEST['idEjercicio'])){
            $selectAll=new MEjercicio("","","","");
            $listaEjercicios=$selectAll->select();
            new VModificarEjercicio($listaEjercicios); //asi conseguimos la id del ejercicio a modificar 
        }
        elseif (!isset($_REQUEST['nombreEj']) && !isset($_REQUEST['descripcionEj']) && !isset($_REQUEST['tipoEj'])) {
            $idEjercicio=$_REQUEST['idEjercicio'];
            VModificarEjercicio::mostrarFormulario($idEjercicio); //luego se envia a un formulario para editar
        }
        else{
            $idEjercicio=$_REQUEST['idEjercicio'];
            $nombreEj=$_REQUEST['nombreEj'];
            $descripcionEj=$_REQUEST['descripcionEj'];
            $tipoEj=$_REQUEST['tipoEj'];

            $ejercicio=new MEjercicio($idEjercicio,$nombreEj,$descripcionEj,$tipoEj);
            $respuesta=$ejercicio->update();
            new MESSAGE_View($respuesta,"../index.php");
        }
        break;
}
?>
