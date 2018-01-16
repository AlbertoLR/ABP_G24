<?php
/**
 * Vista que muestra en detalle un Actividad
 *
 * @author iago
 */
class VVerDetalleActividad {
    function __construct($Actividad,$usuarios) {
        $this->render($Actividad,$usuarios);
    }
    
    function render($Actividad,$usuarios){
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

                <div class="col-lg-12">
                    <h2>Deportistas inscritos</h2>
                </div>
                
                <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Desinscribir</th>
			</tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$usuarios->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td><?=$tupla[1]?> <?=$tupla[2]?></td>
                            <td>
<?php
                if($_SESSION['Id_PerfilUsuario']==1 || $_SESSION['Id_usuario']==$tupla[0]){
?>
                                <a href="../controller/CActividad2.php?action=desinscribirse&idUser=<?=$tupla[0]?>&idActividad=<?=$Actividad[0]?>">
                                    <img src="../images/delete.png" width="2%" alt="delete"/>
                                </a>
<?php
                }
?>
                            </td>
                        </tr>
<?php 
                $tupla=$usuarios->fetch_row();
            }while(!is_null($tupla));
        }
?>
                    </tbody>
               </table>
                
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
