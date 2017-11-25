<?php
/**
 * Vista que muestra un formulario para seleccionar el controlador a borrar para luego mostrar el controlador seleccionado y solicitar confirmacion
 *
 * @author alberto
 */

class VBajaControlador{
    function __construct($listaControladores) {
        $this->render($listaControladores);
    }
    
    function render($listaControladores){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione el controlador a borrar:</h2>
                <form action="../controller/CControlador.php" method="post">
                    <div>
                        <p>Selecione la ID del controlador a borrar:</p>
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
                        <button type="submit" name="action" value="baja">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
    }
    
    static function solicitarConfirmacion($controladorBorrar){
?>
        <html>
            <head></head>
            <body>
                <h2>¿Desea borrar este controlador?</h2>
                <table>
                    <tr>
                        <td>Id del controlador:</td>
<?php
        echo "<td>$controladorBorrar[0]</td>";
?>
                    </tr>
                    <tr>
                        <td>Nombre del controlador:</td>
<?php
        echo "<td>$controladorBorrar[1]</td>";
?>
                    </tr>

                </table>
                <br><br>
                <form action="../controller/CControlador.php" method="POST">
<?php
        echo "<input type='hidden' name='idControlador' value='$controladorBorrar[0]'/>";
        echo "<input type='hidden' name='nombreCt' value='$controladorBorrar[1]'/>";
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
