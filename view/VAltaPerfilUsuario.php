<?php
/**
 * Vista que muestra un formulario para dar de alta un Usuario
 *
 * @author Samu
 */

class VAltaPerfilUsuario{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de alta de Usuario:</h2>
                <form action="../controler/CPerfilUsuario.php" method="post">
                    <div>
                        <label for="Tipo">Tipo de usuario:</label>
                        <input type="text" name="Tipo" size="30"/>
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