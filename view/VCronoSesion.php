<?php
/**
 * Description of VCronoSesion
 *
 * @author iago
 */

class VCronoSesion {
    function __construct($tabla) {
        $this->render($tabla);
    }
    
    function render($tabla){
        menus();
?>
        <style type="text/css">
            *{
                margin: 0;
                padding: 0;
            }
            #contenedor{
                margin: 10px auto;
                width: 540px;
                height: 115px;
            }
            .reloj{
                float: left;
                font-size: 80px;
                font-family: Courier,sans-serif;
                color: white;
            }
            .boton{
                outline: none;
                border: 1px solid #363431;
                color: white;
                width: 128px;
                height: 30px;
                text-shadow: 0px -1px 1px black;
                font-size: 20px;
                border-radius: 5px;
                font-family: Helvetica;
                cursor: pointer;
                background-image: linear-gradient(#3aad02,#2c6f05);
            }
            .boton:active{
                background-image: linear-gradient(#2c6f05,#3aad02);
            }
            .boton:hover{
                box-shadow: 0px 0px 14px #3aad02;
            }
        </style>
        
        <script type="text/javascript">
            var centesimas = 0;
            var segundos = 0;
            var minutos = 0;
            var horas = 0;
            var horaI="";
            function inicio () {
                control = setInterval(cronometro,10);
                document.getElementById("inicio").disabled = true;
                document.getElementById("parar").disabled = false;
                
                toret=new Date();
                horaI=toret.getHours()+":"+toret.getMinutes()+":"+toret.getSeconds();
            }
            function parar (idTabla) {
                clearInterval(control);
                document.getElementById("parar").disabled = true;
                direccion="../controller/CSesion.php?action=crono&horas="+horas+"&minutos="+minutos+"&segundos="+segundos+"&idTabla="+idTabla+"&horaI="+horaI;
                window.location=direccion;
            }
            function cronometro () {
                if (centesimas < 99) {
                    centesimas++;
                    if (centesimas < 10) { centesimas = "0"+centesimas }
                    Centesimas.innerHTML = ":"+centesimas;
                }
                if (centesimas == 99) {
                    centesimas = -1;
                }
                if (centesimas == 0) {
                    segundos ++;
                    if (segundos < 10) { segundos = "0"+segundos }
                    Segundos.innerHTML = ":"+segundos;
                }
                if (segundos == 59) {
                    segundos = -1;
                }
                if ( (centesimas == 0)&&(segundos == 0) ) {
                    minutos++;
                    if (minutos < 10) { minutos = "0"+minutos }
                    Minutos.innerHTML = ":"+minutos;
                }
                if (minutos == 59) {
                    minutos = -1;
                }
                if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
                    horas ++;
                    if (horas < 10) { horas = "0"+horas }
                    Horas.innerHTML = horas;
                }
            }
        </script>

	<div id="page-wrapper">
		
            <div class="container-fluid">
<?php
        $tupla=$tabla->fetch_row();
?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Sesion <?=$tupla[1]?> <small>Cronometro</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table"><tr><td>
                    <div id="contenedor">
                        <div class="reloj" id="Horas">00</div>
                        <div class="reloj" id="Minutos">:00</div>
                        <div class="reloj" id="Segundos">:00</div>
                        <div class="reloj" id="Centesimas">:00</div>
                        <center>
                            <input type="button" class="boton" id="inicio" value="Start &#9658;" onclick="inicio();">
                            <input type="button" class="boton" id="parar" value="Stop &#8718;" onclick="parar(<?=$tupla[0]?>);" disabled>
                        </center>
                    </div><br><br>
                </td></tr></table>
                
                <br>
                
                <table class="table">
                    <thead>
			<tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Tiempo</th>
                            <th>Repeticiones</th>
                            <th>Series</th>
                            <th>Acciones</th>
			</tr>
                    </thead>
                    <tbody>
<?php
        if($tupla!=null){
            do{
?>
                <tr>
                    <td><?=$tupla[3]?></td>
                    <td><?=$tupla[4]?></td>
                    <td><?=$tupla[5]?></td>
                    <td><?=$tupla[6]?></td>
                    <td><?=$tupla[7]?></td>
                    <td>
                        <a href="../controller/CEjercicio.php?action=verDetalle&idEjercicio=<?=$tupla[2]?>" target="_blank">
                            <img src="../images/eye.png" width="2%" alt="showCurrent"/>
                        </a>
                    </td>
                </tr>
<?php 
                $tupla=$tabla->fetch_row();
            }while(!is_null($tupla));
        }
?>
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CSesion.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
}