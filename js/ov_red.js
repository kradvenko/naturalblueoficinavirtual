//Variables para el modulo
ov_IdDistribuidorElegido = 0;
//Funciones para el modulo
function elegirDistribuidor(id, value) {
    ov_IdDistribuidorElegido = id;
    //$('#divDistribuidor').html(value);
    obtenerRed();
}

function obtenerRed() {
    $.ajax({url: "php/obtenerRed.php", async: false, type: "POST", data: { idDistribuidor: ov_IdDistribuidorElegido }, success: function(res) {
        $('#divRed').html(res);
    }});
}