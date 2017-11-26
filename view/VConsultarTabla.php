<?php
/**
 * Vista que muestra las tablas
 *
 * @author iago
 */

class VConsultarTabla {
    function __construct($tablas) {
        $this->render($tablas);
    }
    
    function render($tablas){
?>
        <html>
            <head>
                <title>Ver tablas</title>
            </head>
            <body>
                <h2>Tablas del usuario:</h2>
<?php
        $tupla=$tablas->fetch_row();
        do{
            echo "<p><a href='../controller/CTabla.php?action=verDetalle&idTabla=$tupla[0]'>$tupla[1]</a></p>";
            $tupla=$tablas->fetch_row();
        }while(!is_null($tupla));
?>
                </table>
            </body>
        </html>
<?php
    }
}
?>