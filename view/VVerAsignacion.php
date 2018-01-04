<?php
/**
 * Description of VVerAsignacion
 *
 * @author iago
 */

class VVerAsignacion {
    function __construct($asig,$texto) {
        $this->render($asig,$texto);
    }
    
    function render($asig,$texto){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de asignaciones <small><?=$texto?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
               <table class="table">
                    <thead>
			<tr>
                            <th>Nombre tabla</th>
                            <th>Tipo tabla</th>
                            <th>Nombre usuario</th>
                            <th>DNI</th>
                            <th>Acciones</th>
			</tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$asig->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td>
                                <a href="../controller/CTabla.php?action=verDetalle&idTabla=<?=$tupla[0]?>"><?=$tupla[1]?></a>
                            </td>
                            <td><?= $tupla[2]?></td>
                            <td><?= $tupla[3]?></td>
                            <td><?= $tupla[4]?></td>
                            <td>
                                <a href=../controller/CTabla.php?action=desasignarUser&idTabla=<?= $tupla[0]?>&idUsuario=<?= $tupla[5]?> aria-label="Delete">
                                    <img src="../images/delete.png" width="2%" alt="delete"/>
                                </a>
                            </td>
                        </tr>
<?php 
                $tupla=$asig->fetch_row();
        }
        while(!is_null($tupla));
    }
?>
                    </tbody>
               </table>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CTabla.php?action=cargarVerAsignacion">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
<?php
	footer();
    }
}
?>
