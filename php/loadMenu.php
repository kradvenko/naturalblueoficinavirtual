<?php    
    function menu() {
        $menu = '';
        if ($_COOKIE["nb_tipo"] == 'ADMINISTRADOR') {
            $menu = '
            <div class="row divMargin">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-4">
                        Usuario actual :  ' . $_COOKIE["nb_nombre"] . ' 
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
                    <a href="" id="aVentas" class="mainMenuElement">Ventas</a>
                    <div class="dropdown-content">
                        <a href="nuevaventa.php">Nueva</a>
                        <a href="corte.php">Corte</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="" id="aDistribuidores" class="mainMenuElement">Distribuidores</a>
                    <div class="dropdown-content">
                        <a href="nuevodistribuidor.php">Nuevo</a>
                        <a href="modificardistribuidor.php">Modificar</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="" id="aInventarios" class="mainMenuElement">Inventario</a>
                    <div class="dropdown-content">
                        <a href="productos.php">Productos</a>
                        <a href="almacen1.php">Almacén 1</a>
                        <a href="almacen2.php">Almacén 2</a>
                        <a href="tiendas.php">Tiendas</a>
                    </div>
                </div>
            </div>
            ';
        } else if ($_COOKIE["nb_tipo"] == 'TIENDA') {
            $menu = '
            <div class="row divMargin">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-4">
                        Usuario actual :  ' . $_COOKIE["nb_nombre"] . ' 
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
                    <a href="" id="aVentas" class="mainMenuElement">Ventas</a>
                    <div class="dropdown-content">
                        <a href="nuevaventa.php">Nueva</a>
                        <a href="corte.php">Corte</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="" id="aDistribuidores" class="mainMenuElement">Distribuidores</a>
                    <div class="dropdown-content">
                        <a href="nuevodistribuidor.php">Nuevo</a>
                        <a href="modificardistribuidor.php">Modificar</a>
                    </div>
                </div>                
            </div>
            ';
        }
        return $menu;
    }
?>