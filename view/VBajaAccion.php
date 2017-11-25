<?php
/**
 * Vista que muestra un formulario para seleccionar la acción a borrar para luego mostrar la acción seleccionada y solicitar confirmacion
 *
 * @author alberto
 */

class VBajaAccion{
    function __construct($listaAcciones) {
        $this->render($listaAcciones);
    }
    
    function render($listaAcciones){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione la acción a borrar:</h2>
                <form action="../controller/CAccion.php" method="post">
                    <div>
                        <p>Selecione la ID de la acción a borrar:</p>
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
                        <button type="submit" name="action" value="baja">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
    }
    
    static function solicitarConfirmacion($accionBorrar){
?>
        <html>
            <head></head>
            <body>
                <h2>¿Desea borrar esta acción?</h2>
                <table>
                    <tr>
                        <td>Id de la acción:</td>
<?php
        echo "<td>$accionBorrar[0]</td>";
?>
                    </tr>
                    <tr>
                        <td>Nombre de la acción:</td>
<?php
        echo "<td>$accionBorrar[1]</td>";
?>
                    </tr>

                </table>
                <br><br>
                <form action="../controller/CAccion.php" method="POST">
<?php
        echo "<input type='hidden' name='idAccion' value='$accionBorrar[0]'/>";
        echo "<input type='hidden' name='nombreAc' value='$accionBorrar[1]'/>";
        echo "<input type='hidden' name='action' value='baja'/>";
?>
                    <div>
                        <button type="submit" name="confirmar" value="si">Si</button>
                        <button type="submit" name="confirmar" value="no">No</button>
                    </div>
                </form>
            </body>
        </html>
<?php
    }
}
?>
