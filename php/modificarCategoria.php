<?php
    try
    {
        require_once('connection.php');
        
        $idCategoria = $_POST["idCategoria"];
        $nuevoNombre = $_POST["nuevoNombre"];

        $idTienda = $_COOKIE["v_idtienda"];
        $prefijo = $_COOKIE["v_prefijo"];
        $idUsuario = $_COOKIE["v_idusuario"];

        if (!$idCategoria) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "UPDATE categorias
                SET categoria = '$nuevoNombre'
                WHERE idcategoria = $idCategoria";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>