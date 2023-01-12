
//function Edad(FechaNacimiento) {
$( document ).ready(function() {

    var fecha = document.getElementById('fechaNace').value;
    var fechaNace = new Date(fecha);
    var fechaActual = new Date()

    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));
    $('#edad').val(edad);
    //return edad;
    mes = String(date.getMonth()+1).padStart(2, '0');
    periodo = String(date.getFullYear())+mes;
    $('#periodo').val(periodo);
})


