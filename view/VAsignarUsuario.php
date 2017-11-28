<?php
/**
 * Description of VAsignarUsuario
 *
 * @author iago
 */

class VAsignarUsuario {
    function __construct($tabla) {
        $this->render($tabla);
    }
    
    function render($tabla){
?>
        <html>
            <head></head>
            <body>
                <h2>Asignar usuarios:</h2>
<?php
        echo "<p>Seleccione si desea añadir ya usuarios a la tabla $tabla[1]:</p>";
?>
                <form action="../controller/CTabla.php" method="post">
<?php
        echo "<input type='hidden' name='idTabla' value='$tabla[0]'/>";
        echo "<input type='hidden' name='action' value='asignarUser'/>";
?>
                    <div>
                        <button type="submit" name="opcion" value="si">Si</button>
                        <button type="submit" name="opcion" value="no">No</button>
                    </div>
                </form>
            </body>
        </html>
<?php
    }
    
    static function asignarUsuario($usuarios,$idTabla,$opcion){
?>
        <html>
            <head></head>
            <body>
                <h2>Asignar usuarios</h2>
                <p>Selecione los usuarios sobre los que realizar la accion:</p>
                <form action="./CTabla.php" method="post">
                    <div>
                        <p>Marque los usuarios:</p>
                    
<?php
        echo "<input type='hidden' name='idTabla' value='$idTabla'/>";
        echo "<input type='hidden' name='opcion' value='$opcion'/>";
        $user=$usuarios->fetch_row();
        do{
            echo "<input type='checkbox' name='usuarios[]' value='$user[0]'/>$user[1]<br>";
            $user=$usuarios->fetch_row();
        }while(!is_null($user));
?>
                    </div>
                    <div>
                        <button type="submit" name="action" value="asignarUser">Enviar</button>
                    </div>
                </form>
            </body>
        </html>
<?php 
    }
}
?>