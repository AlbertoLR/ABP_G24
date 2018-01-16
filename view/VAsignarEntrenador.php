<?php
/**
 * Description of VAsignarEntrenador
 *
 * @author Iago
 */

class VAsignarEntrenador {
    function __construct($idUser,$entrenadores) {
        $this->render($idUser,$entrenadores);
    }
    
    function render($idUser,$entrenadores){
	menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Asignacion entrenador
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CUsuario.php" method="post">
                    <input type='hidden' name='idUser' value='<?=$idUser?>'/>
                    <div class="apartado">
                        <label for="idEntrenador">Seleccione un entrenador:</label><br>
<?php
        $tupla=$entrenadores->fetch_row();
        if($tupla!=null){
            do{
?>
                            <input type='radio' name='idEntrenador' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?> <?=$tupla[2]?><br>
<?php
                $tupla=$entrenadores->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="asignarEntrenador"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
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