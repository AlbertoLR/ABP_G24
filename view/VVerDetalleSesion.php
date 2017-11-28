<?php
/**
 * Vista que muestra en detalle una sesion
 *
 * @author iago
 */
class VVerDetalleSesion {
    function __construct($sesion,$nombreTabla) {
        $this->render($sesion, $nombreTabla);
    }
    
    function render($sesion,$nombreTabla){
?>
        <html>
            <head>
                <title>Ver sesion</title>
            </head>
            <body>
<?php
        echo "<h2>Sesion $sesion[3]:</h2>";
        echo "<p>Tabla de sesion: <a href='../controller/CTabla.php?idTabla=$sesion[2]&action=verDetalle'>$nombreTabla</a></p>";
        echo "<p>Hora de inicio:$sesion[4]</p>";
        echo "<p>Hora de finalizacion:$sesion[5]</p>";
        echo "<p>Comentario:<br>$sesion[6]</p>";
?>
            </body>
	</html>
<?php
    }
}
?>