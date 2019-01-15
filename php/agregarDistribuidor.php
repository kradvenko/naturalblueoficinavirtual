<?php
    try
    {
        require_once('connection.php');
        
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

        $sql = "INSERT INTO distribuidores
                (nombre, apellidopaterno, apellidomaterno, calle, numinterior, numexterior, entrecalles, colonia, ciudad, estado, codigopostal,
                telefonoparticular, telefonocelular, banco, clabe, email, rfc, dianacimiento, mesnacimiento, anonacimiento, curp, ine, beneficiario,
                fechacaptura, tieneusuario, status)
                VALUES
                ('$nombre', '$paterno', '$materno', '$calle', '$interior', '$exterior', '$entreCalles', '$colonia', '$ciudad', '$estado', '$codigoPostal',
                '$telefonoParticular', '$telefonoCelular', '$banco', '$clabe', '$email', '$rfc', '$diaNacimiento', '$mesNacimiento', '$anoNacimiento', '$curp', '$ine', '$beneficiario',
                '$fechaCaptura', '$tieneUsuario', 'ACTIVO')";

        $con->query($sql);

        $idDistribuidor = $con->insert_id;

        if ($patrocinador > 0) {
            $sql = "INSERT INTO relacion
                    (idpatrocinadororiginal, idpatrocinador, iddistribuidor, status)
                    VALUES
                    ($patrocinador, $patrocinador, $idDistribuidor, 'ACTIVO')";
            $con->query($sql);
        }

        if ($tieneUsuario == "SI") {
            $nombreCompleto = $nombre . " " . $paterno . " " . $materno;
            $sql = "INSERT INTO usuarios
                    (iddistribuidor, idtienda, nombre, usuario, pass, tipo, estado)
                    VALUES
                    ($idDistribuidor, 0, '$nombreCompleto', '$usuario', '$pass', 'DISTRIBUIDOR', 'ACTIVO')";
            $con->query($sql);
        }

        //echo "OK";
        echo $idDistribuidor;

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>