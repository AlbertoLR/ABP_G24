<?php
/**
 * Vista que muestra en detalle una sesion
 *
 * @author iago
 */
class VVerPerfilUser {
    function __construct($user) {
        $this->render($user);
    }
    
    function render($user){
        menus();
?>
        
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Perfil del usuario
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$user[1]?> <?=$user[2]?></td>
                    </tr>
                    <tr>
                        <td><b>DNI</b></td>
                        <td><?=$user[3]?></td>
                    </tr>
                    <tr>
                        <td><b>Telefono</b></td>
                        <td><?=$user[4]?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo usuario</b></td>
                        <td>
<?php
		if($user[5]==1){
?>
							Administrador
<?php
		}
		elseif($user[5]==2){
?>
							Entrenador
<?php
		}
		elseif($user[5]==3){
?>
							Deportista PEF
<?php
		}
		elseif($user[5]==4){
?>
							Deportista TDU
<?php
		}
?>
						</td>
                    </tr>
					<tr>
                        <td><b>Cambiar contraseña</b></td>
                        <td>
							<a href="../controller/CUsuario.php?action=cambiarPass&idUser=<?=$user[0]?>">
								<img class="imagenes" src="../images/edit.png" width="4%">
							</a>
						</td>
                    </tr>
                </table>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CUsuario.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
<?php
	footer();
    }
}
?>
