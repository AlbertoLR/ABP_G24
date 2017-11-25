<?php
/**
 * Vista que muestra un formulario para seleccionar la acción a modificar para luego mostrar el formulario a modificar
 *
 * @author alberto
 */

class VModificarAccion{
    function __construct($listaAcciones) {
        $this->render($listaAcciones);
    }
    
    function render($listaAcciones){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione la acción a modificar:</h2>
                <form action="../controler/CAccion.php" method="post">
                    <div>
                        <p>Seleccione la ID de la acción a modificar:</p>
<?php
        $tupla=$listaAcciones->fetch_row();
        do{
            echo "<input type='radio' name='idAccion' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaAcciones->fetch_row();
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
    
    static function mostrarFormulario($idAccion){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de modificacion de la acción:</h2>
                <form action="../controler/CAccion.php" method="post">
<?php
        echo "<input type='hidden' name='idAccion' value='$idAccion'/>";
?>
                    <div>
                        <label for="nombreAc">Nombre de la acción:</label>
                        <input type="text" name="nombreAc" size="30"/>
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
