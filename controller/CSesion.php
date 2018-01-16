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
include '../view/VPrincipalSesion.php';
include '../view/VCargarAltaSesion.php';
include '../view/VCronoSesion.php';
include '../view/VShowAllSesion.php';
include '../view/VCargarVerSesion.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";
include "../core/fecha.php";

estaRegistrado();
$idUser=$_SESSION['Id_usuario'];

switch ($_REQUEST['action']){
    case 'crono':
        if(!isset($_GET['horaI']) || !isset($_GET['horas']) || !isset($_GET['minutos']) || !isset($_GET['segundos'])){
            $idTabla=$_REQUEST['idTabla'];
            
            $modelo=new MSesion("","",$idTabla,"","","","");
            $tabla=$modelo->detalleTabla();
            
            new VCronoSesion($tabla);
        }
        else{
            $idTabla=$_GET['idTabla'];
            $horas=$_GET['horas'];
            $minutos=$_GET['minutos'];
            $segundos=$_GET['segundos'];
            $horaI=$_GET['horaI'];
            
            $toret=fecha();
            $dia=$toret['dia'];
            $mes=$toret['mes'];
            $año=$toret['año'];
            
            $horaInicio=$año."-".$mes."-".$dia." ".$horaI;
            $duracion=$horas.":".$minutos.":".$segundos;
            
            header("location: ../controller/CSesion.php?action=alta&idTabla=$idTabla&horaInicio=$horaInicio&duracion=$duracion");
        }
        break;
        
    case 'alta':
        if(!isset($_POST['nombreSesion']) || !isset($_POST['comentario'])){
            $idTabla=$_GET['idTabla'];
            $horaInicio=$_GET['horaInicio'];
            $duracion=$_GET['duracion'];
            
            new VAltaSesion($idTabla,$horaInicio,$duracion);
        }
        else{
            $idTabla=$_POST['idTabla'];
            $horaInicio=$_POST['horaInicio'];
            $duracion=$_POST['duracion'];
            $comentario=$_POST['comentario'];
            $nombreSesion=$idTabla."--".$horaInicio; //nombre por defecto
            if($_POST['nombreSesion']<>"") $nombreSesion=$_POST['nombreSesion'];
            
            $modelo=new MSesion("",$_SESSION['Id_usuario'],$idTabla,$nombreSesion,$horaInicio,$duracion,$comentario);
            $respuesta=$modelo->insert();
            new MESSAGE_View($respuesta, "../controller/CSesion.php?action=principal");
        }
        break;
        
    case 'baja':
        if(!isset($_POST['confirmar'])){
            $idSesion=$_GET['idSesion'];
            
            $modelo=new MSesion($idSesion,"","","","","","");
            $sesionBorrar=$modelo->selectID();
            new VBajaSesion($sesionBorrar);
        }
        else{
            if($_POST['confirmar']=="si"){ //si el usuario confirma q quiere borrar la sesion
                $idSesion=$_POST['idSesion'];

                $sesion=new MSesion($idSesion,"","","","","","");
                $respuesta=$sesion->delete();
                new MESSAGE_View($respuesta, "../controller/CSesion.php?action=principal");
            }
            else{
                header("location: CSesion.php?action=principal");
            }
        }
        break;
        
    case 'modificacion':
        if(!isset($_POST['idTabla']) && !isset($_POST['nombreSesion']) && !isset($_POST['comentario'])){
            $idSesion=$_GET['idSesion'];
            
            $modelo=new MSesion("",$_SESSION['Id_usuario'],"","","","","");
            $tablas=$modelo->tablasUser();
            
            new VModificarSesion($idSesion,$tablas);
        }
        else{
            $idSesion=$_POST['idSesion'];
            $idTabla="";
            if(isset($_POST['idTabla'])) $idTabla=$_POST['idTabla'];
            $nombreSesion=$_POST['nombreSesion'];
            $comentario=$_POST['comentario'];
            
            $sesion=new MSesion($idSesion,"",$idTabla,$nombreSesion,"","",$comentario);
            $respuesta=$sesion->update();
            new MESSAGE_View($respuesta, "../controller/CSesion.php?action=principal");
        }
        break;
    
    case 'consulta':
        if($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4){
            if(!isset($_POST['idTabla']) || !isset($_POST['nombreSesion'])){
                $modelo=new MSesion("",$_SESSION['Id_usuario'],"","","","","");
                $tablas=$modelo->tablasUser();

                $vista=new VConsultarSesion();
                $vista->vistaUser($tablas);
            }
            else{
                $idTabla=$_POST['idTabla'];
                $nombreSesion=$_POST['nombreSesion'];

                $modelo=new MSesion("",$_SESSION['Id_usuario'],$idTabla,$nombreSesion,"","","");
                $sesiones=$modelo->selectUser();

                new VShowAllSesion($sesiones,"Resultado de busqueda");
            }
        }
        elseif($_SESSION['Id_PerfilUsuario']==2){
            if(!isset($_POST['nombreTabla']) || !isset($_POST['nombreSesion']) || !isset($_POST['DNI']) || !isset($_POST['horaInicio'])){
                $vista=new VConsultarSesion();
                $vista->vistaEntrenador();
            }
            else{
                $nombreTabla=$_POST['nombreTabla'];
                $nombreSesion=$_POST['nombreSesion'];
                $DNI=$_POST['DNI'];
                $horaInicio=$_POST['horaInicio'];
                
                $modelo=new MSesion("","","",$nombreSesion,$horaInicio,"","");
                $sesiones=$modelo->selectEntrenador($nombreTabla,$DNI,$_SESSION['Id_usuario']);
                
                new VShowAllSesion($sesiones,"Resultado de busqueda");
            }
        }
        break;
        
    case "verDetalle":
        $idSesion=$_GET['idSesion'];
        
        $modelo=new MSesion($idSesion,"","","","","","");
        $sesion=$modelo->selectID();
        
        $idTabla=$sesion[2];
        $modelo=new MTabla($idTabla,"","");
        $tabla=$modelo->selectID();
        
        new VVerDetalleSesion($sesion,$tabla);
        break;
        
    case 'principal':
        $vista=new VPrincipalSesion();
        if($_SESSION['Id_PerfilUsuario']==2) $vista->vistaEntrenador();
        elseif($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4) $vista->vistaUser();
        else header("location: ../index.php");
        break;
        
    case 'cargarAlta':
        $modelo=new MSesion("",$_SESSION['Id_usuario'],"","","","","");
        $tablas=$modelo->tablasUser();
        
        if($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4) new VCargarAltaSesion($tablas);
        else header("location: ../index.php");
        break;
        
    case 'verSesion':
        if($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4){
            $modelo=new MSesion("",$_SESSION['Id_usuario'],"","","","","");
            $sesiones=$modelo->selectUser();
            
            new VShowAllSesion($sesiones,"Sesiones de usuario");
        }
        elseif($_SESSION['Id_PerfilUsuario']==2){
            if($_GET['tipo']=='pef') $idPerfil=3;
            elseif($_GET['tipo']=='normales') $idPerfil=4;
            
            $modelo=new MSesion("","","","","","","");
            $sesiones=$modelo->selectTipo($idPerfil,$_SESSION['Id_usuario']);
            
            new VShowAllSesion($sesiones,"Sesiones de usuario");
        }
        else header("location: ../index.php");
        break;
        
    case 'cargarVerSesion':
        if($_SESSION['Id_PerfilUsuario']==2) new VCargarVerSesion();
        else header("location: ../index.php");
        break;
}
