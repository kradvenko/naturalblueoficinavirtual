<!DOCTYPE html>

<html>
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/naturalblue.css" />
<link rel="stylesheet" type="text/css" href="css/slider.css" />
<link rel="stylesheet" type="text/css" href="css/red.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.min.css" />
<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/naturalblue.js"></script>
<script src="js/ov_red.js"></script>

    <title>Natural blue - Oficina Virtual: Red</title>
</head>
<body>
    <div class="container mainContainer">
        <div class="row divLogo">
            <img src="imgs/logo_small.png" />
        </div>
        <div class="">
            <div class="menuContainer">
                <?php
                    require_once('php/loadMenu.php');
                    echo menu();
                ?>
            </div>
        </div>

        <div class="row divMargin">
            <div class="col-3">
                Búsqueda
            </div>
            <div class="col-9">
                <input type="text" class="form-control" id="tbBuscar" placeholder="Nombre del distribuidor" />
            </div>
        </div>

        <div class="row divMargin">
            <div class="col-12" id="divDistribuidor">

            </div>
        </div>

        <div class="row" id="divRed">
            
        </div>
        
        <div class="row divBackgroundOne">
            <div class="col-12 mainFooter">
                <b>Natural Blue</b> © Derechos Reservados 2018.
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        checkSession();
        $("#aMenu").addClass("currentPage");
    });
    $(function() {     
        $("#tbBuscar").autocomplete({
            source: "php/obtenerDistribuidoresJSON.php",
            minLength: 2,
            select: function(event, ui) {
                elegirDistribuidor(ui.item.id, ui.item.value);
                this.value = '';
                return false;
            }
        });
    });
</script>
</html>