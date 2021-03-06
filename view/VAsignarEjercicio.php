<?php
/**
 * Vista q permite asignar a una tabla los ejercicios que contiene
 *
 * @author iago
 */

class VAsignarEjercicio {
    function __construct($idTabla,$ejercicios) {
        $this->render($idTabla,$ejercicios);
    }
    
    function render($idTabla,$ejercicios){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Asignar ejercicios <small>Seleccione los ejercicios a realizar</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CTabla.php" method="post">
                    <input type='hidden' name='idTabla' value='<?=$idTabla?>'/>
                    <div class="apartado">
			<label for="ejercicios">Ejercicios asignados a la tabla:</label><br>
<?php
        $tupla=$ejercicios->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='checkbox' name='ejercicios[]' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?><br>
<?php
                $tupla=$ejercicios->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="asignarEj"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CTabla.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div><br>
           
<?php
	footer();
    }
}
?>