<?php    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $sql = "SELECT *
                FROM distribuidores
                WHERE nombre Like '%$term%' Or apellidopaterno Like '%$term%' Or apellidomaterno Like '%$term%'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $item = array("id" => $row["iddistribuidor"] , "value" => ($row["iddistribuidor"] . " - " . $row["nombre"] . " " . $row["apellidopaterno"] . " " . $row["apellidomaterno"]));
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