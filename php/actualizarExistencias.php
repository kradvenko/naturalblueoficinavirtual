<?php
    try
    {
        require_once('connection.php');

        $idProducto = $_POST["idProducto"];
        $tipoInventario = $_POST["tipoInventario"];
        $cantidad = $_POST["cantidad"];
        if ($tipoInventario == 'ALMACEN1') {
            $cantidadMinima = $_POST["cantidadMinima"];
        }

        $idUsuario = $_COOKIE["nb_idusuario"];
        $prefijo = $_COOKIE["nb_prefijo"];

        if (!$idProducto) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        if ($tipoInventario == "ALMACEN1") {
            $tabla = $prefijo . "almacen1";
            $sql = "UPDATE $tabla
                    SET cantidad = $cantidad, cantidadminima = $cantidadMinima
                    WHERE idproducto = $idProducto";

            $con->query($sql);
        } elseif ($tipoInventario == "ALMACEN2") {
            $tabla = $prefijo . "almacen2";
            $sql = "UPDATE $tabla
                    SET cantidad = $cantidad
                    WHERE idproducto = $idProducto";

            $con->query($sql);
        } elseif ($tipoInventario == "TIENDA") {
            $tabla = $prefijo . "tienda1";
            $sql = "UPDATE $tabla
                    SET cantidad = $cantidad
                    WHERE idproducto = $idProducto";

            $con->query($sql);
        }

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>