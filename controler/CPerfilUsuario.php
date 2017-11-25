<?php
/**
 * En este archivo se detallara el controlador de PerfilUsuario
 *
 * @author iago
 */

//incluidos todas las vistas y el modelo de PerfilUsuario
include '../model/MPerfilUsuario.php';
include '../view/VAltaPerfilUsuario.php';
include '../view/VBajaPerfilUsuario.php';
include '../view/VModificarPerfilUsuario.php';
include '../view/VConsultarPerfilUsuario.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_REQUEST['Tipo'])){
                new VAltaPerfilUsuario();
            }
            else{
                $Tipo=$_REQUEST['Tipo'];
                

                $PerfilUsuario=new MPerfilUsuario("",$Tipo);
                $respuesta=$PerfilUsuario->insert();
                new MESSAGE_View($respuesta, "../index.php");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['Id_PerfilUsuario'])){
                $selectAll=new MPerfilUsuario("","");
                $listaPerfilUsuarios=$selectAll->select();
                new VBajaPerfilUsuario($listaPerfilUsuarios);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];
                $modelo=new MPerfilUsuario($Id_PerfilUsuario,"");
                $UsuarioBorrar=$modelo->selectID();
                VBajaPerfilUsuario::solicitarConfirmacion($UsuarioBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el PerfilUsuario confirma q quiere borrar el Us
                    $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];
                    //$Tipo=$_REQUEST['Tipo'];

                    $PerfilUsuario=new MPerfilUsuario($Id_PerfilUsuario,"");
                    $respuesta=$PerfilUsuario->delete();
                    new MESSAGE_View($respuesta, "../index.php");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['Tipo'])){
                new VConsultarPerfilUsuario(); //psa
            }
            else{
                $Tipo=$_REQUEST['Tipo'];

                $PerfilUsuario=new MPerfilUsuario("",$Tipo);
                $resultado=$PerfilUsuario->select();
                VConsultarPerfilUsuario::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['Id_PerfilUsuario'])){
                $selectAll=new MPerfilUsuario("","");
                $listaPerfilUsuarios=$selectAll->select();
                new VModificarPerfilUsuario($listaPerfilUsuarios); //asi conseguimos la id del PerfilUsuario a modificar 
            }
            elseif (!isset($_REQUEST['Tipo'])) {
                $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];
                VModificarPerfilUsuario::mostrarFormulario($Id_PerfilUsuario); //luego se envia a un formulario para editar
            }
            else{
                $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];
                $Tipo=$_REQUEST['Tipo'];
             

                $PerfilUsuario=new MPerfilUsuario($Id_PerfilUsuario,$Tipo);
                $respuesta=$PerfilUsuario->update();
                new MESSAGE_View($respuesta,"../index.php");
            }
            break;
    }
    
//    private function showAllPerfilUsuario(){
//        $PerfilUsuario=new MPerfilUsuario("","","");
//        return $PerfilUsuario->select();
//    }
//}
?>
