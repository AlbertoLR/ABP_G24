<?php
/**
 * Vista que muestra un formulario para buscar Actividad2s, para mostrarlos en una tabla
 *
 * @author Samu
 */


class VConsultarActividad2{
    function __construct() {
        $this->render();
        
    }
    
    function render(){
      menus();
?>
       <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Buscar <small>Consulta Actividad</small>
                        </h1>
                    </div>
                </div>
               
                <form action="../controller/CActividad2.php" method="post">
                    <div>
                        <label for="Nombre">Nombre Actividad: </label>
                        <input type="text" name="Nombre" size="9"/>

                    </div>

                    <div>
                        <button type="submit" name="action" value="consulta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
           
<?php
footer();
    }
    
    static function mostrar($resultado){
        menus();
?>
        
        <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de actividades
                        </h1>
                    </div>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre Actividad</th>
                            <th>Sala</th>
                            <th>Capadidad</th>
                            <th>Hora inicio</th>
                            <th>Hora Fin</th>
                            <th>Dia</th>
<?php
        if($_SESSION['Id_PerfilUsuario']==1){
?>
                            <th>Recurso</th>
<?php
        }
?>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
        $tupla=$resultado->fetch_row();
        if($tupla!=null){
            do{
?>
                        <tr>
                            <td><?=$tupla[1]?></td>
                            <td><?=$tupla[2]?></td>
                            <td><?=$tupla[3]?></td>
                            <td><?=$tupla[4]?></td>
                            <td><?=$tupla[5]?></td>
                            <td><?=$tupla[6]?></td>
<?php
                if($_SESSION['Id_PerfilUsuario']==1){
?>
                            <td><?=$tupla[8]?></td>
<?php
                }
?>
                            <td>
                                <a href='../controller/CActividad2.php?action=verDetalle&Id_Actividad=<?=$tupla[0]?>' target='_blank'>
                                    <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                                </a>
<?php
                if($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4){
?>
                                <a href='../controller/CActividad2.php?action=registrarse&Id_Actividad=<?=$tupla[0]?>'>
                                    <img src="../images/add.png" width="2%" alt="registrarse"/>
                                </a>
<?php
                }
?>
                            </td>
<?php
                $tupla=$resultado->fetch_row();
            }while(!is_null($tupla));
        }
?>
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CActividad2.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
         
<?php
 footer();
    }

}
?>