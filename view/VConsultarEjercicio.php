<?php
/**
 * Vista que muestra un formulario para buscar ejercicios, para mostrarlos en una tabla
 *
 * @author iago
 */

class VConsultarEjercicio{
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
                            Buscar Ejercicio <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CEjercicio.php" method="post">
                    <div class="apartado">
                        <label for="nombreEj">Nombre del Ejercicio:</label>
                        <input type="text" name="nombreEj" size="45"/>
                    </div>
                    <div class="apartado">
			<label for="tipoEj">Tipo de Ejercicio:</label><br>	
                        <input type='radio' name='tipoEj' value='aerobico'><b> Aerobico </b><br>
                        <input type='radio' name='tipoEj' value='anaerobico'><b> Anaerobico </b><br>
                        <input type='radio' name='tipoEj' value='mixto'><b> Mixto </b><br>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="consulta"><b>Enviar</b></button>
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