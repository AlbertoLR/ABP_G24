<?php
/**
 * En este archivo se detallara el controlador de acciones
 *
 * @author alberto
 */

//incluidos todas las vistas y el modelo de accion
include '../model/MAccion.php';
include '../view/VAltaAccion.php';
include '../view/VBajaAccion.php';
include '../view/VModificarAccion.php';
include '../view/VConsultarAccion.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_REQUEST['nombreAc'])){
                new VAltaAccion();
            }
            else{
                $nombreAc=$_REQUEST['nombreAc'];
                
                $accion=new MAccion("",$nombreAc);
                $respuesta=$accion->insert();
                new MESSAGE_View($respuesta, "../index.php");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['idAccion'])){
                $selectAll=new MAccion("","");
                $listaAcciones=$selectAll->select();
                new VBajaAccion($listaAcciones);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $idAccion=$_REQUEST['idAccion'];
                $modelo=new MAccion($idAccion,"");
                $accionBorrar=$modelo->selectID();
                VBajaAccion::solicitarConfirmacion($accionBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar la acción
                    $idAccion=$_REQUEST['idAccion'];

                    $accion=new MAccion($idAccion,"");
                    $respuesta=$accion->delete();
                    new MESSAGE_View($respuesta, "../index.php");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['nombreAc'])){
                new VConsultarAccion(); //psa
            }
            else{
                $nombreAc=$_REQUEST['nombreAc'];

                $accion=new MAccion("",$nombreAc);
                $resultado=$accion->select();
                VConsultarAccion::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['idAccion'])){
                $selectAll=new MAccion("","");
                $listaAcciones=$selectAll->select();
                new VModificarAccion($listaAcciones); //asi conseguimos la id de la acción a modificar 
            }
            elseif (!isset($_REQUEST['nombreAc'])) {
                $idAccion=$_REQUEST['idAccion'];
                VModificarAccion::mostrarFormulario($idAccion); //luego se envia a un formulario para editar
            }
            else{
                $idAccion=$_REQUEST['idAccion'];
                $nombreAc=$_REQUEST['nombreAc'];
                
                $accion=new MAccion($idAccion,$nombreAc);
                $respuesta=$accion->update();
                new MESSAGE_View($respuesta,"../index.php");
            }
            break;
    }
?>
