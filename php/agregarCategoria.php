<?php
    try
    {
        require_once('connection.php');
        
        $categoria = $_POST["categoria"];
        $fechaCaptura = $_POST["fechaCaptura"];

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        if (!$categoria) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "INSERT INTO categorias
                (categoria, idusuariocaptura, fechacaptura, estado)
                VALUES
                ('$categoria', $idUsuario, '$fechaCaptura', 'ACTIVO')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>