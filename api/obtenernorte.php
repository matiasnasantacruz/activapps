<?php

// include "";
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    $arraydiassemana = ["DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO"];

    //////////////

    ///BUSCAR LAS COMBINACIONES DE LOCALIDADES, POR CADA UNA
    ///BUSCAR EL QUERY DE LA OTRA
    ///TODA LA SEMANA

    $localidades = array();

    $reslocalidaes = $mysqli->query();

    $fecha = date("Y-m-d",strtotime("+0 day"));
    $diasemana = date('w', strtotime($fecha));

    $dia = $arraydiassemana[$diasemana];

    $fechaquery = date("m/d/Y",strtotime($fecha));

    $localidadsalida = "SAN JUSTO";
    // $localidadsalidaquery = mysqli_fetch_assoc($mysqli->query("SELECT clavecentralpasajes from localidades where nombre = '$localidadsalida'"))["clavecentralpasajes"];
    $localidadsalidaquery  ="san-justo";
    $localidadllegada = "VIDELA";
    // $localidadllegadaquery = mysqli_fetch_assoc($mysqli->query("SELECT clavecentralpasajes from localidades where nombre = '$localidadllegada'"))["clavecentralpasajes"];
    $localidadllegadaquery  ="videla";

    $urlquery = "https://www.centraldepasajes.com.ar/cdp/pasajes-micro/$localidadsalidaquery/$localidadllegadaquery?FIda=$fechaquery&CntPas=1";
    
    // die($urlquery);

    $html = file_get_contents($urlquery);

    $comps = explode("card d-md-flex",$html);

    // var_dump($comps);
    $primero = true;
    foreach ($comps as $i) {
        # code...
        if($primero){
            $primero = false;
            continue;
        }

        $primero = false;

        $minicomps = explode("d-flex horario",$i);
        // var_dump($minicomps);
        $horarios = explode("class=\"hora\"",$minicomps[1]);
  
        // var_dump($horarios);
        // die();

        $salida = explode("</div>", $horarios[1]);
        $salida  =substr($salida[0],1);

        echo "Sale a las: ".$salida."<br>";

        $minill = explode(" ",$horarios[2]);

        $valor = explode("valor",$horarios[2]);

        //  var_dump($minill);
        //  die();
        $valor = explode("</div>",$valor[1])[0];

        $valor = str_replace("<span>","",$valor);
        $valor = str_replace("</span>","",$valor);
    
        $valor = substr($valor,2);

        // var_dump($valor);

        // die();

        $importe = $valor;

        $llegada = explode("<div>", $minill[0]);
        $llegada = substr($llegada[0],1);

        echo "Llega a las: ".$llegada."<br>";

        $sql = "INSERT INTO `horariosnorte` (`fecha`, `dia`, `salida`, `llegada`, `localidadsalida`, `localidadllegada`, `importe`) VALUES ('$fecha', '$dia', '$salida', '$llegada', '$localidadsalida', '$localidadllegada','$importe')";


        // echo $sql."<br>";

    }

    // echo $html;

?>