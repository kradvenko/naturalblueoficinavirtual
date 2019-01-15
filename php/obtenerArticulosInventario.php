<?php
    try
    {
        require_once('connection.php');

        $idCategoria = $_POST["idCategoria"];
        $estado = $_POST["estado"];
        $tipoInventario = $_POST["tipoInventario"];

        if (!$idCategoria) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        $tabla = "productos";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "SELECT *
                FROM $tabla
                WHERE idcategoria Like '$idCategoria' And estado Like '$estado'";

        $result = $con->query($sql);

        if ($tipoInventario == "PRODUCTOS") {
            echo "<div class='col-1 divHeaderLista'>";
            echo "Código";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Producto";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Precio Distribuidor sin IVA";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "IVA";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Precio distribuidor con IVA";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "Precio público";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "Valor Negocio";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "";
            echo "</div>";
            while ($row = $result->fetch_array()) {
                echo "<div class='col-1 divMargin'>";
                echo $row["codigo"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo $row["producto"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo "$ " . $row["preciodistribuidor"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo "$ " . $row["iva"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo "$ " . $row["preciodistribuidoriva"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo "$ " . $row["preciopublico"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo $row["valornegocio"] . " PTS.";
                echo "</div>";
                echo "<div class='col-2 divMargin'>";
                echo "<input type='button' class='btn btn-info' value='Modificar' onclick='obtenerDatosArticulo(" . $row["idproducto"] . ")' />";
                echo "</div>";
            }
        } elseif ($tipoInventario == "ALMACEN1" || $tipoInventario == "ALMACEN2") {
            echo "<div class='col-1 divHeaderLista'>";
            echo "Código";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Producto";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Precio Distribuidor sin IVA";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "IVA";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Precio distribuidor con IVA";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "Precio público";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "Valor Negocio";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "";
            echo "</div>";
            while ($row = $result->fetch_array()) {
                echo "<div class='col-1 divMargin'>";
                echo $row["codigo"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo $row["producto"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo "$ " . $row["preciodistribuidor"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo "$ " . $row["iva"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo "$ " . $row["preciodistribuidoriva"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo "$ " . $row["preciopublico"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo $row["valornegocio"] . " PTS.";
                echo "</div>";
                echo "<div class='col-2 divMargin'>";
                echo "<input type='button' class='btn btn-info' value='Existencias' onclick='obtenerExistenciasArticulo(" . $row["idproducto"] . ")' />";
                echo "</div>";
            }
        } elseif ($tipoInventario == "TIENDA") {
            echo "<div class='col-1 divHeaderLista'>";
            echo "Código";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Producto";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Precio Distribuidor sin IVA";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "IVA";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "Precio distribuidor con IVA";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "Precio público";
            echo "</div>";
            echo "<div class='col-1 divHeaderLista'>";
            echo "Valor Negocio";
            echo "</div>";
            echo "<div class='col-2 divHeaderLista'>";
            echo "";
            echo "</div>";
            while ($row = $result->fetch_array()) {
                echo "<div class='col-1 divMargin'>";
                echo $row["codigo"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo $row["producto"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo "$ " . $row["preciodistribuidor"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo "$ " . $row["iva"];
                echo "</div>";
                echo "<div class='col-2'>";
                echo "$ " . $row["preciodistribuidoriva"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo "$ " . $row["preciopublico"];
                echo "</div>";
                echo "<div class='col-1'>";
                echo $row["valornegocio"] . " PTS.";
                echo "</div>";
                echo "<div class='col-2 divMargin'>";
                echo "<input type='button' class='btn btn-info' value='Existencias' onclick='obtenerExistenciasArticulo(" . $row["idproducto"] . ")' />";
                echo "</div>";
            }
        }
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>