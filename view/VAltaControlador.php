<?php
/**
 * Vista que muestra un formulario para dar de alta un controlador
 *
 * @author alberto
 */

class VAltaControlador{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de alta de controlador:</h2>
                <form action="../controller/CControlador.php" method="post">
                    <div>
                        <label for="nombreCt">Nombre del controlador:</label>
                        <input type="text" name="nombreCt" size="30"/>
                    </div>
                    <div>
                        <button type="submit" name="action" value="alta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
}
?>