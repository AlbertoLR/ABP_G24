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
                    <h2 class="panel-title">Ejercicios de la tabla</h2>
                </div>
                
                <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Tiempo</th>
                            <th>Repeticiones</th>
                            <th>Series</th>
			</tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$ejercicios->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td>
                                <a href="../controller/CEjercicio.php?action=verDetalle&idEjercicio=<?=$tupla[0]?>"><?=$tupla[1]?></a>
                            </td>
                            <td><?= $tupla[2]?></td>
                            <td><?= $tupla[3]?></td>
                            <td><?= $tupla[4]?></td>
                            <td><?= $tupla[5]?></td>
                        </tr>
<?php 
                $tupla=$ejercicios->fetch_row();
        }
        while(!is_null($tupla));
    }
?>
                    </tbody>
               </table>
<?php
        if($_SESSION['Id_PerfilUsuario']==2){
?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CTabla.php?action=principal">
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
