//Variables para el modulo

//Funciones para el modulo

function obtenerRed() {
    var idDistribuidor = getCookie("nbov_idusuario");

    $.ajax({url: "php/obtenerRed.php", async: false, type: "POST", data: { idDistribuidor: idDistribuidor }, success: function(res) {
        $('#divRed').html(res);
    }});
}