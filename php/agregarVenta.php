<?php
    try
    {
        require_once('connection.php');
        
        $fecha = $_POST["fecha"];
        $tipo = $_POST["tipo"];
        $iddistribuidor = $_POST["iddistribuidor"];
        $puntos = $_POST["puntos"];
        $total = $_POST["total"];
        $estado = "ACTIVO";
        $productos = (isset($_POST["productos"]) ? $_POST["productos"] : []);

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        if (!$fecha) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $tabla = "ventas";

        $sql = "INSERT INTO $tabla
                (idtienda, iddistribuidor, idusuario, fecha, tipo, totalventa, totalpuntos, estado)
                VALUES
                ($idTienda, $iddistribuidor, $idUsuario, '$fecha', '$tipo', $total, $puntos, '$estado')";

        $con->query($sql);
        $idVenta = $con->insert_id;
        //echo $sql;
        $tabla =  "detalleventa";

        $tablaTienda = $prefijo . "tienda1";

        for ($i = 0; $i < sizeof($productos); $i++) {
            $item = $productos[$i];

            $sql = "INSERT INTO $tabla
                    (idventa, idproducto, cantidad, precio, puntos, total)
                    VALUES 
                    ($idVenta, " . $item["id"] . ", " . $item["cantidad"] . ", " . $item["precio"] . ", " . $item["totalp"] . ", " . $item["total"] . ")";

            $con->query($sql);

            $sql = "UPDATE $tablaTienda
                    SET cantidad = cantidad - " . $item["cantidad"] . "
                    WHERE idproducto = " . $item["id"];
                    
            $con->query($sql);
        }
        
        echo $idVenta;

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>