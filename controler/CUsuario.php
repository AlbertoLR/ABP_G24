<?php
/**
 * En este archivo se detallara el controlador de Usuario
 *
 * @author iago
 */

//incluidos todas las vistas y el modelo de Usuario
include '../model/MUsuario.php';
include '../model/MPerfilUsuario.php';
include '../view/VAltaUsuario.php';
include '../view/VBajaUsuario.php';
include '../view/VModificarUsuario.php';
include '../view/VConsultarUsuario.php';
include '../view/MESSAGE_View.php';

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_REQUEST['nombreUs'])){
                new VAltaUsuario();
            }
            else{
                $Nombre=$_REQUEST['nombreUs'];
                $DNI=$_REQUEST['DNIUs'];
                $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];

                $Usuario=new MUsuario("",$Nombre,$DNI,$Id_PerfilUsuario);
                $respuesta=$Usuario->insert();
                new MESSAGE_View($respuesta, "../index.php");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['Id_usuario'])){
                $selectAll=new MUsuario("","","","");
                $listaUsuarios=$selectAll->select();
                new VBajaUsuario($listaUsuarios);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $Id_usuario=$_REQUEST['Id_usuario'];
                $modelo=new MUsuario($Id_usuario,"","","");
                $UsuarioBorrar=$modelo->selectID();
                VBajaUsuario::solicitarConfirmacion($UsuarioBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar el Us
                    $Id_usuario=$_REQUEST['Id_usuario'];

                    $Usuario=new MUsuario($Id_usuario,"","","");
                    $respuesta=$Usuario->delete();
                    new MESSAGE_View($respuesta, "../index.php");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['DNIUs'])){
                new VConsultarUsuario(); //psa
            }
            else{
                $DNI=$_REQUEST['DNIUs'];

                $Usuario=new MUsuario("","",$DNI,"");
                $resultado=$Usuario->select();
                VConsultarUsuario::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['Id_usuario'])){
                $selectAll=new MUsuario("","","","");
                $listaUsuarios=$selectAll->select();
                new VModificarUsuario($listaUsuarios); //asi conseguimos la id del Usuario a modificar 
            }
            elseif (!isset($_REQUEST['nombreUs']) && !isset($_REQUEST['DNIUs']) && !isset($_REQUEST['Id_PerfilUsuario'])) {
                $Id_usuario=$_REQUEST['Id_usuario'];
                VModificarUsuario::mostrarFormulario($Id_usuario); //luego se envia a un formulario para editar
            }
            else{
                $Id_usuario=$_REQUEST['Id_usuario'];
                $Nombre=$_REQUEST['nombreUs'];
                $DNI=$_REQUEST['DNIUs'];
                $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];

                $Usuario=new MUsuario($Id_usuario,$Nombre,$DNI,$Id_PerfilUsuario);
                $respuesta=$Usuario->update();
                new MESSAGE_View($respuesta,"../index.php");
            }
            break;
    }
    
//    private function showAllUsuario(){
//        $Usuario=new MUsuario("","","");
//        return $Usuario->select();
//    }
//}
?>
