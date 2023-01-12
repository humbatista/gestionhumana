date = new Date();
year = date.getFullYear();
month = date.getMonth() + 1;
day = date.getDate();
document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;


$( document ).ready(function() {
    $('#calidad').on('input', function(){
         v = $('#calidad').val();
         console.log(v);
         $('div.lbcalidad').text(v);
    });

    $('#cantidad').on('input', function(){
         v = $('#cantidad').val();
         console.log(v);
         $('div.lbcantidad').text(v);
    });

    $('#organizacion').on('input', function(){
         v = $('#organizacion').val();
         console.log(v);
         $('div.lborganizacion').text(v);
    });

    $('#colaboracion').on('input', function(){
         v = $('#colaboracion').val();
         console.log(v);
         $('div.lbcolaboracion').text(v);
    });

    $('#oportunidad').on('input', function(){
         v = $('#oportunidad').val();
         console.log(v);
         $('div.lboportunidad').text(v);
    });

    $('#conocimiento').on('input', function(){
         v = $('#conocimiento').val();
         console.log(v);
         $('div.lbconocimiento').text(v);
    });

    $('#puntualidad').on('input', function(){
         v = $('#puntualidad').val();
         console.log(v);
         $('div.lbpuntualidad').text(v);
    });

    $('#responsabilidad').on('input', function(){
         v = $('#responsabilidad').val();
         console.log(v);
         $('div.lbresponsabilidad').text(v);
    });

    $('#iniciativa').on('input', function(){
         v = $('#iniciativa').val();
         console.log(v);
         $('div.lbiniciativa').text(v);
    });

    $('#capacidad').on('input', function(){
         v = $('#capacidad').val();
         console.log(v);
         $('div.lbcapacidad').text(v);
    });

    $('#discrecion').on('input', function(){
         v = $('#discrecion').val();
         console.log(v);
         $('div.lbdiscrecion').text(v);
    });

    $('#relaciones').on('input', function(){
         v = $('#relaciones').val();
         console.log(v);
         $('div.lbrelaciones').text(v);
    });

    $('#compromiso').on('input', function(){
         v = $('#compromiso').val();
         console.log(v);
         $('div.lbcompromiso').text(v);
    });

    $('#utilizacion').on('input', function(){
         v = $('#utilizacion').val();
         console.log(v);
         $('div.lbutilizacion').text(v);
    });
});

var sliderCalidad = document.getElementById("calidad");
var sliderCantidad = document.getElementById("cantidad");
var sliderOrganizacion = document.getElementById("organizacion");
var sliderColaboracion = document.getElementById("colaboracion");
var sliderOportunidad = document.getElementById("oportunidad");
var sliderConocimiento = document.getElementById("conocimiento");
var sliderPuntualidad = document.getElementById("puntualidad");
var sliderResponsabilidad = document.getElementById("responsabilidad");
var sliderIniciativa = document.getElementById("iniciativa");
var sliderCapacidad = document.getElementById("capacidad");
var sliderDiscrecion = document.getElementById("discrecion");
var sliderRelaciones = document.getElementById("relaciones");
var sliderCompromiso = document.getElementById("compromiso");
var sliderUtilizacion = document.getElementById("utilizacion");
var output = document.getElementById("spTotal");


output.innerHTML = parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value);

sliderCalidad.oninput = function() {
  output.innerHTML =  parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderCantidad.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderOrganizacion.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderColaboracion.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderConocimiento.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + 
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderPuntualidad.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderResponsabilidad.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderIniciativa.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderCapacidad.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderDiscrecion.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderRelaciones.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) +
    parseInt(sliderCompromiso.value) + parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderCompromiso.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderUtilizacion.value) + parseInt(this.value);
}

sliderUtilizacion.oninput = function() {
  output.innerHTML =  parseInt(sliderCalidad.value) + parseInt(sliderCantidad.value) + parseInt(sliderOrganizacion.value) +
    parseInt(sliderColaboracion.value) + parseInt(sliderOportunidad.value) + parseInt(sliderConocimiento.value) +
    parseInt(sliderPuntualidad.value) + parseInt(sliderResponsabilidad.value) + parseInt(sliderIniciativa.value) +
    parseInt(sliderCapacidad.value) + parseInt(sliderDiscrecion.value) + parseInt(sliderRelaciones.value) +
    parseInt(sliderCompromiso.value) + parseInt(this.value);
}