<?php
/**
 * Vista que muestra un formulario para seleccionar el Usuario a modificar para luego mostrar el formulario a modificar
 *
 * @author Samu
 */

class VModificarUsuario{
    function __construct($listaUsuarios) {
        $this->render($listaUsuarios);
    }
    
    function render($listaUsuarios){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione el Usuario a modificar:</h2>
                <form action="../controler/CUsuario.php" method="post">
                    <div>
                        <p>Selecione la ID del Usuario a modificar:</p>
<?php
        $tupla=$listaUsuarios->fetch_row();
        do{
            echo "<input type='radio' name='Id_usuario' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaUsuarios->fetch_row();
        }while(!is_null($tupla));
?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
    }
    
    static function mostrarFormulario($Id_usuario){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de modificacion del Usuario:</h2>
                <form action="../controler/CUsuario.php" method="post">
<?php
        echo "<input type='hidden' name='Id_usuario' value='$Id_usuario'/>";
?>
                    <div>
                        <label for="nombreUs">Nombre del Usuario:</label>
                        <input type="text" name="nombreUs" size="30"/>
                    </div>
                    <div>
                        <label for="DNIUs">Dni ususario:</label><br>
                       <input type="text" name="DNIUs" size="9"/>
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
