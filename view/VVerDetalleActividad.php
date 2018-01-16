<?php
/**
 * Vista que muestra en detalle un Actividad
 *
 * @author iago
 */
class VVerDetalleActividad {
    function __construct($Actividad) {
        $this->render($Actividad);
    }
    
    function render($Actividad){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Detalle Actividad
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$Actividad[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Capacidad</b></td>
                        <td><?=$Actividad[3]?></td>
                    </tr>
                    <tr>
                        <td><b>Hora Inicio</b></td>
                        <td><?=$Actividad[4]?></td>
                    </tr>
                    <tr>
                        <td><b>Hora Fin</b></td>
                        <td><?=$Actividad[5]?></td>
                    </tr>
                    <tr>
                        <td><b>Dia</b></td>
                        <td><?=$Actividad[6]?></td>
                    </tr>
                </table>
<?php
        
?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CActividad2.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
<?php
        
	footer();
    }
}
?>
