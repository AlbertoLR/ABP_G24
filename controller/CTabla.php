<?php
/**
 * En este archivo se detallara el controlador de tabla
 *
 * @author iago
 */

session_start();

//incluidos todas las vistas y el modelo de tabla
include '../model/MTabla.php';
include '../model/MEjercicio.php';
include '../view/VAltaTabla.php';
include '../view/VBajaTabla.php';
include '../view/VModificarTabla.php';
include '../view/VConsultarTabla.php';
include '../view/VVerDetalleTabla.php';
include '../view/VAsignarEjercicio.php';
include '../view/VPedirCantidadesEj.php';
include '../view/VPrincipalTabla.php';
include '../view/VAsigOCrearTabla.php';
include '../view/VAsignarUsuario.php';
include '../view/VDesasignarUser.php';
include '../view/VCargarAlta.php';
include '../view/VCargarAltaPEF.php';
include '../view/VVerTabla.php';
include '../view/VShowAllTabla.php';
include '../view/VCargarVerAsignacion.php';
include '../view/VVerAsignacion.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

switch ($_REQUEST['action']){
    case 'alta':
        if(!isset($_REQUEST['nombreTabla']) || !isset($_REQUEST['tipoTabla'])){
            if(isset($_POST['Id_usuario'])) $idUser=$_POST['Id_usuario'];
            else $idUser=NULL;
            new VAltaTabla($idUser);
        }
        else{
            $nombreTabla=$_POST['nombreTabla'];
            $tipoTabla=$_POST['tipoTabla'];

            $modelo=new MTabla("",$nombreTabla,$tipoTabla);
            $respuesta=$modelo->insert();
            
            if(isset($_POST['Id_usuario']) && $respuesta="Inserción realizada con éxito"){
                $idUser=$_POST['Id_usuario'];
                $tabla=$modelo->selectNombre();
                $idTabla=$tabla[0];
                $modelo=new MTabla($idTabla,$nombreTabla,"");
                $modelo->asignarTabla($idUser);
            }
            
            if($respuesta=="Inserción realizada con éxito"){
                $tupla=$modelo->selectNombre();
                $idTabla=$tupla[0];
                header("location: ../controller/CTabla.php?action=asignarEj&idTabla=$idTabla");
            }
            else new MESSAGE_View($respuesta,"../index.php");
        }
        break;
        
    case 'asignarEj':
        if(!isset($_POST['ejercicios'])){
            $idTabla=$_GET['idTabla'];
            
            $modeloEj=new MEjercicio("","","","");
            $ejercicios=$modeloEj->select();
        
            new VAsignarEjercicio($idTabla,$ejercicios);
        }
        elseif(!isset($_POST['tiempo']) && !isset($_POST['repeticion']) && !isset($_POST['serie'])){
            $idTabla=$_POST['idTabla'];
            $toret=$_POST['ejercicios'];
            for($i=0;$i<count($toret);$i++){
                $modeloEj=new MEjercicio($toret[$i],"","","");
                $tupla=$modeloEj->selectID();
                $ejercicios[$i]['id']=$tupla[0];
                $ejercicios[$i]['name']=$tupla[1];
            }
            new VPedirCantidadesEj($idTabla,$ejercicios);
        }
        else{
            $idTabla=$_POST['idTabla'];
            $ejercicios=$_POST['ejercicios'];
            $tiempos=$_POST['tiempo'];
            $repeticiones=$_POST['repeticion'];
            $series=$_POST['serie'];
            
            $tabla=new MTabla($idTabla,"","");
            $tabla->deleteAsignacionEj(); //borro los ej asignados previamente
            for($i=0;$i<count($ejercicios);$i++){
                $tabla->asignarEjercicio($ejercicios[$i],$tiempos[$i],$repeticiones[$i],$series[$i]);
            }
            
            new MESSAGE_View("Inserción realizada con éxito","../controller/CTabla.php?action=principal");
        }
        break;
    case 'baja':
        if(!isset($_POST['confirmar'])){
            $idTabla=$_GET['idTabla'];
            
            $modelo=new MTabla($idTabla,"","");
            $tablaBorrar=$modelo->selectID();
            $ejercicios=$modelo->ejsTabla();
            
            if($_SESSION['Id_PerfilUsuario']==2) new VBajaTabla($tablaBorrar,$ejercicios);
        }
        else{
            if($_POST['confirmar']=="si"){ //si el usuario confirma q quiere borrar la sesion
                $idTabla=$_POST['idTabla'];

                $modelo=new MTabla($idTabla,"","");
                $modelo->deleteAsignacionEj();
                $modelo->deleteAsignacionTabla();
                $respuesta=$modelo->delete();
                
                new MESSAGE_View($respuesta,"../controller/CTabla.php?action=principal");
            }
            else{
                header("location: CTabla.php?action=principal");
            }
        }
        break;
        
    case 'modificacion':
        if(!isset($_POST['nombreTabla'])){
            $idTabla=$_GET['idTabla'];
            new VModificarTabla($idTabla);
        }
        else{
            $idTabla=$_POST['idTabla'];
            $nombreTabla=$_POST['nombreTabla'];
            $asignarEj=$_POST['asignarEj'];

            $tabla=new MTabla($idTabla,$nombreTabla,"");
            $respuesta=$tabla->update();
            
            if($asignarEj=="si"){
                header("location: CTabla.php?action=asignarEj&idTabla=$idTabla");
            }
            else new MESSAGE_View($respuesta,"../controller/CTabla.php?action=principal");
        }
        break;
        
    case 'consulta':
        if(!isset($_POST['nombreTabla']) && !isset($_POST['tipoTabla'])){
            new VConsultarTabla();
        }
        else{
            $nombreTabla=$_POST['nombreTabla'];
            $tipoTabla=$_POST['tipoTabla'];
            
            $modelo=new MTabla("",$nombreTabla,$tipoTabla);
            $resultado=$modelo->select($_SESSION['Id_usuario']);
            
            new VShowAllTabla($resultado,"Resultado de busqueda");
        }
        break;
        
    case 'verDetalle':
        $idTabla=$_GET['idTabla'];
        $modelo=new MTabla($idTabla,"","");
        $tabla=$modelo->selectID();
        $ejercicios=$modelo->ejsTabla();
            
        new VVerDetalleTabla($tabla,$ejercicios);
        break;
        
    case 'asignarUser':
        if(!isset($_POST['usuarios']) || !isset($_POST['idTabla'])){
            $modelo=new MTabla("","","Predeterminada");
            $tablas=$modelo->select("");
            
            $usuariosPropios=$modelo->usuariosPropios($_SESSION['Id_usuario']);
            $usuariosNormales=$modelo->usuariosNormales();
            
            new VAsignarUsuario($tablas,$usuariosPropios,$usuariosNormales);
        }
        else{
            $idTabla=$_POST['idTabla'];
            $usuarios=$_POST['usuarios'];
            
            $modelo=new MTabla($idTabla,"","");
            for($i=0;$i<count($usuarios);$i++){
                $modelo->asignarTabla($usuarios[$i]);
            }
            
            new MESSAGE_View("Tabla asiganada a usuarios","../controller/CTabla.php?action=principal");
        }
        break;
        
    case 'principal':
        $vista=new VPrincipalTabla();
        if($_SESSION['Id_PerfilUsuario']==2) $vista->vistaEntrenador();
        elseif($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4){
            $modelo=new MTabla("","","");
            $tablas=$modelo->selectUser($_SESSION['Id_usuario']);
            $user=$_SESSION['Nombre'];
            new VShowAllTabla($tablas,"Usuario: $user");
        }
        else header("location: ../index.php");
        break;
        
    case 'asignarOAlta':
        if($_SESSION['Id_PerfilUsuario']==2) new VAsigOCrearTabla();
        else header("location: ../index.php");
        break;
        
    case 'cargarAlta':
        if($_SESSION['Id_PerfilUsuario']==2) new VCargarAlta();
        else header("location: ../index.php");
        break;
        
    case 'altaPersonalizada':
        $modelo=new MTabla("","","");
        $usersPEF=$modelo->usuariosPropios($_SESSION['Id_usuario']);
        
        if($_SESSION['Id_PerfilUsuario']==2) new VCargarAltaPEF($usersPEF);
        else header("location: ../index.php");
        break;
        
    case 'verTabla':
        if($_SESSION['Id_PerfilUsuario']==2) new VVerTabla();
        else header("location: ../index.php");
        break;
        
    case 'showAll':
        $tipoTabla=$_GET['tipoTabla'];
        
        $modelo=new MTabla("","",$tipoTabla);
        $resultado=$modelo->select($_SESSION['Id_usuario']);
        
        new VShowAllTabla($resultado,$tipoTabla);
        break;
    
    case 'cargarVerAsignacion':
        if($_SESSION['Id_PerfilUsuario']==2) new VCargarVerAsignacion();
        else header("location: ../index.php");
        break;
        
    case 'verAsignacion':
        $tipo=$_GET['tipo'];
        
        $modelo=new MTabla("","","");
        if($tipo=="normales"){
            $asig=$modelo->selectAsignacionesNorm();
            $texto="Usuarios normales";
        }
        elseif($tipo=="pef"){
            $asig=$modelo->selectAsignacionesPEF($_SESSION['Id_usuario']);
            $texto="Tus usuarios PEF";
        }
        
        if($_SESSION['Id_PerfilUsuario']==2) new VVerAsignacion($asig,$texto);
        else header("location: ../index.php");
        break;
        
    case 'desasignarUser':
        if(!isset($_POST['confirmar'])){
            $idTabla=$_GET['idTabla'];
            $idUsuario=$_GET['idUsuario'];

            if($_SESSION['Id_PerfilUsuario']==2) new VDesasignarUser($idTabla,$idUsuario);
        }
        else{
            if($_POST['confirmar']=="si"){
                $idTabla=$_POST['idTabla'];
                $idUsuario=$_POST['idUsuario'];

                $modelo=new MTabla($idTabla,"","");
                $tabla=$modelo->selectID();
                
                $respuesta=$modelo->quitarTabla($idUsuario);
                if($tabla[2]=='Personalizada') $modelo->delete();
                
                new MESSAGE_View($respuesta,"../controller/CTabla.php?action=principal");
            }
            else{
                header("location: CTabla.php?action=principal");
            }
        }
        break;
}