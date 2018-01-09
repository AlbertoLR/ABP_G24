<?php
/**
 * Description of VShowAllEjercicio
 *
 * @author iago
 */

class VShowAllEjercicio {
    function __construct($ejercicios,$texto) {
        $this->render($ejercicios,$texto);
    }
    
    function render($ejercicios,$texto){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de ejercicios <small><?=$texto?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
               <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
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
                            <td><?= $tupla[3]?></td>
                            <td>
                                <a href="../controller/CEjercicio.php?action=modificacion&idEjercicio=<?=$tupla[0]?>" aria-label="Edit">
                                    <img src="../images/edit.png" width="2%" alt="edit"/>
                                </a>
                                <a href=../controller/CEjercicio.php?action=baja&idEjercicio=<?= $tupla[0]?> aria-label="Delete">
                                    <img src="../images/delete.png" width="2%" alt="delete"/>
                                </a>
                                <a href="../controller/CEjercicio.php?action=verDetalle&idEjercicio=<?=$tupla[0]?>">
                                    <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                                </a>
                            </td>
                        </tr>
<?php 
                $tupla=$ejercicios->fetch_row();
        }
        while(!is_null($tupla));
    }
?>
                    </tbody>
               </table>

                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CEjercicio.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
}
?>
