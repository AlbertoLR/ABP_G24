<?php
session_start();
/**
 * En este archivo se detallara el controlador de sesion
 *
 * @author iago
 */

//incluidos todas las vistas y el modelo de sesion
include '../model/MSesion.php';
include '../model/MTabla.php';
include '../view/VAltaSesion.php';
include '../view/VBajaSesion.php';
include '../view/VModificarSesion.php';
include '../view/VConsultarSesion.php';
include '../view/VVerDetalleSesion.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();
$idUser=$_SESSION['Id_usuario'];

switch ($_REQUEST['action']){
    case 'alta':
        if(!isset($_REQUEST['idTabla']) || !isset($_REQUEST['nombreSesion'])){
            $user=new MSesion("",$idUser,"","","","","");
            $tablasUser=$user->tablasUser();
            new VAltaSesion($tablasUser);
        }
        else{
            $idTabla=$_REQUEST['idTabla'];
            $nombreSesion=$_REQUEST['nombreSesion'];
            
            $fecha=$_REQUEST['fecha'];
            $horaI=$_REQUEST['horaInicio'];
            $horaF=$_REQUEST['horaFin'];
            
            $horaInicio=$fecha." ".$horaI;
            $horaFin=$fecha." ".$horaF;
            
            $comentario=$_REQUEST['comentario'];
            
            $sesion=new MSesion("",$idUser,$idTabla,$nombreSesion,$horaInicio,$horaFin,$comentario);
            $respuesta=$sesion->insert();
            new MESSAGE_View($respuesta, "../index.php");
        }
        break;
        
    case 'baja':
        if(!isset($_REQUEST['idSesion'])){
            $selectAll=new MSesion("","","","","","","");
            $listaSesiones=$selectAll->selectAll();
            new VBajaSesion($listaSesiones);
        }
        elseif(!isset($_REQUEST['confirmar'])){
            $idSesion=$_REQUEST['idSesion'];
            $modelo=new MSesion($idSesion,"","","","","","");
            $sesionBorrar=$modelo->selectID();
            VBajaSesion::solicitarConfirmacion($sesionBorrar);
        }
        else{
            if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar la sesion
                $idSesion=$_REQUEST['idSesion'];

                $sesion=new MSesion($idSesion,"","","","","","");
                $respuesta=$sesion->delete();
                new MESSAGE_View($respuesta, "../index.php");
            }
        }
        break;
        
    case 'modificacion':
        if(!isset($_REQUEST['idSesion'])){
            $selectAll=new MSesion("","","","","","","");
            $listaSesiones=$selectAll->selectAll();
            new VModificarSesion($listaSesiones); //asi conseguimos la id 
        }
        elseif(!isset($_REQUEST['idTabla']) && !isset($_REQUEST['nombreSesion']) && !isset($_REQUEST['fecha']) && !isset($_REQUEST['horaInicio']) && !isset($_REQUEST['horaFin']) && !isset($_REQUEST['comentario'])){
            $idSesion=$_REQUEST['idSesion'];
            $user=new MSesion("",$idUser,"","","","","");
            $tablasUser=$user->tablasUser();
            VModificarSesion::mostrarFormulario($idSesion,$tablasUser); //luego se envia a un formulario para editar
        }
        else{
            $idSesion=$_REQUEST['idSesion'];
            $idTabla=$_REQUEST['idTabla'];
            $nombreSesion=$_REQUEST['nombreSesion'];
            
            $fecha=$_REQUEST['fecha'];
            $horaI=$_REQUEST['horaInicio'];
            $horaF=$_REQUEST['horaFin'];
            
            $horaInicio=$fecha." ".$horaI;
            $horaFin=$fecha." ".$horaF;
            
            $comentario=$_REQUEST['comentario'];
            
            $sesion=new MSesion($idSesion,"",$idTabla,$nombreSesion,$horaInicio,$horaFin,$comentario);
            $respuesta=$sesion->update();
            new MESSAGE_View($respuesta, "../index.php");
        }
        break;
    
    case 'consulta':
        if(!isset($_REQUEST['idTabla'])){
            $user=new MSesion("",$idUser,"","","","","");
            $tablasUser=$user->tablasUser();
            new VConsultarSesion($tablasUser);
        }
        else{
            $idTabla=$_REQUEST['idTabla'];
            $modelo=new MSesion("",$idUser,$idTabla,"","","","");
            $sesiones=$modelo->select();
            VConsultarSesion::mostrar($sesiones);
        }
        break;
        
    case "verDetalle":
        $idSesion=$_REQUEST['idSesion'];
        $modelo=new MSesion($idSesion,"","","","","","");
        $sesion=$modelo->selectID();
        $idTabla=$sesion[2];
        $modeloTabla=new MTabla($idTabla,"","");
        $tabla=$modeloTabla->selectID();
        $nombreTabla=$tabla[1];
        new VVerDetalleSesion($sesion,$nombreTabla);
}