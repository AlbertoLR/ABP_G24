<?php
/**
 * Vista que muestra las tablas
 *
 * @author iago
 */

class VConsultarTabla {
    function __construct() {
        $this->render();
    }
    
    function render(){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Buscar Tabla <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CTabla.php" method="post">
                    <div class="apartado">
                        <label for="nombreTabla">Nombre de la Tabla:</label>
                        <input type="text" name="nombreTabla" size="45"/>
                    </div>
                    <div class="apartado">
			<label for="tipoTabla">Tipo de Tabla:</label><br>	
                        <input type='radio' name='tipoTabla' value='Predeterminada'><b> Predeterminada </b><br>
                        <input type='radio' name='tipoTabla' value='Personalizada'><b> Personalizada </b><br>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="consulta"><b>Enviar</b></button>
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