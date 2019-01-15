<?php
    try
    {
        require_once('connection.php');

        $fecha = $_POST["fecha"];

        $prefijo = $_COOKIE["v_prefijo"];
        $tablaVentas = "ventas";
        $tablaArticulos = "productos";
        $tablaDetalleVenta = "detalleventa";

        $con = new mysqli($hn, $un, $pw, $db);

        $totalEfectivo = 0;
        $totalTarjeta = 0;
        $totalVentas = 0;

        $sql = "Select $tablaVentas.*, $tablaDetalleVenta.*, $tablaArticulos.producto As articulo
                From $tablaVentas
                Inner Join $tablaDetalleVenta
                On $tablaDetalleVenta.idventa = $tablaVentas.idventa
                Inner Join $tablaArticulos
                On $tablaArticulos.idproducto = $tablaDetalleVenta.idproducto
                Where fecha Like '$fecha'";

        $result = $con->query($sql);

        echo "<div class='col-1 divHeaderListaVentas'>";
        echo "Venta";
        echo "</div>";
        echo "<div class='col-3 divHeaderListaVentas'>";
        echo "Fecha";
        echo "</div>";
        echo "<div class='col-3 divHeaderListaVentas'>";
        echo "Artículo";
        echo "</div>";
        echo "<div class='col-1 divHeaderListaVentas'>";
        echo "Cantidad";
        echo "</div>";
        echo "<div class='col-1 divHeaderListaVentas'>";
        echo "Total";
        echo "</div>";
        echo "<div class='col-2 divHeaderListaVentas'>";
        echo "Tipo";
        echo "</div>";
        echo "<div class='col-1 divHeaderListaVentas'>";
        echo "";
        echo "</div>";

        while ($row = $result->fetch_array()) {
            echo "<div class='col-1'>";
            echo $row["idventa"];
            echo "</div>";
            echo "<div class='col-3'>";
            echo $row["fecha"];
            echo "</div>";
            echo "<div class='col-3'>";
            echo $row["articulo"];
            echo "</div>";
            echo "<div class='col-1'>";
            echo $row["cantidad"];
            echo "</div>";
            echo "<div class='col-1'>";
            echo $row["total"];
            echo "</div>";
            echo "<div class='col-2'>";
            echo $row["tipo"];
            echo "</div>";
            echo "<div class='col-1'>";
            echo "</div>";

            echo "<div class='col-12 divMargin'>";
            echo "</div>";

            if ($row["tipo"] == "EFECTIVO") {
                $totalEfectivo = $totalEfectivo + $row["total"];
            } else if ($row["tipo"] == "TARJETA") {
                $totalTarjeta = $totalTarjeta + $row["total"];
            }
        }
        $totalVentas = $totalEfectivo + $totalTarjeta;
        echo "<div class='col-12 divHeaderListaVentas'>";
        echo "</div>";
        echo "<div class='col-3 divTotales'>";
        echo "Total de ventas en efectivo";
        echo "</div>";
        echo "<div class='col-1'";
        echo "<label id='lblVentaEfectivo'>";
        echo $totalEfectivo;
        echo "</label>";
        echo "</div>";
        echo "<div class='col-3 divTotales'>";
        echo "Total de ventas tarjeta";
        echo "</div>";
        echo "<div class='col-1'";
        echo "<label id='lvlVentaTarjeta'>";
        echo $totalTarjeta;
        echo "</label>";
        echo "</div>";
        echo "<div class='col-3 divTotales'>";
        echo "Total de ventas";
        echo "</div>";
        echo "<div class='col-1'";
        echo "<label id='lvlVentaTarjeta'>";
        echo $totalVentas;
        echo "</label>";
        echo "</div>";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>