//Variables para el módulo de articulos
var a_IdCategoriaSeleccionadaModificar = 0;
var a_IdArticuloSeleccionado = 0;
//Funciones para el módulo de artículos
function agregarNuevaCategoria() {
    var categoria = $("#tbNuevaCategoria").val();
    if (categoria.length == 0) {
        alert("No ha ingresado el nombre de la categoría.");
        return;
    }
    var fechaCaptura = obtenerFechaHoraActual('FULL');
    $.ajax({url: "php/agregarCategoria.php", async: false, type: "POST", data: { categoria: categoria, fechaCaptura: fechaCaptura }, success: function(res) {
        if (res == "OK") {
            alert("Se ha ingresado la categoría.");
            $('#modalAgregarCategoria').modal('hide');
            limpiarCamposNuevaCategoria();
            obtenerCategoriasSelect();
        } else {
            alert(res);
        }
    }});
}

function limpiarCamposNuevaCategoria() {
    $("#tbNuevaCategoria").val("");
}

function obtenerCategoriasSelect() {
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategorias', estado: 'ACTIVO' }, success: function(res) {
        $("#divCategorias").html(res);
        $("#selCategorias").change(obtenerArticulosInventario);
    }});
}

function obtenerCategoriasModificar() {
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategoriasModificar', estado: '%' }, success: function(res) {
        $("#divCategoriasModificar").html(res);
        $("#tbModificarCategoria").val($("#selCategoriasModificar option:selected").text());
        a_IdCategoriaSeleccionadaModificar = $("#selCategoriasModificar").val();
        $("#selCategoriasModificar").change(cambioCategoriaModificar);
    }});
}

function cambioCategoriaModificar() {
    $("#tbModificarCategoria").val($("#selCategoriasModificar option:selected").text());
    a_IdCategoriaSeleccionadaModificar = $("#selCategoriasModificar").val();
}

function limpiarCamposModificarCategoria() {
    $("#tbModificarCategoria").val("");
    a_IdCategoriaSeleccionadaModificar = 0;
}

function modificarCategoria() {
    var nuevoNombre = $("#tbModificarCategoria").val();
    if (nuevoNombre.length == 0) {
        alert("No ha escrito el nuevo nombre de la categoría.")
        return;
    }
    $.ajax({url: "php/modificarCategoria.php", async: false, type: "POST", data: { idCategoria: a_IdCategoriaSeleccionadaModificar, nuevoNombre: nuevoNombre }, success: function(res) {
        if (res == "OK") {
            alert("Se ha modificado la categoría.");
            $('#modalModificarCategoria').modal('hide');
            limpiarCamposModificarCategoria();
            obtenerCategoriasSelect();
        } else {
            alert(res);
        }
    }});
}

function obtenerCategoriasNuevoArticulo() {
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategoriasNuevoArticulo', estado: 'ACTIVO' }, success: function(res) {
        $("#divCategoriasNuevoArticulo").html(res);
        $("#selCategoriasNuevoArticulo").val($("#selCategorias").val());
    }});
}

function limpiarCamposNuevoArticulo() {
    $("#divCategoriasNuevoArticulo").val("");
    $("#tbNuevoArticuloCodigo").val("");
    $("#tbNuevoArticuloProducto").val("");
    $("#tbNuevoArticuloPrecioDistribuidor").val("0");
    $("#tbNuevoArticuloIVA").val("0");
    $("#tbNuevoArticuloPrecioDistribuidorIVA").val("0");
    $("#tbNuevoArticuloPrecioPublico").val("0");
    $("#tbNuevoArticuloValorNegocio").val("0");
    $("#tbNuevoArticuloCantidad").val("0");
    $("#tbNuevoArticuloCantidadMinima").val("0");
    a_IdArticuloSeleccionado = 0;
}

function agregarNuevoArticulo() {
    var codigo = $("#tbNuevoArticuloCodigo").val();
    var producto = $("#tbNuevoArticuloProducto").val();
    var precioDistribuidor = $("#tbNuevoArticuloPrecioDistribuidor").val();
    var iva = $("#tbNuevoArticuloIVA").val();
    var precioDistribuidorIva = $("#tbNuevoArticuloPrecioDistribuidorIVA").val();
    var precioPublico = $("#tbNuevoArticuloPrecioPublico").val();
    var valorNegocio = $("#tbNuevoArticuloValorNegocio").val();
    var idCategoria = $("#selCategoriasNuevoArticulo").val();
    
    if (producto.length == 0) {
        alert("No ha ingresado el nombre del artículo.");
        return;
    }
    var fechaCaptura = obtenerFechaHoraActual('FULL');
    $.ajax({url: "php/agregarArticulo.php", async: false, type: "POST", data: { codigo: codigo, idCategoria: idCategoria, producto: producto, precioDistribuidor: precioDistribuidor,
        precioDistribuidorIva: precioDistribuidorIva, precioPublico: precioPublico, iva: iva, valorNegocio: valorNegocio, fechaCaptura: fechaCaptura }, success: function(res) {
        if (res == "OK") {
            alert("Se ha ingresado el producto.");
            $('#modalAgregarArticulo').modal('hide');
            limpiarCamposNuevoArticulo();
            obtenerArticulosInventario();
        } else {
            alert(res);
        }
    }});
}

function obtenerArticulosInventario() {
    var idCategoria = $("#selCategorias").val();
    if (idCategoria == null) {
        return;
    }
    $.ajax({url: "php/obtenerArticulosInventario.php", async: false, type: "POST", data: { idCategoria: idCategoria, estado: '%', tipoInventario: 'PRODUCTOS' }, success: function(res) {
        $("#divArticulosInventario").html(res);
    }});
}

function modificarArticulo() {
    var codigo = $("#tbModificarArticuloCodigo").val();
    var producto = $("#tbModificarArticuloProducto").val();
    var precioDistribuidor = $("#tbModificarArticuloPrecioDistribuidor").val();
    var iva = $("#tbModificarArticuloIVA").val();
    var precioDistribuidorIva = $("#tbModificarArticuloPrecioDistribuidorIVA").val();
    var precioPublico = $("#tbModificarArticuloPrecioPublico").val();
    var valorNegocio = $("#tbModificarArticuloValorNegocio").val();    
    var idCategoria = $("#selCategoriasModificarArticulo").val();
    if (producto.length == 0) {
        alert("No ha ingresado el nombre del artículo.");
        return;
    }
    $.ajax({url: "php/modificarArticulo.php", async: false, type: "POST", data: { idProducto: a_IdArticuloSeleccionado, codigo: codigo, idCategoria: idCategoria, producto: producto, precioDistribuidor: precioDistribuidor,
        precioDistribuidorIva: precioDistribuidorIva, precioPublico: precioPublico, iva: iva, valorNegocio: valorNegocio }, success: function(res) {
        if (res == "OK") {
            alert("Se ha modificado el producto.");
            $('#modalModificarArticulo').modal('hide');
            limpiarCamposModificarArticulo();
            obtenerArticulosInventario();
        } else {
            alert(res);
        }
    }});
}

function obtenerDatosArticulo(id) {
    a_IdArticuloSeleccionado = id;
    $.ajax({url: "php/obtenerCategoriasSelect.php", async: false, type: "POST", data: { idSelect: 'selCategoriasModificarArticulo', estado: 'ACTIVO' }, success: function(res) {
        $("#divCategoriasModificarArticulo").html(res);
    }});

    $.ajax({url: "php/obtenerArticuloXML.php", async: false, type: "POST", data: { idProducto: id, estado: 'ACTIVO' }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#tbModificarArticuloCodigo").val($(this).find("codigo").text());
            $("#tbModificarArticuloProducto").val($(this).find("producto").text());
            $("#tbModificarArticuloPrecioDistribuidor").val($(this).find("preciodistribuidor").text());
            $("#tbModificarArticuloPrecioDistribuidorIVA").val($(this).find("preciodistribuidoriva").text());
            $("#tbModificarArticuloIVA").val($(this).find("iva").text());
            $("#tbModificarArticuloPrecioPublico").val($(this).find("preciopublico").text());
            $("#tbModificarArticuloValorNegocio").val($(this).find("valornegocio").text());
            $("#selCategoriasModificarArticulo").val($(this).find("idcategoria").text());
        });
    }});
    $('#modalModificarArticulo').modal('show');
}

function limpiarCamposModificarArticulo() {
    a_IdArticuloSeleccionado = 0;
    $("#tbModificarArticuloNombre").val("");
    $("#tbModificarArticuloClave").val("");
    $("#tbModificarArticuloDescripcion").val("");
    $("#tbModificarArticuloCantidad").val("0");
    $("#tbModificarArticuloPrecioPublico").val("0");
    $("#tbModificarArticuloCantidadMinima").val("0");
    $("#tbModificarArtículoPrecioCompra").val("0");
}