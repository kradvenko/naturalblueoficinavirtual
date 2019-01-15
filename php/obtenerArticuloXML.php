<?php
    try
    {
        require_once('connection.php');

        $idProducto = $_POST["idProducto"];
        $estado = $_POST["estado"];

        if (!$idProducto) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        $tabla = "productos";

        $sql = "Select *
                From $tabla
                Inner Join categorias
                On categorias.idcategoria = $tabla.idcategoria
                Where idproducto = $idProducto And $tabla.estado Like '$estado'";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<respuesta>OK</respuesta>\n";
            echo "<idproducto>" . $row['idproducto'] . "</idproducto>\n";
            echo "<codigo>" . $row['codigo'] . "</codigo>\n";
            echo "<idcategoria>" . $row['idcategoria'] . "</idcategoria>\n";
            echo "<categoria>" . $row['categoria'] . "</categoria>\n";
            echo "<producto>" . $row['producto'] . "</producto>\n";
            echo "<preciodistribuidor>" . $row['preciodistribuidor'] . "</preciodistribuidor>\n";
            echo "<iva>" . $row['iva'] . "</iva>\n";
            echo "<preciodistribuidoriva>" . $row['preciodistribuidoriva'] . "</preciodistribuidoriva>\n";
            echo "<preciopublico>" . $row['preciopublico'] . "</preciopublico>\n";
            echo "<valornegocio>" . $row['valornegocio'] . "</valornegocio>\n";
            echo "<estado>" . $row['estado'] . "</estado>\n";
            echo "<idusuariocaptura>" . $row['idusuariocaptura'] . "</idusuariocaptura>\n";
            echo "<fechacaptura>" . $row['fechacaptura'] . "</fechacaptura>\n";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?> 