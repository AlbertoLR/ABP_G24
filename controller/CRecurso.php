<?php
/**
 * En este archivo se detallara el controlador de Recurso
 *
 * @author Samu
 */

session_start();

//incluidos todas las vistas y el modelo de Recurso
include '../model/MRecurso.php';
//include '../model/MActividad2.php';
include '../view/VAltaRecurso.php';
include '../view/VBajaRecurso.php';
include '../view/VModificarRecurso.php';
include '../view/VConsultarRecurso.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_REQUEST['Nombre'])){
                new VAltaRecurso();
            }
            else{
                $Nombre=$_REQUEST['Nombre'];
                $Capacidad=$_REQUEST['Capacidad'];
                

                $Recurso=new MRecurso("",$Nombre,$Capacidad);
                $respuesta=$Recurso->insert();
                new MESSAGE_View($respuesta, "../index.php");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['Id_Recurso'])){
                $selectAll=new MRecurso("","","");
                $listaRecursos=$selectAll->select();
                new VBajaRecurso($listaRecursos);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $Id_Recurso=$_REQUEST['Id_Recurso'];
                $modelo=new MRecurso($Id_Recurso,"","");
                $RecursoBorrar=$modelo->selectID();
                VBajaRecurso::solicitarConfirmacion($RecursoBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el Recurso confirma q quiere borrar el Us
                    $Id_Recurso=$_REQUEST['Id_Recurso'];

                    $Recurso=new MRecurso($Id_Recurso,"","");
                    $respuesta=$Recurso->delete();
                    new MESSAGE_View($respuesta, "../index.php");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['Nombre'])){
                new VConsultarRecurso(); //psa
            }
            else{
                $Nombre=$_REQUEST['Nombre'];

                $Recurso=new MRecurso("",$Nombre,"");
                $resultado=$Recurso->select();
                VConsultarRecurso::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['Id_Recurso'])){
                $selectAll=new MRecurso("","","");
                $listaRecursos=$selectAll->select();
                new VModificarRecurso($listaRecursos); //asi conseguimos la id del Recurso a modificar 
            }
            elseif (!isset($_REQUEST['Nombre']) && !isset($_REQUEST['Capacidad'])) {
                $Id_Recurso=$_REQUEST['Id_Recurso'];
                VModificarRecurso::mostrarFormulario($Id_Recurso); //luego se envia a un formulario para editar
            }
            else{
                $Id_Recurso=$_REQUEST['Id_Recurso'];
                $Nombre=$_REQUEST['Nombre'];
                $Capacidad=$_REQUEST['Capacidad'];
               

                $Recurso=new MRecurso($Id_Recurso,$Nombre,$Capacidad);
                $respuesta=$Recurso->update();
                new MESSAGE_View($respuesta,"../index.php");
            }
            break;
    }
    
?>
