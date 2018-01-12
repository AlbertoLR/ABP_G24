<?php
/**
 * Description of VShowAllSesion
 *
 * @author iago
 */

class VShowAllSesion {
    function __construct($sesiones,$texto) {
        $this->render($sesiones,$texto);
    }
    
    function render($sesiones,$texto){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de sesiones <small><?=$texto?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
               <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Tabla</th>
                            <th>Fecha</th>
<?php
                if($_SESSION['Id_PerfilUsuario']==2){
?>
                            <th>Nombre user</th>
                            <th>DNI</th>
<?php
                }
?>
                            <th>Acciones</th>
			</tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$sesiones->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td><?=$tupla[1]?></td>
                            <td><?=$tupla[3]?></td>
                            <td><?=$tupla[4]?></td>
<?php
                if($_SESSION['Id_PerfilUsuario']==2){
?>
                            <td><?=$tupla[6]?> <?=$tupla[7]?></td>
                            <td><?=$tupla[5]?></td>
<?php
                }
?>
                            <td>
<?php
                if($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4){
?>
                                <a href="../controller/CSesion.php?action=modificacion&idSesion=<?=$tupla[0]?>" aria-label="Edit">
                                    <img src="../images/edit.png" width="2%" alt="edit"/>
                                </a> 
                                <a href=../controller/CSesion.php?action=baja&idSesion=<?= $tupla[0]?> aria-label="Delete">
                                    <img src="../images/delete.png" width="2%" alt="delete"/>
                                </a> 
<?php
                }
?>
                                <a href="../controller/CSesion.php?action=verDetalle&idSesion=<?=$tupla[0]?>">
                                    <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                                </a>
                                <a href="../controller/CTabla.php?action=verDetalle&idTabla=<?=$tupla[2]?>" target="_blank">
                                    <img src="../images/table.png" width="2%" alt="Ver tabla"/>
                                </a> 
                            </td>
                        </tr>
<?php 
                $tupla=$sesiones->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </tbody>
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
