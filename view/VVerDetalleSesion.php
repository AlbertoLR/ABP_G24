<?php
/**
 * Vista que muestra en detalle una sesion
 *
 * @author iago
 */
class VVerDetalleSesion {
    function __construct($sesion,$tabla) {
        $this->render($sesion,$tabla);
    }
    
    function render($sesion,$tabla){
        menus();
?>
        <style type="text/css">
            h2 {color:white;}
        </style>
        
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Ver detalle sesion
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$sesion[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha</b></td>
                        <td><?=$sesion[4]?></td>
                    </tr>
                    <tr>
                        <td><b>Duracion</b></td>
                        <td><?=$sesion[5]?></td>
                    </tr>
                    <tr>
                        <td><b>Comentario</b></td>
                        <td><?=$sesion[6]?></td>
                    </tr>
                </table>
                
                <div class="col-lg-12">
                    <h2>Tabla de la sesion</h2>
                </div>
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$tabla[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo</b></td>
                        <td><?=$tabla[2]?></td>
                    </tr>
                    <tr>
                        <td>Ver en detalle:</td>
                        <td><a href="../controller/CTabla.php?action=verDetalle&idTabla=<?=$tabla[0]?>" target="_blank">
                                <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                        </a></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CSesion.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
<?php
	footer();
    }
}
?>
