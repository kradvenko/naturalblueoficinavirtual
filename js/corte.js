//Variables para el módulo de corte

//Funciones para el módulo de corte
function limpiarCamposCorte() {
    $("#selDia").val(obtenerFechaHoraActual("DAY"));
    $("#selMes").val(obtenerFechaHoraActual("MONTH"));
    $("#tbAño").val(obtenerFechaHoraActual("YEAR"));
    $("#tbNombreBusqueda").val("");
    $("#cbFinalizados").prop("checked", false);
    $("#cbNoPagadas").prop("checked", false);
}

function generarCorte() {
    var fecha = $("#selDia").val() + "/" + $("#selMes").val() + "/" + $("#tbAño").val() + "%";
    $.ajax({url: "php/obtenerCorteVentas.php", async: false, type: "POST", data: { fecha: fecha }, success: function(res) {
        $("#divCorteVentas").html(res);
    }});
    var totalEfectivo = parseFloat($("#lblVentaEfectivo").text());
    var totalTarjeta = parseFloat($("#lvlVentaTarjeta").text());
    $("#divTotalEfectivo").html("$ " + totalEfectivo);
    $("#divTotalTarjeta").html("$ " + totalTarjeta);
}