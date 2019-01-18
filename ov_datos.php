<!DOCTYPE html>

<html>
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/naturalblue.css" />
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/naturalblue.js"></script>

    <title>Natural blue - Oficina Virtual</title>
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
        $("#aDatos").addClass("currentPage");
    });
</script>
</html>