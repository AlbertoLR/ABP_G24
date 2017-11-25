<?php
/**
 * Vista que muestra un formulario para seleccionar el Usuario a modificar para luego mostrar el formulario a modificar
 *
 * @author Samu
 */

class VModificarPerfilUsuario{
    function __construct($listaPerfilUsuarios) {
        $this->render($listaPerfilUsuarios);
    }
    
    function render($listaPerfilUsuarios){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione el tipo de  Usuario a modificar:</h2>
                <form action="../controller/CPerfilUsuario.php" method="post">
                    <div>
                        <p>Selecione la ID del Usuario a modificar:</p>
<?php
        $tupla=$listaPerfilUsuarios->fetch_row();
        do{
            echo "<input type='radio' name='Id_PerfilUsuario' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaPerfilUsuarios->fetch_row();
        }while(!is_null($tupla));
?>
                        
                    </div>
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
    }
    
    static function mostrarFormulario($Id_PerfilUsuario){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de modificacion del Perfil:</h2>
                <form action="../controller/CPerfilUsuario.php" method="post">
<?php
        echo "<input type='hidden' name='Id_PerfilUsuario' value='$Id_PerfilUsuario'/>";
?>
                    <div>
                        <label for="Tipo">Tipo de usuario:</label>
                        <input type="text" name="Tipo" size="30"/>
                    </div>
                   
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
}
?>
