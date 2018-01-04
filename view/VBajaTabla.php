<?php
/**
 * Vista que muestra un formulario para seleccionar la tabla a borrar para luego mostrar el ejercicio seleccionado y solicitar confirmacion
 *
 * @author iago
 */

class VBajaTabla {
    function __construct($tablaBorrar,$ejercicios) {
        $this->render($tablaBorrar,$ejercicios);
    }
    
    function render($tablaBorrar,$ejercicios){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Borrar tabla
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$tablaBorrar[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo</b></td>
                        <td><?=$tablaBorrar[2]?></td>
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
                
                <form action="../controller/CTabla.php?action=baja" method="post">
                    <input type='hidden' name='idTabla' value='<?=$tablaBorrar[0]?>'/>
                    <button type="submit" name="confirmar" value="si"><img src="../images/confirm.png" width="4%" alt="confirm"/></button>
                    <button type="submit" name="confirmar" value="no"><img src="../images/cancel.png" width="4%" alt="cancel"/></button>
                </form>
<?php
	footer();
    }
}
?>
