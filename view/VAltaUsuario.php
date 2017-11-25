<?php
/**
 * Vista que muestra un formulario para dar de alta un Usuario
 *
 * @author Samu
 */

class VAltaUsuario{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de alta de Usuario:</h2>
                <form action="../controler/CUsuario.php" method="post">
                    <div>
                        <label for="nombreUs">Nombre del Usuario:</label>
                        <input type="text" name="nombreUs" size="30"/>
                    </div>
                    <div>
                        <label for="DNIUs">DNI del usuario:</label><br>
                        <input type="text" name="DNIUs" size="9"/>

                    </div>
                      <input type='radio' name='Id_PerfilUsuario' value='1'> Administrador
                      <input type='radio' name='Id_PerfilUsuario' value='2'>Entrenador
                     <input type='radio' name='Id_PerfilUsuario' value='3'>Usuario
                    <input type='radio' name='Id_PerfilUsuario' value='4'>Usuario1
   
                      
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