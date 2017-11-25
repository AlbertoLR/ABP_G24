<?php
/**
 * Vista que muestra un formulario para buscar controladores, para mostrarlos en una tabla
 *
 * @author alberto
 */

class VConsultarControlador{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de busqueda:</h2>
                <form action="../controller/CControlador.php" method="post">
                    <div>
                        <label for="nombreCt">Nombre del controlador:</label>
                        <input type="text" name="nombreCt" size="30"/>
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
                        <td>Nombre controlador</td>
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