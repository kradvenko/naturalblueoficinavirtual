<?php
    try
    {
        require_once('connection.php');
        
        $idProducto = $_POST["idProducto"];
        $codigo = $_POST["codigo"];
        $idCategoria = $_POST["idCategoria"];
        $producto = $_POST["producto"];
        $precioDistribuidor = $_POST["precioDistribuidor"];
        $precioPublico = $_POST["precioPublico"];
        $iva = $_POST["iva"];
        $precioDistribuidorIva = $_POST["precioDistribuidorIva"];
        $valorNegocio = $_POST["valorNegocio"];

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        if (!$producto) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $tabla = "productos";

        $sql = "UPDATE $tabla
                SET codigo = '$codigo', idcategoria = $idCategoria, producto = '$producto', preciodistribuidor = $precioDistribuidor,
                preciopublico = $precioPublico, iva = $iva, preciodistribuidoriva = $precioDistribuidorIva, valornegocio = $valorNegocio
                WHERE idproducto = $idProducto";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>