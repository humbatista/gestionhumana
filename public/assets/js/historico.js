function funcionhist(valor) {
    $.ajax({
        url: "http://localhost/gestionhumana/empleados/historico",
        //url: "http://app.regional.gob.do/app_gestionhumana/empleados/historico",
        type: "post",
        data: {id: valor},
        dataType: 'json',
        beforeSend: function (f) {
            $('#historico').html('Cargar Tabla...');
        },
        success:function(data){
            $('#obsModal').modal('show');
            $('#historico').html(data);
        },
        error: function(){
            alert('No se encontraron registros');
        }
    });
};