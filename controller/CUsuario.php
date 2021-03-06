<?php
/**
 * En este archivo se detallara el controlador de Usuario
 *
 * @author iago
 */

session_start();

//incluidos todas las vistas y el modelo de Usuario
include '../model/MUsuario.php';
include '../model/MPerfilUsuario.php';
include '../view/VAltaUsuario.php';
include '../view/VBajaUsuario.php';
include '../view/VModificarUsuario.php';
include '../view/VConsultarUsuario.php';
include '../view/VPrincipalUsuario.php';
include '../view/VVerPerfilUser.php';
include '../view/VCambiarPass.php';
include '../view/VAsignarEntrenador.php';
include '../view/MESSAGE_View.php';
include "../core/Login.php";

estaRegistrado();

    Switch ($_REQUEST['action']){
        case 'alta':
            if(!isset($_POST['nombreUs'])){
                new VAltaUsuario();
            }
            else{
                $Nombre=$_POST['nombreUs'];
                $Apellido=$_POST['Apellido'];
                $DNI=$_POST['DNIUs'];
                $Telefono=$_POST['Telefono'];
                $Id_PerfilUsuario=$_POST['Id_PerfilUsuario'];

                $Usuario=new MUsuario("",$Nombre,$Apellido,$DNI,$Telefono,$Id_PerfilUsuario,"cambiame");
                $respuesta=$Usuario->insert();
                
                if($Id_PerfilUsuario=3){
                    $modelo=new MUsuario("","","",$DNI,"","","");
                    $user=$modelo->selectDNI();
                    $idUser=$user[0];
                    
                    header("location: CUsuario.php?action=asignarEntrenador&idUser=$idUser");
                }
                
                new MESSAGE_View($respuesta, "../controller/CUsuario.php?action=principal");
            }
            break;
    
        case 'baja':
            if(!isset($_REQUEST['Id_usuario'])){
                $selectAll=new MUsuario("","","","","","","");
                $listaUsuarios=$selectAll->select();
                new VBajaUsuario($listaUsuarios);
            }
            elseif(!isset($_REQUEST['confirmar'])) {
                $Id_usuario=$_REQUEST['Id_usuario'];
                $modelo=new MUsuario($Id_usuario,"","","","","","");
                $UsuarioBorrar=$modelo->selectID();
                VBajaUsuario::solicitarConfirmacion($UsuarioBorrar);
            }
            else{
                if($_REQUEST['confirmar']=="si"){ //si el usuario confirma q quiere borrar el Us
                    $Id_usuario=$_REQUEST['Id_usuario'];

                    $Usuario=new MUsuario($Id_usuario,"","","","","","");
                    $respuesta=$Usuario->delete();
                    new MESSAGE_View($respuesta, "../controller/CUsuario.php?action=principal");
                }
            }
            break;
    
        case 'consulta':
            if(!isset($_REQUEST['DNIUs'])){
                new VConsultarUsuario(); //psa
            }
            else{
                $DNI=$_REQUEST['DNIUs'];

                $Usuario=new MUsuario("","","",$DNI,"","","");
                $resultado=$Usuario->select();
                VConsultarUsuario::mostrar($resultado);
            }
            break;
    
        case 'modificacion':
            if(!isset($_REQUEST['Id_usuario'])){
                $selectAll=new MUsuario("","","","","","","");
                $listaUsuarios=$selectAll->select();
                new VModificarUsuario($listaUsuarios); //asi conseguimos la id del Usuario a modificar 
            }
            elseif (!isset($_REQUEST['nombreUs']) && !isset($_REQUEST['Apellido']) && !isset($_REQUEST['DNIUs']) && !isset($_REQUEST['Telefono']) &&!isset($_REQUEST['Id_PerfilUsuario'])) {
                $Id_usuario=$_REQUEST['Id_usuario'];
                VModificarUsuario::mostrarFormulario($Id_usuario); //luego se envia a un formulario para editar
            }
            else{
                $Nombre=$_REQUEST['nombreUs'];
                $Apellido=$_REQUEST['Apellido'];
                $DNI=$_REQUEST['DNIUs'];
                $Telefono=$_REQUEST['Telefono'];
                $Id_PerfilUsuario=$_REQUEST['Id_PerfilUsuario'];

                $Usuario=new MUsuario($Id_usuario,$Nombre,$Apellido,$DNI,$Telefono,$Id_PerfilUsuario);
                $respuesta=$Usuario->update();
                new MESSAGE_View($respuesta,"../controller/CUsuario.php?action=principal");
            }
            break;
            
        case 'principal':
            $vista=new VPrincipalUsuario();
            if($_SESSION['Id_PerfilUsuario']==1) $vista->vistaAdministrador();
            else header("location: ../index.php");
            break;
			
		case 'verPerfil':
            $modelo=new MUsuario($_SESSION['Id_usuario'],"","","","","","");
			$user=$modelo->selectID();
			
            new VVerPerfilUser($user);
            break;
        
        case 'verPerfil': 
            $modelo=new MUsuario($_SESSION['Id_usuario'],"","","","","",""); 
            $user=$modelo->selectID(); 
       
            new VVerPerfilUser($user); 
            break;
        
        case 'cambiarPass':
            if(!isset($_REQUEST['password'])){
                $idUser=$_GET['idUser'];

                new VCambiarPass($idUser);
            }
            else{
                $Id_usuario=$_POST['idUser'];
                $password=$_POST['password'];
                
                $modelo=new MUsuario($Id_usuario,"","","","","",$password);
                $respuesta=$modelo->cambiarPass();
                
                new MESSAGE_View($respuesta,"../controller/CUsuario.php?action=verPerfil");
            }
            break;
            
        case 'asignarEntrenador':
            if(!isset($_POST['idEntrenador'])){
                $idUser=$_GET['idUser'];

                $modelo=new MUsuario($idUser,"","","","","",""); 
                $user=$modelo->selectID(); 

                if($user[5]==3){
                    $entrenadores=$modelo->entrenadores();

                    new VAsignarEntrenador($idUser,$entrenadores);
                }
                else new MESSAGE_View("No es un deportista PEF","../index.php");
            }
            else{
                $Id_usuario=$_POST['idUser'];
                $idEntrenador=$_POST['idEntrenador'];
                
                $modelo=new MUsuario($Id_usuario,"","","","","","");
                $respuesta=$modelo->asignarEntrenador($idEntrenador);
                
                new MESSAGE_View($respuesta,"../controller/CUsuario.php?action=principal");
            }
            break;
    }
?>
