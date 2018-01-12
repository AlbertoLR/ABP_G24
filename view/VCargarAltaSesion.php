<?php
/**
 * Description of VCargarAltaSesion
 *
 * @author iago
 */

class VCargarAltaSesion {
    function __construct($tablas) {
        $this->render($tablas);
    }
    
    function render($tablas){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Inciar sesion <small>Seleccione la tabla</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CSesion.php" method="post">
                    <div class="apartado">
			<label for="idTabla">Tabla sobre la que realizar la sesion:</label><br>
<?php
        $tupla=$tablas->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='radio' name='idTabla' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?> </b><br>
<?php
                $tupla=$tablas->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="crono"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
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