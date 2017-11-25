<?php
/**
 * Vista que muestra un formulario para dar de alta una acción
 *
 * @author alberto
 */

class VAltaAccion{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de alta de acción:</h2>
                <form action="../controler/CAccion.php" method="post">
                    <div>
                        <label for="nombreAc">Nombre de la acción:</label>
                        <input type="text" name="nombreAc" size="30"/>
                    </div>
                    <div>
                        <button type="submit" name="action" value="Alta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
}
?>