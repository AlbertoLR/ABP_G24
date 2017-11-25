<?php
/**
 * Vista que muestra un formulario para seleccionar el Usuario a borrar para luego mostrar el Usuario seleccionado y solicitar confirmacion
 *
 * @author Samu
 */

class VBajaPerfilUsuario{
    function __construct($listaPerfilUsuarios) {
        $this->render($listaPerfilUsuarios);
    }
      function render($listaPerfilUsuarios){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione el tipo de  Usuario a borrar:</h2>
                <form action="../controller/CPerfilUsuario.php" method="post">
                    <div>
                        <p>Selecione la ID del Usuario a borrar:</p>
<?php
       
        $tupla=$listaPerfilUsuarios->fetch_row();
        do{
            echo "<input type='radio' name='Id_PerfilUsuario' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaPerfilUsuarios->fetch_row();
        }while(!is_null($tupla));
?>
                       
                    </div>
                    <div>
                        <button type="submit" name="action" value="baja">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
    }
    
    static function solicitarConfirmacion($UsuarioBorrar){
?>
        <html>
            <head></head>
            <body>
                <h2>¿Desea borrar este Usuario?</h2>
                <table>
                    <tr>
                        <td>Id del Usuario:</td>
<?php
        echo "<td>$UsuarioBorrar[0]</td>";
?>
                    </tr>
                    <tr>
                        <td>Tipo de usuario:</td>
<?php
        echo "<td>$UsuarioBorrar[1]</td>";
?>
                    </tr>
                    
                </table>
                <br><br>
                <form action="../controller/CPerfilUsuario.php" method="POST">
<?php
        echo "<input type='hidden' name='Id_PerfilUsuario' value='$UsuarioBorrar[0]'/>";
        echo "<input type='hidden' name='Tipo' value='$UsuarioBorrar[1]'/>";
       
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
