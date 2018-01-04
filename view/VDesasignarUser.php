<?php
/**
 * Description of VDesasignarUser
 *
 * @author iago
 */

class VDesasignarUser {
    function __construct($idTabla,$idUsuario) {
        $this->render($idTabla,$idUsuario);
    }
    
    function render($idTabla,$idUsuario){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Desasignar tabla
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="../controller/CTabla.php?action=baja" method="post">
                    <input type='hidden' name='idTabla' value='<?=$idTabla?>'/>
                    <input type='hidden' name='idUsuario' value='<?=$idUsuario?>'/>
                    <div class="apartado">
                        <label for="#">¿Desea eliminar esta asignacion?</label>
                    </div>
                    <button type="submit" name="confirmar" value="si"><img src="../images/confirm.png" width="4%" alt="confirm"/></button>
                    <button type="submit" name="confirmar" value="no"><img src="../images/cancel.png" width="4%" alt="cancel"/></button>
                </form>
<?php
	footer();
    }
}
?>
