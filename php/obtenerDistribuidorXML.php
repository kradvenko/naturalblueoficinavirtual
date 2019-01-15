<?php
    try
    {
        require_once('connection.php');

        $idDistribuidor = $_POST["idDistribuidor"];

        if (!$idDistribuidor) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "SELECT *
                From distribuidores
                WHERE iddistribuidor = $idDistribuidor";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<respuesta>OK</respuesta>\n";
            echo "<iddistribuidor>" . $row['iddistribuidor'] . "</iddistribuidor>\n";
            echo "<nombre>" . $row['nombre'] . "</nombre>\n";
            echo "<apellidopaterno>" . $row['apellidopaterno'] . "</apellidopaterno>\n";
            echo "<apellidomaterno>" . $row['apellidomaterno'] . "</apellidomaterno>\n";
            echo "<calle>" . $row['calle'] . "</calle>\n";
            echo "<numinterior>" . $row['numinterior'] . "</numinterior>\n";
            echo "<numexterior>" . $row['numexterior'] . "</numexterior>\n";
            echo "<entrecalles>" . $row['entrecalles'] . "</entrecalles>\n";
            echo "<colonia>" . $row['colonia'] . "</colonia>\n";
            echo "<ciudad>" . $row['ciudad'] . "</ciudad>\n";
            echo "<estado>" . $row['estado'] . "</estado>\n";
            echo "<codigopostal>" . $row['codigopostal'] . "</codigopostal>\n";
            echo "<telefonoparticular>" . $row['telefonoparticular'] . "</telefonoparticular>\n";
            echo "<telefonocelular>" . $row['telefonocelular'] . "</telefonocelular>\n";
            echo "<banco>" . $row['banco'] . "</banco>\n";
            echo "<clabe>" . $row['clabe'] . "</clabe>\n";
            echo "<email>" . $row['email'] . "</email>\n";
            echo "<rfc>" . $row['rfc'] . "</rfc>\n";
            echo "<dianacimiento>" . $row['dianacimiento'] . "</dianacimiento>\n";
            echo "<mesnacimiento>" . $row['mesnacimiento'] . "</mesnacimiento>\n";
            echo "<anonacimiento>" . $row['anonacimiento'] . "</anonacimiento>\n";
            echo "<curp>" . $row['curp'] . "</curp>\n";
            echo "<ine>" . $row['ine'] . "</ine>\n";
            echo "<beneficiario>" . $row['beneficiario'] . "</beneficiario>\n";
            echo "<fechacaptura>" . $row['fechacaptura'] . "</fechacaptura>\n";
            echo "<tieneusuario>" . $row['tieneusuario'] . "</tieneusuario>\n";
            echo "<status>" . $row['status'] . "</status>\n";

            $sql = "SELECT distribuidores.*
                    FROM relacion
                    INNER JOIN distribuidores
                    ON distribuidores.iddistribuidor = relacion.idpatrocinador
                    WHERE relacion.iddistribuidor = $idDistribuidor";
            
            $resultu = $con->query($sql);
            while ($rowu = $resultu->fetch_array()) {
                echo "<idpatrocinador>" . $rowu['iddistribuidor'] . "</idpatrocinador>\n";
                echo "<patrocinador>" . $rowu['nombre'] . " " . $rowu['apellidopaterno'] . " " . $rowu['apellidomaterno'] . "</patrocinador>\n";
            }

            if ($row["tieneusuario"] == "SI") {
                $sql = "SELECT usuarios.*
                    FROM usuarios
                    WHERE iddistribuidor = $idDistribuidor";

                $resultu = $con->query($sql);
                while ($rowu = $resultu->fetch_array()) {
                    echo "<usuario>" . $rowu['usuario'] . "</usuario>\n";
                    echo "<pass>" . $rowu['pass'] . "</pass>\n";
                }
            }
            
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?> 