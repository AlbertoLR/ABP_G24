<?php
/**
 * Vista que muestra un formulario para buscar Usuarios, para mostrarlos en una tabla
 *
 * @author Samu
 */

class VConsultarPerfilUsuario{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de busqueda:</h2>
                <form action="../controler/CPerfilUsuario.php" method="post">
                    <div>
                        <label for="Tipo">Tipo:  </label>
                        <input type="text" name="Tipo" size="9"/>

                    </div>
                    <div>
                        <button type="submit" name="action" value="consulta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
    
    static function mostrar($resultado){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de busqueda:</h2>
                <table>
                    <tr>
                        <td>Tipo</td>
                       
                    </tr>
<?php
        $tupla=$resultado->fetch_row();
        do{
            echo "<tr><td>$tupla[1]</td>";
                       $tupla=$resultado->fetch_row();
        }while(!is_null($tupla));
?>
                </table>
            </body>
        </html>
<?php
    }
}
?>