<?php
    try
    {

        $idDistribuidor = $_POST["idDistribuidor"];        

        if (!$idDistribuidor) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        require('connection.php');

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "SELECT *
                FROM distribuidores
                WHERE iddistribuidor = " . $idDistribuidor;

        $result = $con->query($sql);
        
        while ($row = $result->fetch_array()) {
            echo "<div class='col-12 divRedMainHeader'>";
            echo $row["iddistribuidor"] . " - " . $row["nombre"] . " " . $row["apellidopaterno"] . " " . $row["apellidomaterno"];
            echo"</div>";
        }

        $sql = "SELECT *
                FROM distribuidores
                INNER JOIN relacion
                ON relacion.iddistribuidor = distribuidores.iddistribuidor
                WHERE relacion.idpatrocinador = $idDistribuidor";

        $result = $con->query($sql);

        //echo $sql;
        $total = 0;

        echo "<table style='width: 100%'>";

        echo "<tr class='divRedMainSubHeader'>";

        echo "<th style='width: 5%'>";
        echo "Clave";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "Upline";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "Sponsor";
        echo "</th>";

        echo "<th style='width: 45%'>";
        echo "Nombre";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "Rango";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "Ingreso";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "P. Puntos";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "G. Puntos";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "P. Negocio";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "G. Negocio";
        echo "</th>";

        echo "<th style='width: 5%'>";
        echo "Bonificación";
        echo "</th>";

        echo "</tr>";

        while ($row = $result->fetch_array()) {
            echo "<tr class='divRedLevel-1'>";

            echo "<th>";
            echo $row["iddistribuidor"];
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo $row["idpatrocinador"];
            echo "</th>";

            echo "<th>";
            echo "  ·  " . $row["nombre"] . " " . $row["apellidopaterno"] . " " . $row["apellidomaterno"];
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";
            
            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "<th>";
            echo "-";
            echo "</th>";

            echo "</tr>";

            echo obtenerPatrocinadores($row["iddistribuidor"], 2, $total);
            
            $total = $total + 1;
            $sql2 = "SELECT COUNT(*) AS C
                    FROM relacion
                    WHERE idpatrocinador = " . $row["iddistribuidor"];

            $count = $con->query($sql2);
            $row2 = $count->fetch_array();
            //echo " - Patrocinador de " . $row2["C"] . " distribuidores. <br />";
        }

        echo "</table>";

        echo "<div class='col-12 divRedHighlight1'>El distribuidor es patrocinador de " . $total . " distribuidores.</div>";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }

    function obtenerPatrocinadores($idDistribuidor, $nivel, &$total) {

        require('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "SELECT *
                FROM distribuidores
                INNER JOIN relacion
                ON relacion.iddistribuidor = distribuidores.iddistribuidor
                WHERE relacion.idpatrocinador = $idDistribuidor";

        $result = $con->query($sql);

        $html = "";
        $nivelTexto = "";

        for($i = 1; $i <= $nivel; $i++) {
            $nivelTexto = $nivelTexto . "   ·   ";
        }

        while ($row = $result->fetch_array()) {
            $html = $html . "<tr class='divRedLevel-" . $nivel . "'>";

            $html = $html . "<th>";
            $html = $html . $row["iddistribuidor"];
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . $row["idpatrocinador"];
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . $nivelTexto . $row["nombre"] . " " . $row["apellidopaterno"] . " " . $row["apellidomaterno"];
            //$html = $html . $sql;
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";
            
            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";
            
            $html = $html . "<th>";
            $html = $html . "-";
            $html = $html . "</th>";

            $html = $html . "</tr>";

            obtenerPatrocinadores($row["iddistribuidor"], $nivel + 1, $total);

            $total = $total + 1;
            /*
            $total = $total + 1;
            $sql2 = "SELECT COUNT(*) AS C
                    FROM relacion
                    WHERE idpatrocinador = " . $row["iddistribuidor"];

            $count = $con->query($sql2);
            $row2 = $count->fetch_array();*/
            //echo " - Patrocinador de " . $row2["C"] . " distribuidores. <br />";
        }

        return $html;

    }
?>