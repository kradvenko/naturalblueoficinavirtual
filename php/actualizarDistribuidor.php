<?php
    try
    {
        require_once('connection.php');

        $idDistribuidor = $_POST["idDistribuidor"];
        $nombre = $_POST["nombre"];
        $paterno = $_POST["paterno"];
        $materno = $_POST["materno"];
        $calle = $_POST["calle"];
        $interior = $_POST["interior"];
        $exterior = $_POST["exterior"];
        $entreCalles = $_POST["entreCalles"];
        $colonia = $_POST["colonia"];
        $ciudad = $_POST["ciudad"];
        $estado = $_POST["estado"];
        $codigoPostal = $_POST["codigoPostal"];
        $telefonoParticular = $_POST["telefonoParticular"];
        $telefonoCelular = $_POST["telefonoCelular"];
        $banco = $_POST["banco"];
        $clabe = $_POST["clabe"];
        $email = $_POST["email"];
        $rfc = $_POST["rfc"];
        $diaNacimiento = $_POST["diaNacimiento"];
        $mesNacimiento = $_POST["mesNacimiento"];
        $anoNacimiento = $_POST["anoNacimiento"];
        $curp = $_POST["curp"];
        $ine = $_POST["ine"];
        $beneficiario = $_POST["beneficiario"];
        $fechaCaptura = $_POST["fechaCaptura"];
        $tieneUsuario = $_POST["tieneUsuario"];
        $usuario = $_POST["usuario"];
        $pass = $_POST["pass"];
        $patrocinador = $_POST["patrocinador"];

        $idUsuario = $_COOKIE["nb_idusuario"];

        if (!$nombre) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "UPDATE distribuidores
                SET nombre = '$nombre', apellidopaterno = '$paterno', apellidomaterno = '$materno', calle = '$calle', numinterior = '$interior', numexterior = '$exterior',
                entrecalles = '$entreCalles', colonia = '$colonia', ciudad = '$ciudad', estado = '$estado', codigopostal = '$codigoPostal', telefonoparticular = '$telefonoParticular',
                telefonocelular = '$telefonoCelular', banco = '$banco', clabe = '$clabe', email = '$email', rfc = '$rfc', dianacimiento = '$diaNacimiento', mesnacimiento = '$mesNacimiento',
                anonacimiento = '$anoNacimiento', curp = '$curp', ine = '$ine', beneficiario = '$beneficiario', tieneusuario = '$tieneUsuario' 
                WHERE iddistribuidor = $idDistribuidor";

        $con->query($sql);

        if ($patrocinador > 0) {
            $sql = "SELECT *
                    FROM relacion
                    WHERE iddistribuidor = $idDistribuidor";

            $result = $con->query($sql);

            if ($result->num_rows) {
                $row = $result->fetch_array();
                if ($row["idpatrocinador"] != $patrocinador) {
                    $sql = "UPDATE relacion
                            SET idpatrocinador = $patrocinador
                            WHERE iddistribuidor = $idDistribuidor";

                    $con->query($sql);
                }                
            } else {
                $sql = "INSERT INTO relacion
                    (idpatrocinadororiginal, idpatrocinador, iddistribuidor, status)
                    VALUES
                    ($patrocinador, $patrocinador, $idDistribuidor, 'ACTIVO')";

                $con->query($sql);
            }        
        }

        if ($tieneUsuario == "SI") {
            $sql = "SELECT *
                    FROM usuarios
                    WHERE iddistribuidor = $idDistribuidor";

            $result = $con->query($sql);

            if ($con->field_count) {
                $nombreCompleto = $nombre . " " . $paterno . " " . $materno;
                $sql = "UPDATE usuarios
                        SET nombre = '$nombreCompleto', usuario = '$usuario', pass = '$pass'
                        WHERE iddistribuidor = $idDistribuidor";
                $con->query($sql);
            } else {
                $nombreCompleto = $nombre . " " . $paterno . " " . $materno;
                $sql = "INSERT INTO usuarios
                        (iddistribuidor, idtienda, nombre, usuario, pass, tipo, estado)
                        VALUES
                        ($idDistribuidor, 0, '$nombreCompleto', '$usuario', '$pass', 'DISTRIBUIDOR', 'ACTIVO')";
                $con->query($sql);
            }
        }

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>