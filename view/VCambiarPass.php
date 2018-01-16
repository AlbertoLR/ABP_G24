<?php
/**
 * Description of VCambiarPass
 *
 * @author Iago
 */

class VCambiarPass {
    function __construct($idUser) {
        $this->render($idUser);
    }
    
    function render($idUser){
	menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nueva contraseña <small>Introduzca su nueva contraseña</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CUsuario.php" method="post">
                    <input type='hidden' name='idUser' value='<?=$idUser?>'/>
                    <div class="apartado">
                        <label for="password">Contraseña:</label>
                        <input type="text" name="password" size="45"/>
                    </div>
					
                    <div class="apartado">
                        <button type="submit" name="action" value="cambiarPass"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CUsuario.php?action=verPerfil">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
}
