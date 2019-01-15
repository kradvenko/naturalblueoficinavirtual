<?php
    try
    {
        require_once('connection.php');
        
        $codigo = $_POST["codigo"];
        $idCategoria = $_POST["idCategoria"];
        $producto = $_POST["producto"];
        $precioDistribuidor = $_POST["precioDistribuidor"];
        $precioPublico = $_POST["precioPublico"];
        $iva = $_POST["iva"];
        $precioDistribuidorIva = $_POST["precioDistribuidorIva"];
        $valorNegocio = $_POST["valorNegocio"];
        $fechaCaptura = $_POST["fechaCaptura"];

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        if (!$producto) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $tabla = "productos";

        $sql = "INSERT INTO $tabla
                (codigo, idcategoria, producto, preciodistribuidor, preciopublico, iva, preciodistribuidoriva, valornegocio, estado, idusuariocaptura, fechacaptura)
                VALUES
                ('$codigo', $idCategoria, '$producto', '$precioDistribuidor', $precioPublico, $iva, $precioDistribuidorIva, $valorNegocio, 'ACTIVO', $idUsuario, '$fechaCaptura')";

        $con->query($sql);

        $idProducto = $con->insert_id;

        //Agregar el producto en cada almacén
        if ($idProducto > 0) {
            $sql = "SELECT *
                    FROM almacenes
                    WHERE estado = 'ACTIVO'";
            $result = $con->query($sql);

            while($row = $result->fetch_array()) {
                $tablaActual = $row["prefijo"] . $row["nombretabla"];
                if ($row["tipo"] == "1") {
                    $sqlAlmacen = "INSERT INTO $tablaActual
                                    (idproducto, cantidad, cantidadminima)
                                    VALUES
                                    ($idProducto, 0, 0)";
                    $con->query($sqlAlmacen);
                }
                if ($row["tipo"] == "2") {
                    $sqlAlmacen = "INSERT INTO $tablaActual
                                    (idproducto, cantidad)
                                    VALUES
                                    ($idProducto, 0)";
                    $con->query($sqlAlmacen);
                }
            }
        }
        //Agregar el producto en cada tienda
        if ($idProducto > 0) {
            $sql = "SELECT *
                    FROM tiendas
                    WHERE estado = 'ACTIVO'";
            $result = $con->query($sql);

            while($row = $result->fetch_array()) {
                $tablaActual = $row["prefijo"] . $row["nombretabla"];
                $sqlTienda = "INSERT INTO $tablaActual
                                (idproducto, cantidad)
                                VALUES
                                ($idProducto, 0)";
                $con->query($sqlTienda);
            }
        }

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>