<?php
/**
 * En este archivo se detallara el controlador de Actividad
 *
 * @author iago
 */

session_start();

//incluidos todas las vistas y el modelo de Actividad
include '../model/MActividad2.php';
include '../view/VAltaActividad2.php';
include '../view/VBajaActividad2.php';
include '../view/VModificarActividad2.php';
include '../view/VConsultarActividad2.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_REQUEST['nombreAc'])){
                new VAltaActividad2();
            }
            else{
                $Nombre=$_REQUEST['nombreAc'];
                $Sala=$_REQUEST['sala'];
                $Capacidad=$_REQUEST['Capacidad'];
                $HoraInicio=$_REQUEST['HoraInicio'];
                $HoraFin=$_REQUEST['HoraFin'];
                $Dia=$_REQUEST['Dia'];

                $Actividad=new MActividad2("",$Nombre,$Sala,$Capacidad,$HoraInicio,$HoraFin,$Dia);
                $respuesta=$Actividad->insert();
                new MESSAGE_View($respuesta, "../index.php");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['Id_Actividad'])){
                $selectAll=new MActividad2("","","","","","","");
                $listaActividad=$selectAll->select();
                new VBajaActividad2($listaActividad);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $Id_Actividad=$_REQUEST['Id_Actividad'];
                $modelo=new MActividad2($Id_Actividad,"","","","","","");
                $ActividadBorrar=$modelo->selectID();
                VBajaActividad2::solicitarConfirmacion($ActividadBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el Actividad confirma q quiere borrar el Us
                    $Id_Actividad=$_REQUEST['Id_Actividad'];

                    $Actividad=new MActividad2($Id_Actividad,"","","","","","");
                    $respuesta=$Actividad->delete();
                    new MESSAGE_View($respuesta, "../index.php");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['sala'])){
                new VConsultarActividad2(); 
            }
            else{
                $Sala=$_REQUEST['sala'];

                $Actividad=new MActividad2("","",$Sala,"","","","");
                $resultado=$Actividad->select();
                VConsultarActividad2::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['Id_Actividad'])){
                $selectAll=new MActividad2("","","","","","","");
                $listaActividad=$selectAll->select();
                new VModificarActividad2($listaActividad); //asi conseguimos la id del Actividad a modificar 
            }
            elseif (!isset($_REQUEST['Nombre']) && !isset($_REQUEST['Sala'])) {
                $Id_Actividad=$_REQUEST['Id_Actividad'];
                VModificarActividad2::mostrarFormulario($Id_Actividad); //luego se envia a un formulario para editar
            }
            else{
                $Id_Actividad=$_REQUEST['Id_Actividad'];
                $Nombre=$_REQUEST['Nombre'];
                $Sala=$_REQUEST['Sala'];
                $Capacidad=$_REQUEST['Capacidad'];
                $HoraInicio=$_REQUEST['HoraInicio'];
                $HoraFin=$_REQUEST['HoraFin'];
                $Dia=$_REQUEST['Dia'];
                $Actividad=new MActividad2($Id_Actividad,$Nombre,$Sala,$Capacidad,$HoraInicio,$HoraFin,$Dia);
                $respuesta=$Actividad->update();
                new MESSAGE_View($respuesta,"../index.php");
            }
            break;
    }
    
//    private function showAllActividad(){
//        $Actividad=new MActividad("","","");
//        return $Actividad->select();
//    }
//}
?>
