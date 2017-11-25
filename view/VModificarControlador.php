<?php
/**
 * Vista que muestra un formulario para seleccionar el controlador a modificar para luego mostrar el formulario a modificar
 *
 * @author alberto
 */

class VModificarControlador{
    function __construct($listaControladores) {
        $this->render($listaControladores);
    }
    
    function render($listaControladores){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione el controlador a modificar:</h2>
                <form action="../controller/CControlador.php" method="post">
                    <div>
                        <p>Seleccione la ID del controlador a modificar:</p>
<?php
        $tupla=$listaControladores->fetch_row();
        do{
            echo "<input type='radio' name='idControlador' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaControladores->fetch_row();
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
    
    static function mostrarFormulario($idControlador){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de modificacion del controlador:</h2>
                <form action="../controller/CControlador.php" method="post">
<?php
        echo "<input type='hidden' name='idControlador' value='$idControlador'/>";
?>
                    <div>
                        <label for="nombreCt">Nombre del controlador:</label>
                        <input type="text" name="nombreCt" size="30"/>
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
