<?php
/**
 * Description of VShowAllTabla
 *
 * @author iago
 */

class VShowAllTabla {
    function __construct($tablas,$texto) {
        $this->render($tablas,$texto);
    }
    
    function render($tablas,$texto){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de tablas <small><?=$texto?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
               <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
<?php
        if($_SESSION['Id_PerfilUsuario']==2){
?>
                            <th>Acciones</th>
<?php
        }
?>
			</tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$tablas->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td><?=$tupla[1]?></td>
                            <td><?= $tupla[2]?></td>
                            <td>
<?php
                if($_SESSION['Id_PerfilUsuario']==2){
?>

                                <a href="../controller/CTabla.php?action=modificacion&idTabla=<?=$tupla[0]?>" aria-label="Edit">
                                    <img src="../images/edit.png" width="2%" alt="edit"/>
                                </a>
                                <a href=../controller/CTabla.php?action=baja&idTabla=<?= $tupla[0]?> aria-label="Delete">
                                    <img src="../images/delete.png" width="2%" alt="delete"/>
                                </a>
<?php
                }
?>
                                <a href="../controller/CTabla.php?action=verDetalle&idTabla=<?=$tupla[0]?>">
                                    <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                                </a>
                            </td>
                        </tr>
<?php 
                $tupla=$tablas->fetch_row();
        }
        while(!is_null($tupla));
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
