<?php
/**
 * Description of VCargarAltaPEF
 *
 * @author iago
 */

class VCargarAltaPEF {
    function __construct($usersPEF) {
        $this->render($usersPEF);
    }
    
    function render($usersPEF){
	menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nueva Tabla <small>Seleccione usuario PEF</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CTabla.php" method="post">
                    <div class="apartado">
			<label for="tipoEj">Usuario PEF asignado:</label><br>
<?php
        $tupla=$usersPEF->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='radio' name='Id_usuario' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?> </b><?=$tupla[2]?><br>
<?php
                $tupla=$usersPEF->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="alta"><b>Enviar</b></button>
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