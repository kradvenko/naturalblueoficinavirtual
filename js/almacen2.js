//Variables para el módulo del almacén 2
a2_IdProducto = 0;
//Funciones para el módulo del almacén 2
function obtenerCategoriasSelect() {
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategorias', estado: 'ACTIVO' }, success: function(res) {
        $("#divCategorias").html(res);
        $("#selCategorias").change(obtenerArticulosInventario);
    }});
}

function obtenerCategoriasSelect() {
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategorias', estado: 'ACTIVO' }, success: function(res) {
        $("#divCategorias").html(res);
        $("#selCategorias").change(obtenerArticulosInventarioAlmacen2);
    }});
}

function obtenerArticulosInventarioAlmacen2() {
    var idCategoria = $("#selCategorias").val();
    if (idCategoria == null) {
        return;
    }
    $.ajax({url: "php/obtenerArticulosInventario.php", async: false, type: "POST", data: { idCategoria: idCategoria, estado: '%', tipoInventario: 'ALMACEN2' }, success: function(res) {
        $("#divArticulosInventario").html(res);
    }});
}

function obtenerExistenciasArticulo(id) {
    a2_IdProducto = id;
    $('#modalExistencias').modal('show');
    $.ajax({url: "php/obtenerExistenciasArticuloXML.php", async: false, type: "POST", data: { idProducto: id, tipoInventario: 'ALMACEN2' }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            if ($(this).find("respuesta").text() == "OK") {
                $("#tbExistenciaAlmacen2").val($(this).find("cantidad").text());
                //$("#tbCantidadMinima").val($(this).find("cantidadMinima").text());
                $("#divSinRegistro").html("");
            } else if ($(this).find("respuesta").text() == "SIN REGISTRO") {
                $("#tbExistenciaAlmacen2").val("No se ha registrado este producto.");
                $("#divSinRegistro").html("<input type='button' class='btn btn-info' value='Registrar producto' onclick='registrarProducto(" + id + ")' />");
            }
        });
    }});
}

function limpiarCamposExistencias() {
    $("#tbExistenciaAlmacen2").val("0");
    //$("#tbCantidadMinima").val("0");
    $("#divSinRegistro").html("");
}

function registrarProducto(id) {
    $.ajax({url: "php/registrarProducto.php", async: false, type: "POST", data: { idProducto: id }, success: function(res) {
        if (res == "OK") {
            alert("Se ha registrado el producto en los almacenes y tiendas.");
        }
    }});
    $.ajax({url: "php/obtenerExistenciasArticuloXML.php", async: false, type: "POST", data: { idProducto: id }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            if ($(this).find("respuesta").text() == "OK") {
                $("#tbExistenciaAlmacen2").val($(this).find("cantidad").text());
                $("#divSinRegistro").html("");
            } else if ($(this).find("respuesta").text() == "SIN REGISTRO") {
                $("#tbExistenciaAlmacen2").val("No se ha registrado este producto.");
                $("#divSinRegistro").html("<input type='button' class='btn btn-info' value='Registrar producto' onclick='registrarProducto(" + id + ")' />");
            }
        });
    }});
}

function guardarExistencias() {
    var cantidad;
    var cantidadMinima;

    cantidad = $("#tbExistenciaAlmacen2").val();
    if (isNaN(cantidad)) {
        alert("No ha ingresado una cantidad válida.");
        $("#tbExistenciaAlmacen2").focus();
        return;
    }
    /*
    cantidadMinima = $("#tbCantidadMinima").val();
    if (isNaN(cantidadMinima)) {
        alert("No ha ingresado una cantidad válida.");
        $("#tbCantidadMinima").focus();
        return;
    }*/
    $.ajax({url: "php/actualizarExistencias.php", async: false, type: "POST", data: { idProducto: a2_IdProducto, tipoInventario: 'ALMACEN2', cantidad: cantidad,
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