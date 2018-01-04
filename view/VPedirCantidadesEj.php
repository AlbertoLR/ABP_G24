<?php
/**
 * Description of VPedirCantidadesEj
 *
 * @author iago
 */

class VPedirCantidadesEj {
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
                            Asignar ejercicios <small>Seleccione las cantidades de los ejercicios</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="../controller/CTabla.php" method="post">
                    <input type='hidden' name='idTabla' value='<?=$idTabla?>'/>
<?php
        for($i=0;$i<count($ejercicios);$i++){
?>
                    <div class="apartado">
                        <label for="ejercicios"><?=$ejercicios[$i]['name']?>:</label>
                        <input type='hidden' name='ejercicios[]' value='<?=$ejercicios[$i]['id']?>'/>
                    </div>
                    <div class="apartado">
                        <label for="tiempo">Tiempo (especificar magnitud): </label>
                        <input type="text" name="tiempo[]" size="30"/>
                    </div>
                    <div class="apartado">
                        <label for="repeticion">Repeticiones: </label>
                        <input type="number" name="repeticion[]" size="11"/>
                    </div>
                    <div class="apartado">
                        <label for="serie">Series: </label>
                        <input type="number" name="serie[]" size="11"/>
                    </div><br>
<?php
        }
?>

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
                </div>
           
<?php
	footer();
    }
}
?>