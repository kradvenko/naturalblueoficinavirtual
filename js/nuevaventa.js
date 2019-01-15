//Variables para el módulo de nueva venta
var nv_IdDistribuidor = 0;
var nv_Idproducto = 0;
var nv_Productos = [];
var nv_Total = 0;
var nv_TotalPuntos = 0;
//Funciones para el módulo de nueva venta
function elegirDistribuidor(id, value) {
    nv_IdDistribuidor = id;
}

function elegirproducto(id, value) {
    nv_Idproducto = id;
    agregarProductoVenta();
}

function agregarProductoVenta() {
    var id = nv_Idproducto;
    var nombre;
    var precio;
    var puntos;

    $.ajax({url: "php/obtenerArticuloXML.php", async: false, type: "POST", data: { idProducto: nv_Idproducto, estado: 'ACTIVO' }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            nombre = $(this).find("producto").text();
            precio = $(this).find("preciodistribuidoriva").text();
            puntos = $(this).find("valornegocio").text();
        });
    }});


    nv_Producto = { id : id, nombre : nombre, precio : precio, cantidad : '1', total : precio, puntos : puntos, totalp : puntos };
    nv_Productos[nv_Productos.length] = nv_Producto;
    mostrarVenta();
    calcularTotal();
}

function mostrarVenta() {
    $("#divVenta").html("");
    for (i = 0; i <= nv_Productos.length - 1; i++) {
        nv_Producto = nv_Productos[i];
        var div;
        //Nombre
        div = '<div class="col-12 divBackgroundBlue2 divMargin">' + nv_Producto.nombre + '</div>';
        div = div + '<div class="col-1"><label class="labelType03">Cantidad</label></div>';
        div = div + '<div class="col-1">' + '<input id="tbCantidad_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarCantidad(' + i + ')" value="' + nv_Producto.cantidad + '"</input></div>';
        div = div + '<div class="col-1"><label class="labelType03">Precio</label></div>';        
        div = div + '<div class="col-1"><label class="labelType03">$ ' + nv_Producto.precio + '</label></div>';
        div = div + '<div class="col-1"><label class="labelType03">Total</label></div>';
        div = div + '<div class="col-1"><label class="labelType03">$ ' + nv_Producto.total + '</label></div>';
        div = div + '<div class="col-1"><label class="labelType03">Puntos</label></div>';        
        div = div + '<div class="col-1"><label class="labelType03">' + nv_Producto.puntos + '</label></div>';
        div = div + '<div class="col-1"><label class="labelType03">Total P.</label></div>';        
        div = div + '<div class="col-1"><label class="labelType03">' + nv_Producto.totalp + '</label></div>';
        div = div + '<div class="col-2 divMargin">' + '<button type="button" class="btn btn-primary btn-danger" onclick="borrarproducto(' + i + ')">Borrar</button></div>';
        
        //Total
        $("#divVenta").html($("#divVenta").html() + div);
    }
}

function calcularTotal() {
    var total = 0;
    var puntos = 0;
    for (i = 0; i <= nv_Productos.length - 1; i++) {
        nv_Producto = nv_Productos[i];
        total = Number(total) + Number(nv_Producto.total);
    }
    nv_Total = total;
    for (i = 0; i <= nv_Productos.length - 1; i++) {
        nv_Producto = nv_Productos[i];
        puntos = Number(puntos) + Number(nv_Producto.totalp);
    }
    nv_TotalPuntos = puntos;
    $("#lblPuntos").text(puntos);
    $("#lblTotal").text("$ " + total);
}

function borrarproducto(index) {
    nv_Productos.splice(index, 1);
    mostrarVenta();
    calcularTotal();
}

function cambiarCantidad(index) {
    if (isNaN($("#tbCantidad_" + index).val())) {
        alert("No ha escrito un número válido.");
        $("#tbCantidad_" + index).val("1");
        return;
    }
    nv_Producto = nv_Productos[index];
    nv_Producto.cantidad = $("#tbCantidad_" + index).val();
    calcularCostoproducto(index);
    mostrarVenta();
}

function calcularCostoproducto(index) {
    nv_Producto = nv_Productos[index];
    nv_Producto.total = nv_Producto.cantidad * nv_Producto.precio;
    nv_Producto.totalp = nv_Producto.cantidad * nv_Producto.puntos;
    calcularTotal();
}

function limpiarCamposNuevaVenta() {
    $("#tbBuscar").val("");
    $("#tbBuscarproducto").val("");
    $("#divVenta").html("");
    $("#lblPuntos").text("0");
    $("#lblTotal").text("$");
    nv_Idproducto = 0;
    nv_IdDistribuidor = 0;
    nv_Productos = [];
    nv_Total = 0;
    nv_TotalPuntos = 0;
}

function realizarVenta() {
    var fecha = obtenerFechaHoraActual('FULL');
    var total = nv_Total;
    var tipo = $("#selTipoVenta").val();
    var productos = nv_Productos;

    $.ajax({url: "php/agregarVenta.php", async: false, type: "POST", data: { fecha: fecha, total: total, tipo: tipo, iddistribuidor: nv_IdDistribuidor, puntos: nv_TotalPuntos, total: nv_Total, productos: productos }, success: function(res) {
        if (!isNaN(res)) {
            alert("Se ha ingresado la venta.");
            $('#modalPantallaVenta').modal('hide');
            limpiarCamposPantallaVenta();
            limpiarCamposNuevaVenta();
            //window.open("hojaventa.php?idventa=" + res,'_blank');
            window.open("ticketventa.php?idventa=" + res,'_blank');
        } else {
            alert(res);
        }
    }});
}

function limpiarCamposPantallaVenta() {
    $("#selTipoVenta").val("EFECTIVO");
    $("#tbEfectivo").val("0");
    $("#lblCambio").text("0");
}

function calcularCambio() {
    var efectivo =  $("#tbEfectivo").val();
    if (isNaN(efectivo)) {
        alert("No ha escrito un número válido.");
        $("#tbEfectivo").val("0");
        $("#tbEfectivo").focus();
        return;
    }
    if (efectivo < nv_Total) {
        alert("El efectivo es menor que el total.");
        $("#tbEfectivo").val("0");
        $("#tbEfectivo").focus();
        return;
    }
    var cambio = efectivo - nv_Total;
    $("#lblCambio").text(cambio);
}

function mostrarPantallaVenta() {
    if (nv_Productos.length == 0) {
        alert("No hay productos en la venta.");
        return;
    }
    if (nv_IdDistribuidor == 0) {
        alert("No ha elegido un distribuidor para la venta.");
        return;
    }
    $('#modalPantallaVenta').modal('show');
}