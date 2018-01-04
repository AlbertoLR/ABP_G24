<?php
/**
 * Vista que muestra en detalle un ejercicio
 *
 * @author iago
 */
class VVerDetalleEjercicio {
    function __construct($ejercicio) {
        $this->render($ejercicio);
    }
    
    function render($ejercicio){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Detalle ejercicio
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$ejercicio[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo</b></td>
                        <td><?=$ejercicio[3]?></td>
                    </tr>
                    <tr>
                        <td><b>Descripcion</b></td>
                        <td><?=$ejercicio[2]?></td>
                    </tr>
                </table>
<?php
        if($_SESSION['Id_PerfilUsuario']==2){
?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CEjercicio.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
<?php
        }
	footer();
    }
}
?>