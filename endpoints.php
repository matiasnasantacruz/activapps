<?php

    //VERSION DE LA APLICACION

    $APP_VERSION = 1;

    ///Token arbitrario

    define("MAAS_TOKEN","73e7363c3d04878c64663fa0b0f71493c7530cf0a171d8d784308f92146f188c30644f5fe529cd372be4b1cea271acfd1e328dea0b7de6ead099f35a4e6bf507");

    ///Si no vino definida o, vino definida pero no coincide, termina la ejecución
    if(!isset($_POST["maas_token"]) || trim($_POST["maas_token"]) != MAAS_TOKEN) die("error");

    $nombre_mutual = trim($_POST["nombre_mutual"]);

    ////El directorio es un JSONString

    ///Se compone de una lista de mutuales representadas por un objeto
    ///que tiene el identificador de la mutual y otro objeto de URLs
    ///El objeto de la mutual tiene un atributo web_endpoint que es
    ///la URL del homebanking web, y luego las sucursales según su ID
    ///ya definido, tienen la URL del servidor de APIs.
    ///La sucursal 0 es el servidor demo
    ////cada sucursal tendrá la estructura

    // {
    //     "IDSUCURSAL":"http://ENDPOINT:PUERTO/"
    // }

    function mapear($arr){
        $ret["id"] = $arr[0];
        $ret["endpoint"] = $arr[1];
        return $ret;
    }

    $directorio["mutuales"] = array();

    // $lapara["nombre"] = "LAPARA";
    // $lapara["web_endpoint"] = "http://186.189.231.237:8989/";
    // $lapara["sucursales"] = array_map('mapear',[
    //     ["0","http://186.189.231.237:8989/"],
    //     ["1","http://200.82.125.238:8989/"],
    //     ["2","http://138.59.246.7:8989//"],
    //     ["3","http://45.161.168.32:8989/"],
    //     ["4","http://25.106.175.87:8989/"]
    // ]);

    $lapara["nombre"] = "LAPARA";
    $lapara["web_endpoint"] = "http://186.189.231.237:8989/";
    $lapara["sucursales"] = array_map('mapear',[
        ["0","http://128.201.134.12:8989/"],
        ["1","http://200.82.125.238:8989/"],
        ["2","http://138.59.246.7:8989//"],
        ["3","http://45.161.168.32:8989/"],
        ["4","http://25.106.175.87:8989/"]
    ]);

    array_push($directorio["mutuales"],$lapara);

    /////////////////////////////////

    $calchaqui["nombre"] = "CALCHAQUI";
    $calchaqui["web_endpoint"] = "http://200.117.155.63:8989/";
    $calchaqui["sucursales"] = array_map('mapear',[
        ["0","http://200.117.155.63:8989/"],
    ]);

    array_push($directorio["mutuales"],$calchaqui);

    //////////////////////////////////////
    //
    $belgranocrespo["nombre"] = "BELGRANOCRESPO";
    $belgranocrespo["web_endpoint"] = "http://190.225.164.23:8989/";
    $belgranocrespo["sucursales"] = array_map('mapear',[

        ["0","http://190.225.164.23:8989/"],
        ["1","http://186.125.49.18:8989/"],
        ["2","http://190.228.83.46:8989/"],
        ["3","http://200.71.237.240:8989/"],
        ["4","http://45.224.188.218:8989/"],
        ["5","http://190.110.239.28:8989/"],
        ["6","http://200.107.99.34:8989/"],
        ["7","http://190.138.135.50:8989/"],
        ["8","http://190.225.164.23:8989/"]

    ]);

    array_push($directorio["mutuales"],$belgranocrespo);

    $freyre["nombre"] = "FREYRE";
    $freyre["web_endpoint"] = "http://186.189.231.237:8989/";
    $freyre["sucursales"] = array_map('mapear',[
        ["0","http://128.201.134.12:8989/"],
        // ["0","http://186.189.231.237:8989/"],
        
    ]);

    array_push($directorio["mutuales"],$freyre);

    // var_dump($directorio);
    // echo json_encode($directorio);
  

    ////Los nombres de las mutuales son wildcards. Se definirán como:
    ////LAPARA: Mutual de La Para
    ////BELGRANOCRESPO: Mutual Belgrano de Crespo
    ////Etc.

    ////Sección de respuesta

    //$dir = json_decode($directorio);
    // die($directorio);

    $ret = "";
    foreach ($directorio["mutuales"] as $i) {
        if($i["nombre"] == $nombre_mutual){
            ///Encontré la mutual, devuelvo los endpoints
            $i["app_version"] = $APP_VERSION;
            echo json_encode($i);
            die();
        }
        // echo $i["nombre"]."<br>";
    }

    ///No encontré la mutual
    echo "error";

?>