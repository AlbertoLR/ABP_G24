<?php
/**
 * Vista que muestra un formulario para seleccionar la sesion a borrar para luego mostrar la sesion seleccionada y solicitar confirmacion
 *
 * @author iago
 */

class VBajaSesion {
    function __construct($sesionBorrar) {
        $this->render($sesionBorrar);
    }
    
    function render($sesionBorrar){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Borrar sesion
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><?=$sesionBorrar[1]?></td>
                    </tr>
                    <tr>
                        <td><b>Tabla</b></td>
                        <td><?=$sesionBorrar[3]?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha</b></td>
                        <td><?=$sesionBorrar[4]?></td>
                    </tr>
                    <tr>
                        <td><b>Duracion</b></td>
                        <td><?=$sesionBorrar[5]?></td>
                    </tr>
                    <tr>
                        <td><b>Comentario</b></td>
                        <td><?=$sesionBorrar[6]?></td>
                    </tr>
                </table>
                
                <form action="../controller/CSesion.php?action=baja" method="post">
                    <input type='hidden' name='idSesion' value='<?=$sesionBorrar[0]?>'/>
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
