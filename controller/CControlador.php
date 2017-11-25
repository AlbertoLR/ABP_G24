<?php
/**
 * En este archivo se detallara el controlador de controladores
 *
 * @author alberto
 */

session_start();

//incluidos todas las vistas y el modelo de controlador
include '../model/MControlador.php';
include '../view/VAltaControlador.php';
include '../view/VBajaControlador.php';
include '../view/VModificarControlador.php';
include '../view/VConsultarControlador.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_REQUEST['nombreCt'])){
                new VAltaControlador();
            }
            else{
                $nombreCt=$_REQUEST['nombreCt'];
                
                $controlador=new MControlador("",$nombreCt);
                $respuesta=$controlador->insert();
                new MESSAGE_View($respuesta, "../index.php");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['idControlador'])){
                $selectAll=new MControlador("","");
                $listaControladores=$selectAll->select();
                new VBajaControlador($listaControladores);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $idControlador=$_REQUEST['idControlador'];
                $modelo=new MControlador($idControlador,"");
                $controladorBorrar=$modelo->selectID();
                VBajaControlador::solicitarConfirmacion($controladorBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar el ct
                    $idControlador=$_REQUEST['idControlador'];

                    $controlador=new MControlador($idControlador,"");
                    $respuesta=$controlador->delete();
                    new MESSAGE_View($respuesta, "../index.php");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['nombreCt'])){
                new VConsultarControlador(); //psa
            }
            else{
                $nombreCt=$_REQUEST['nombreCt'];

                $controlador=new MControlador("",$nombreCt);
                $resultado=$controlador->select();
                VConsultarControlador::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['idControlador'])){
                $selectAll=new MControlador("","");
                $listaControladores=$selectAll->select();
                new VModificarControlador($listaControladores); //asi conseguimos la id del controlador a modificar 
            }
            elseif (!isset($_REQUEST['nombreCt'])) {
                $idControlador=$_REQUEST['idControlador'];
                VModificarControlador::mostrarFormulario($idControlador); //luego se envia a un formulario para editar
            }
            else{
                $idControlador=$_REQUEST['idControlador'];
                $nombreCt=$_REQUEST['nombreCt'];
                
                $controlador=new MControlador($idControlador,$nombreCt);
                $respuesta=$controlador->update();
                new MESSAGE_View($respuesta,"../index.php");
            }
            break;
    }
    
?>
