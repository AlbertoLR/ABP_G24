<?php
/**
 * Vista que muestra un formulario para buscar sesiones, para mostrarlas en una tabla
 *
 * @author iago
 */

class VConsultarSesion {
    function __construct($tablasUser) {
        $this->render($tablasUser);
    }
    
    function render($tablasUser){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione tabla de la sesion:</h2>
<?php
        $tupla=$tablasUser->fetch_row();
        do{
            echo "<p><a href='../controller/CSesion.php?idTabla=$tupla[0]&action=consulta'>$tupla[1]</a></p>";
            $tupla=$tablasUser->fetch_row();
        }while(!is_null($tupla));
?>
            </body>
	</html>
<?php
    }
    
    static function mostrar($sesiones){
        $tupla=$sesiones->fetch_row();
?>
        <html>
            <head></head>
            <body>
                <h2>Lista de sesiones:</h2>
<?php
        echo "<p>Sesiones sobre la tabla $tupla[1]</p>";
        do{
            echo "<p><a href='../controller/CSesion.php?idSesion=$tupla[0]&action=verDetalle'>$tupla[2]</a></p>";
            $tupla=$sesiones->fetch_row();
        }while(!is_null($tupla));
?>
            </body>
        </html>
<?php
    }
}
?>