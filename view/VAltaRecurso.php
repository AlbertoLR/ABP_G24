<?php
/**
 * Vista que muestra un formulario para dar de alta un Recurso
 *
 * @author Samu
 */

include "../layout/menus.php";
include "../layout/footer.php";

class VAltaRecurso{
    function __construct() {
        $this->render();
    }
    
    function render(){
    	?>
    	<?php 
    	menus();

?>
       	

                <h2>Formulario de alta de Recurso:</h2>
                <form action="../controller/CRecurso.php" method="post">
                    <div class="apartado">
                        <label for="Nombre">Nombre del Recurso:</label>
                        <input type="text" name="Nombre" size="30"/>
                    </div>
                     <div class="apartado">
                        <label for="Capacidad">Capacidad de la sala:</label>
                        <input type="text" name="Capacidad" size="30"/>
                    </div>
                
   
                      
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="alta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
           
	
<?php
footer();
    }
}
?>