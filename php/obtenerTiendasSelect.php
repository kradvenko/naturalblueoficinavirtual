<?php
    try
    {

        $idSelect = $_POST["idSelect"];
        $estado = $_POST["estado"];

        if (!$idSelect) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        require_once('connection.php');

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        $tabla = "tiendas";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "SELECT *
                FROM $tabla
                WHERE prefijo = '$prefijo' And estado = '$estado'";

        $result = $con->query($sql);

        echo "<select class='form-control' id='" . $idSelect . "'>";

        while ($row = $result->fetch_array()) {
            echo "<option value='" . $row["idtienda"] . "'>" . $row["nombre"] . "</option>";
        }

        echo "</select>";
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>