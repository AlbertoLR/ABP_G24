<?php
/**
 * Vista que muestra un formulario para buscar una tabla para mostrarla en detalle
 *
 * @author iago
 */
class VVerDetalleTabla {
    function __construct($tabla,$ejercicios) {
        $this->render($tabla,$ejercicios);
    }
    
    function render($tabla,$ejercicios){
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
                            Ver detalle tabla
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$tabla[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo</b></td>
                        <td><?=$tabla[2]?></td>
                    </tr>
                </table>
                
                <div class="col-lg-12">
                    <h2>Ejercicios de la tabla</h2>
                </div>
                
                <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Tiempo</th>
                            <th>Repeticiones</th>
                            <th>Series</th>
                            <th>Acciones</th>
			</tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$ejercicios->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td><?=$tupla[1]?></td>
                            <td><?= $tupla[2]?></td>
                            <td><?= $tupla[3]?></td>
                            <td><?= $tupla[4]?></td>
                            <td><?= $tupla[5]?></td>
                            <td>
                                <a href="../controller/CEjercicio.php?action=verDetalle&idEjercicio=<?=$tupla[0]?>" target="_blank">
                                    <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                                </a>
                            </td>
                        </tr>
<?php 
                $tupla=$ejercicios->fetch_row();
            }while(!is_null($tupla));
        }
?>
                    </tbody>
               </table>

                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CTabla.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
<?php
	footer();
    }
}
?>
