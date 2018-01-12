<?php
/**
 * Vista que muestra un formulario para seleccionar el ejercicio a borrar para luego mostrar el ejercicio seleccionado y solicitar confirmacion
 *
 * @author iago
 */

class VBajaEjercicio{
    function __construct($ejercicioBorrar) {
        $this->render($ejercicioBorrar);
    }
    
    function render($ejercicioBorrar){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Borrar ejercicio
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$ejercicioBorrar[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo</b></td>
                        <td><?=$ejercicioBorrar[3]?></td>
                    </tr>
                    <tr>
                        <td><b>Descripcion</b></td>
                        <td><?=$ejercicioBorrar[2]?></td>
                    </tr>
                </table>
                
                <form action="../controller/CEjercicio.php?action=baja" method="post">
                    <input type='hidden' name='idEjercicio' value='<?=$ejercicioBorrar[0]?>'/>
                    <center>
                        <button type="submit" name="confirmar" value="si"><img src="../images/confirm.png" width="4%" alt="confirm"/></button>
                        <button type="submit" name="confirmar" value="no"><img src="../images/cancel.png" width="4%" alt="cancel"/></button>
                    </center>
                </form>
<?php
	footer();
    }
}
?>
