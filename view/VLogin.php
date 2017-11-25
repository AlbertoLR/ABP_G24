<?php
/**
 * Vista que muestra un formulario para iniciar sesion
 *
 * @author iago
 */

class VLogin {
    function __construct(){
        $this->render();
    }
    
    function render(){
?>
       <html>
            <head>
                <title>Login</title>
            </head>
            <body>
                <h2>Formulario de login:</h2>
                <form action="../controler/CLogin.php" method="post">
                    <div>
                        <label for="dni">Usuario:</label>
                        <input type="text" name="dni" size="9"/>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" name="password" size="50"/>
                    </div>
                    <div>
                        <button type="submit" name="action" value="comprobar">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
}
