<?php
/**
 * Vista que muestra un formulario para seleccionar la tabla a modificar para luego mostrar el formulario para modificar
 *
 * @author iago
 */

class VModificarTabla {
    function __construct($idTabla) {
        $this->render($idTabla);
    }
    
    function render($idTabla){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Editar Tabla <small>Introduzca nuevo nombre</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CTabla.php?action=modificacion" method="post">
                    <input type='hidden' name='idTabla' value='<?=$idTabla?>'/>
                    <div class="apartado">
                        <label for="nombreTabla">Nombre de la tabla:</label>
                        <input type="text" name="nombreTabla" size="45"/>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="asignarEj" value="si"><b>Enviar y reasignar Ej.</b></button>
                        <button type="submit" name="asignarEj" value="no"><b>Enviar</b></button>
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
