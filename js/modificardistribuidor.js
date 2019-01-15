//Variables para el módulo de modificación de distribuidor
var md_IdPatrocinador = 0;
var md_IdDistribuidor = 0;
//Fuciones para el módulo de modificación de distribuidor
function limpiarCamposModificarDistribuidor() {
    $("#tbIdDistribuidor").val("");
    $("#tbNombre").val("");
    $("#tbPaterno").val("");
    $("#tbMaterno").val("");
    $("#tbCalle").val("");
    $("#tbNumInterior").val("");
    $("#tbNumExterior").val("");
    $("#tbEntreCalles").val("");
    $("#tbColonia").val("");
    $("#tbCiudad").val("");
    $("#tbEstado").val("NAYARIT");
    $("#tbCodigoPostal").val("");
    $("#tbTelParticular").val("");
    $("#tbTelCelular").val("");
    $("#tbBanco").val("");
    $("#tbClabe").val("");
    $("#tbEmail").val("");
    $("#tbRfc").val("");
    $("#tbCurp").val("");
    $("#tbIne").val("");
    $("#selDia").val("01");
    $("#selMes").val("01");
    $("#tbAño").val("");
    $("#tbBeneficiario").val("");
    $("#tbPatrocinador").val("");
    $("#tbUsuario").val("");
    $("#tbPassword").val("");
    $("#tbBuscar").val("");
    $("#cbUsuario").prop("checked", false);
}

function actualizarDistribuidor() {
    var idDistribuidor = md_IdDistribuidor;
    var nombre = $("#tbNombre").val();
    var paterno = $("#tbPaterno").val();
    var materno = $("#tbMaterno").val();
    var calle = $("#tbCalle").val();
    var interior = $("#tbNumInterior").val();
    var exterior = $("#tbNumExterior").val();
    var entreCalles = $("#tbEntreCalles").val();
    var colonia = $("#tbColonia").val();
    var ciudad = $("#tbCiudad").val();
    var estado = $("#tbEstado").val();
    var codigoPostal = $("#tbCodigoPostal").val();
    var telParticular = $("#tbTelParticular").val();
    var telCelular = $("#tbTelCelular").val();
    var banco = $("#tbBanco").val();
    var clabe = $("#tbClabe").val();
    var email = $("#tbEmail").val();
    var rfc = $("#tbRfc").val();
    var curp = $("#tbCurp").val();
    var ine = $("#tbIne").val();
    var dia = $("#selDia").val();
    var mes = $("#selMes").val();
    var año = $("#tbAño").val();
    var beneficiario = $("#tbBeneficiario").val();
    var patrocinador = md_IdPatrocinador;
    if ($("#tbPatrocinador").val().length == 0) {
        patrocinador = 0;
    }
    var usuario = $("#tbUsuario").val();
    var pass = $("#tbPassword").val();
    var tieneUsuario = $("#cbUsuario").is(":checked") ? "SI" : "NO";

    if (nombre.length == 0) {
        alert("No ha escrito el nombre del distribuidor.");
        $("#tbNombre").focus();
        return;
    }
    if (calle.length == 0) {
        alert("No ha escrito la calle del domicilio del distribuidor");
        $("#tbCalle").focus();
        return;
    }
    if (colonia.length == 0) {
        alert("No ha escrito la colonia del domicilio del distribuidor");
        $("#tbColonia").focus();
        return;
    }
    if (ciudad.length == 0) {
        alert("No ha escrito la ciudad del distribuidor");
        $("#tbCiudad").focus();
        return;
    }
    if (estado.length == 0) {
        alert("No ha escrito el estado del distribuidor");
        $("#tbEstado").focus();
        return;
    }
    /*
    if (banco.length == 0) {
        alert("No ha escrito el banco del distribuidor");
        $("#tbBanco").focus();
        return;
    }
    if (clabe.length != 18) {
        alert("No ha escrito la clabe del distribuidor");
        $("#tbClabe").focus();
        return;
    }
    */
    if (tieneUsuario == "SI") {
        if (usuario.length == 0) {
            alert("No ha escrito el nombre de usuario del distribuidor");
            $("#tbUsuario").focus();
            return;
        }
        if (pass.length == 0) {
            alert("No ha escrito la contraseña del distribuidor");
            $("#tbPassword").focus();
            return;
        }
    }

    nombre = nombre.toUpperCase();
    paterno = paterno.toUpperCase();
    materno = materno.toUpperCase();
    calle = calle.toUpperCase();
    interior = interior.toUpperCase();
    exterior = exterior.toUpperCase();
    entreCalles = entreCalles.toUpperCase();
    colonia = colonia.toUpperCase();
    ciudad = ciudad.toUpperCase();
    estado = estado.toUpperCase();    
    banco = banco.toUpperCase();
    clabe = clabe.toUpperCase();    
    rfc = rfc.toUpperCase();
    curp = curp.toUpperCase();
    ine = ine.toUpperCase();    
    beneficiario = beneficiario.toUpperCase();
    patrocinador = md_IdPatrocinador;
    usuario = $("#tbUsuario").val();
    pass = $("#tbPassword").val();
    tieneUsuario = $("#cbUsuario").is(":checked") ? "SI" : "NO";

    var fechaCaptura = obtenerFechaHoraActual('FULL');

    $.ajax({url: "php/actualizarDistribuidor.php", async: false, type: "POST", data: { idDistribuidor: idDistribuidor, nombre: nombre, paterno: paterno, materno: materno,
            calle: calle, interior: interior, exterior: exterior, entreCalles: entreCalles, colonia: colonia, ciudad: ciudad, estado: estado,
            codigoPostal: codigoPostal, telefonoParticular: telParticular, telefonoCelular: telCelular, banco: banco, clabe: clabe,
            email: email, rfc: rfc, diaNacimiento: dia, mesNacimiento: mes, anoNacimiento: año, curp: curp, ine: ine, beneficiario: beneficiario, patrocinador: patrocinador,
            fechaCaptura: fechaCaptura, tieneUsuario: tieneUsuario, usuario: usuario, pass: pass }, success: function(res) {
        if (res == "OK") {
            alert("Se ha modificado el distribuidor.");
            limpiarCamposModificarDistribuidor();
        } else {
            alert(res);
        }
    }});
}

function verificarCreacionUsuario() {

    if ($("#cbUsuario").is(":checked")) {

        var nombre = $("#tbNombre").val();
        var dia = $("#selDia").val();
        var mes = $("#selMes").val();
        var año = $("#tbAño").val();

        if (nombre.length == 0) {
            $("#cbUsuario").prop("checked", false);
            alert("No es posible crear el usuario. Por favor escriba el nombre del distribuidor.");
            return;
        }
        if (dia.length == 0) {
            $("#cbUsuario").prop("checked", false);
            return;
        }
        if (mes.length == 0) {
            $("#cbUsuario").prop("checked", false);
            return;
        }
        if (año.length == 0) {
            $("#cbUsuario").prop("checked", false);
            alert("No es posible crear el usuario. Por favor escriba el año de nacimiento del distribuidor.");
            return;
        }
        crearUsuario();
    } else {
        $("#tbUsuario").val("");
        $("#tbPassword").val("");
    }
}

function crearUsuario() {
    var nombre = $("#tbNombre").val();
    var dia = $("#selDia").val();
    var mes = $("#selMes").val();
    var año = $("#tbAño").val();

    var encFecha = parseInt(dia) + parseInt(mes) + parseInt(año);
    var encCFecha = parseInt(obtenerFechaHoraActual('DAY')) + parseInt(obtenerFechaHoraActual('MONTH')) + parseInt(obtenerFechaHoraActual('YEAR'));

    var finalFecha = encFecha + encCFecha;

    var nombre = nombre.replace(' ', '');
    var usuario = nombre.charAt(nombre.length/2) + nombre.charAt(nombre.length/2 - 1) + nombre.charAt(nombre.length/2 + 1);
    usuario = usuario + finalFecha;
    $("#tbUsuario").val(usuario);

    var pass = nombre.charAt(0) + nombre.charAt(nombre.length - 1) + nombre.charAt(nombre.length/2 + 1);
    pass = pass + encCFecha;
    $("#tbPassword").val(pass);
}

function elegirPatrocinador(id, value) {
    md_IdPatrocinador = id;
}

function elegirDistribuidor(id, value) {
    md_IdDistribuidor = id;
    cargarDatosDistribuidor();
}

function cargarDatosDistribuidor() {
    $.ajax({url: "php/obtenerDistribuidorXML.php", async: false, type: "POST", data: { idDistribuidor: md_IdDistribuidor}, success: function(res) {
        $('resultado', res).each(function(index, element) {
            if ($(this).find("respuesta").text() == "OK") {
                $("#tbIdDistribuidor").val($(this).find("iddistribuidor").text());
                $("#tbNombre").val($(this).find("nombre").text());
                $("#tbPaterno").val($(this).find("apellidopaterno").text());
                $("#tbMaterno").val($(this).find("apellidomaterno").text());
                $("#tbCalle").val($(this).find("calle").text());
                $("#tbNumInterior").val($(this).find("numinterior").text());
                $("#tbNumExterior").val($(this).find("numexterior").text());
                $("#tbEntreCalles").val($(this).find("entrecalles").text());
                $("#tbColonia").val($(this).find("colonia").text());
                $("#tbCiudad").val($(this).find("ciudad").text());
                $("#tbEstado").val($(this).find("estado").text());
                $("#tbCodigoPostal").val($(this).find("codigopostal").text());
                $("#tbTelParticular").val($(this).find("telefonoparticular").text());
                $("#tbTelCelular").val($(this).find("telefonocelular").text());
                $("#tbBanco").val($(this).find("banco").text());
                $("#tbClabe").val($(this).find("clabe").text());
                $("#tbEmail").val($(this).find("email").text());
                $("#tbRfc").val($(this).find("rfc").text());
                $("#tbCurp").val($(this).find("curp").text());
                $("#tbIne").val($(this).find("ine").text());
                $("#selDia").val($(this).find("dianacimiento").text());
                $("#selMes").val($(this).find("mesnacimiento").text());
                $("#tbAño").val($(this).find("anonacimiento").text());
                $("#tbBeneficiario").val($(this).find("beneficiario").text());
                $("#tbPatrocinador").val($(this).find("patrocinador").text());
                if ($(this).find("tieneusuario").text() == "SI") {
                    $("#tbUsuario").val($(this).find("usuario").text());
                    $("#tbPassword").val($(this).find("pass").text());
                    $("#cbUsuario").prop("checked", true);
                } else {
                    $("#cbUsuario").prop("checked", false);
                }
                md_IdPatrocinador = $(this).find("idpatrocinador").text();
            }
        });
    }});
}