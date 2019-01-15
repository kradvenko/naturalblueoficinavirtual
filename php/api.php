<?php

    function obtenerPuntosAcumuladosPeridor($mes, $anio, $idDistribuidor) {
        try
        {
            require('connection.php');

            $con = new mysqli($hn, $un, $pw, $db);

            $sql = "Select Sum(totalpuntos) As TotalPuntos
                    From ventas
                    Inner Join distribuidores
                    On distribuidores.iddistribuidor = ventas.iddistribuidor
                    Where fecha Like '%$mes/$anio%' And distribuidores.iddistribuidor = $idDistribuidor";

            $result = $con->query($sql);

            $row = $result->fetch_array();

            return $row["TotalPuntos"];
            //return $sql;

            mysqli_close($con);
        }
        catch (Throwable $t)
        {
            echo $t;
        }
    }

?>