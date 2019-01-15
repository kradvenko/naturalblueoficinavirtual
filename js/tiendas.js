//Variables para el módulo de tiendas

//Funciones para el módulo de tiendas
function obtenerCategoriasSelect() {
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategorias', estado: 'ACTIVO' }, success: function(res) {
        $("#divCategorias").html(res);
        $("#selCategorias").change(obtenerArticulosInventarioTienda);
    }});
}

function obtenerTiendas() {
    $.ajax({url: "php/obtenerTiendasSelect.php", async: false, type: "POST", data: { idSelect: 'selTiendas', estado: 'ACTIVO' }, success: function(res) {
        $("#divTiendas").html(res);
        $("#selCategorias").change(obtenerArticulosInventarioTienda);
    }});
}

function obtenerArticulosInventarioTienda() {
    var idCategoria = $("#selCategorias").val();
    if (idCategoria == null) {
        return;
    }
    $.ajax({url: "php/obtenerArticulosInventario.php", async: false, type: "POST", data: { idCategoria: idCategoria, estado: '%', tipoInventario: 'TIENDA' }, success: function(res) {
        $("#divArticulosInventario").html(res);
    }});
}

function obtenerExistenciasArticulo(id) {
    a2_IdProducto = id;
    $('#modalExistencias').modal('show');
    $.ajax({url: "php/obtenerExistenciasArticuloXML.php", async: false, type: "POST", data: { idProducto: id, tipoInventario: 'TIENDA' }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            if ($(this).find("respuesta").text() == "OK") {
                $("#tbExistenciaTienda").val($(this).find("cantidad").text());
                $("#divSinRegistro").html("");
            } else if ($(this).find("respuesta").text() == "SIN REGISTRO") {
                $("#tbExistenciaTienda").val("No se ha registrado este producto.");
                //$("#divSinRegistro").html("<input type='button' class='btn btn-info' value='Registrar producto' onclick='registrarProducto(" + id + ")' />");
            }
        });
    }});
}

function limpiarCamposExistencias() {
    $("#tbExistenciaTienda").val("0");
    $("#divSinRegistro").html("");
}

function guardarExistencias() {
    var cantidad;
    var cantidadMinima;

    cantidad = $("#tbExistenciaTienda").val();
    if (isNaN(cantidad)) {
        alert("No ha ingresado una cantidad válida.");
        $("#tbExistenciaTienda").focus();
        return;
    }
    $.ajax({url: "php/actualizarExistencias.php", async: false, type: "POST", data: { idProducto: a2_IdProducto, tipoInventario: 'TIENDA', cantidad: cantidad,
    cantidadMinima: cantidadMinima }, success: function(res) {
        if (res == "OK") {
            alert("Se ha actualizado la cantidad.");
            limpiarCamposExistencias();
            $('#modalExistencias').modal('hide');
        } else {
            alert(res);
        }
    }});
}