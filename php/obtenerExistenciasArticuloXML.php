<?php
    try
    {
        require_once('connection.php');

        $idProducto = $_POST["idProducto"];
        $tipoInventario = $_POST["tipoInventario"];

        if (!$idProducto) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        if ($tipoInventario == "ALMACEN1") {
            $tabla = $prefijo . "almacen1";
            $sql = "Select *
                    From $tabla
                    Where idproducto = $idProducto";
            $result = $con->query($sql);

            header("Content-Type: text/xml");	
            echo "<resultado>\n";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    echo "<respuesta>OK</respuesta>\n";
                    echo "<idproducto>" . $row['idproducto'] . "</idproducto>\n";
                    echo "<cantidad>" . $row['cantidad'] . "</cantidad>\n";
                    echo "<cantidadMinima>" . $row['cantidadminima'] . "</cantidadMinima>\n";
                }
            } else {
                echo "<respuesta>SIN REGISTRO</respuesta>\n";
            }
            echo "</resultado>\n";
        } elseif ($tipoInventario == "ALMACEN2") {
            $tabla = $prefijo . "almacen2";
            $sql = "Select *
                    From $tabla
                    Where idproducto = $idProducto";
            $result = $con->query($sql);

            header("Content-Type: text/xml");	
            echo "<resultado>\n";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    echo "<respuesta>OK</respuesta>\n";
                    echo "<idproducto>" . $row['idproducto'] . "</idproducto>\n";
                    echo "<cantidad>" . $row['cantidad'] . "</cantidad>\n";
                }
            } else {
                echo "<respuesta>SIN REGISTRO</respuesta>\n";
            }
            echo "</resultado>\n";
        } elseif ($tipoInventario == "TIENDA") {
            $tabla = $prefijo . "tienda1";
            $sql = "Select *
                    From $tabla
                    Where idproducto = $idProducto";
            $result = $con->query($sql);

            header("Content-Type: text/xml");	
            echo "<resultado>\n";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    echo "<respuesta>OK</respuesta>\n";
                    echo "<idproducto>" . $row['idproducto'] . "</idproducto>\n";
                    echo "<cantidad>" . $row['cantidad'] . "</cantidad>\n";
                }
            } else {
                echo "<respuesta>SIN REGISTRO</respuesta>\n";
            }
            echo "</resultado>\n";
        }

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?> 