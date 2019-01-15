<?php    
    function menu() {
        $menu = '';
        if ($_COOKIE["nbov_tipo"] == 'DISTRIBUIDOR') {
            $menu = '
            <div class="row divMargin">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-4">
                        Usuario actual :  ' . $_COOKIE["nbov_nombre"] . ' 
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary btn-danger" onclick="cerrarSesion()">Cerrar sesión</button> 
                    </div>
                </div>
            <div class="mainMenu">
                <div class="dropdown">
                    <a href="menu.php" id="aMenu" class="mainMenuElement">Inicio</a>
                </div>
                <div class="dropdown">
                    <a href="" id="aRed" class="mainMenuElement">Red</a>
                    <div class="dropdown-content">
                        <a href="ov_red.php">Red completa</a>
                        <a href="ov_redpuntos.php">Puntos del periodo</a>
                    </div>
                </div>                
            </div>
            ';
        }
        return $menu;
    }
?>