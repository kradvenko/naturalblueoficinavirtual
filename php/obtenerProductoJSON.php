<?php    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $idTienda = $_COOKIE["nb_idtienda"];
        $prefijo = $_COOKIE["nb_prefijo"];
        $idUsuario = $_COOKIE["nb_idusuario"];

        $tablaProductos = $prefijo . "tienda1";

        $sql = "SELECT productos.*
                FROM productos
                INNER JOIN $tablaProductos
                ON tpc_tienda1.idproducto = productos.idproducto AND productos.producto Like '%$term%' AND $tablaProductos.cantidad > 0";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $item = array("id" => $row["idproducto"] , "value" => ($row["producto"]));
            array_push($data, $item);
        }
        
        echo json_encode($data);
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>