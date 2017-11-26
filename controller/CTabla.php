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
include '../view/VAsignarUsuario.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

switch ($_REQUEST['action']){
    case 'alta':
        if(!isset($_REQUEST['nombreTabla']) || !isset($_REQUEST['tipoTabla'])){
            new VAltaTabla();
        }
        else{
            $nombreTabla=$_REQUEST['nombreTabla'];
            $tipoTabla=$_REQUEST['tipoTabla'];

            $tabla=new MTabla("",$nombreTabla,$tipoTabla);
            $respuesta=$tabla->insert();
            new MESSAGE_View($respuesta, "../index.php");
        }
        break;
    case 'asignarEj':
        if(!isset($_REQUEST['idTabla'])){
            $modelo=new MTabla("","","");
            $tablas=$modelo->selectAll();
            new VAsignarEjercicio($tablas);
        }
        elseif(!isset($_REQUEST['ejercicios'])){
            $idTabla=$_REQUEST['idTabla'];
            $tabla=new MTabla($idTabla,"","");
            $tupla=$tabla->selectID();
            $modeloEj=new MEjercicio("","","");
            $ejercicios=$modeloEj->select();
        
            VAsignarEjercicio::mostrarEjercicios($tupla,$ejercicios);
        }
        elseif(!isset($_REQUEST['cantidades'])){
            $idTabla=$_REQUEST['idTabla'];
            $ejercicios=$_REQUEST['ejercicios'];
            for($i=0;$i<count($ejercicios);$i++){
                $modeloEj=new MEjercicio($ejercicios[$i],"","");
                $tupla=$modeloEj->selectID();
                $nombreEj[$i]=$tupla[1];
            }
            VAsignarEjercicio::pedirCantidades($idTabla,$ejercicios,$nombreEj);
        }
        else{
            $idTabla=$_REQUEST['idTabla'];
            $ejercicios=$_REQUEST['ejercicios'];
            $cantidades=$_REQUEST['cantidades'];
            
            $tabla=new MTabla($idTabla,"","");
            $tabla->deleteAsignacionEj(); //borro los ej asignados previamente
            for($i=0;$i<count($ejercicios);$i++){
                $tabla->asignarEjercicio($ejercicios[$i],$cantidades[$i]);
            }
            new MESSAGE_View("Ejercicios asignados", "../index.php");
        }
        break;
    case 'baja':
        if(!isset($_REQUEST['idTabla'])){
            $selectAll=new MTabla("","","");
            $listaTablas=$selectAll->selectAll();
            new VBajaTabla($listaTablas);
        }
        elseif(!isset($_REQUEST['confirmar'])){
            $idTabla=$_REQUEST['idTabla'];
            $modelo=new MTabla($idTabla,"","");
            $tablaBorrar=$modelo->selectID();
            VBajaTabla::solicitarConfirmacion($tablaBorrar);
        }
        else{
            if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar la sesion
                $idTabla=$_REQUEST['idTabla'];

                $sesion=new MTabla($idTabla,"","");
                $respuesta=$sesion->delete();
                new MESSAGE_View($respuesta, "../index.php");
            }
        }
        break;
        
    case 'modificacion':
        if(!isset($_REQUEST['idTabla'])){
            $selectAll=new MTabla("","","");
            $listaTablas=$selectAll->selectAll();
            new VModificarTabla($listaTablas); //asi conseguimos la id 
        }
        elseif(!isset($_REQUEST['nombreTabla']) && !isset($_REQUEST['tipoTabla'])){
            $idTabla=$_REQUEST['idTabla'];
            VModificarTabla::mostrarFormulario($idTabla); //luego se envia a un formulario para editar
        }
        else{
            $idTabla=$_REQUEST['idTabla'];
            $nombreTabla=$_REQUEST['nombreTabla'];
            $tipoTabla=$_REQUEST['tipoTabla'];

            $tabla=new MTabla($idTabla,$nombreTabla,$tipoTabla);
            $respuesta=$tabla->update();
            new MESSAGE_View($respuesta,"../index.php");
        }
        break;
        
    case 'consulta':
        //hecho para usuario generico FALTA SESSION
        $modelo=new MTabla("","","");
        $tablas=$modelo->selectAll();
        new VConsultarTabla($tablas);
        break;
        
    case 'verDetalle':
        $idTabla=$_REQUEST['idTabla'];
        $modelo=new MTabla($idTabla,"","");
        $tabla=$modelo->selectID();
        $ejercicios=$modelo->ejsTabla();
        $usuarios=$modelo->usersTabla();
            
        new VVerDetalleTabla($tabla,$ejercicios,$usuarios);
        break;
        
    case 'asignarUser':
        if(!isset($_REQUEST['idTabla'])){
            $modelo=new MTabla("","","");
            $tablas=$modelo->selectAll();
            new VAsignarUsuario($tablas);
        }
        elseif(!isset($_REQUEST['opcion'])){
            $idTabla=$_REQUEST['idTabla'];
            $modelo=new MTabla($idTabla,"","");
            $tabla=$modelo->selectID();
            VAsignarUsuario::elegirOpcion($tabla);
        }
        elseif(!isset($_REQUEST['usuarios'])){
            $idTabla=$_REQUEST['idTabla'];
            $modelo=new MTabla($idTabla,"","");
            
            if($_REQUEST['opcion']=='asignar'){
                $usuarios=$modelo->usuarios();
                VAsignarUsuario::asignarUsuario($usuarios,$idTabla,"asignar");
            }
            if($_REQUEST['opcion']=='borrar'){
                $usuarios=$modelo->usersTabla();
                VAsignarUsuario::asignarUsuario($usuarios,$idTabla,"borrar");
            }
        }
        else{
            $idTabla=$_REQUEST['idTabla'];
            $usuarios=$_REQUEST['usuarios'];
            $modelo=new MTabla($idTabla,"","");
            
            if($_REQUEST['opcion']=='asignar'){
                for($i=0;$i<count($usuarios);$i++){
                    $modelo->asignarTabla($usuarios[$i]);
                }
            }
            if($_REQUEST['opcion']=='borrar'){
                for($i=0;$i<count($usuarios);$i++){
                    $modelo->quitarTabla($usuarios[$i]);
                }
            }
        }
        break;
}