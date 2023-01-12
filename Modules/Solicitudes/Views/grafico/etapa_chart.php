<!-- Page Content -->
<div style="margin-left:5%">
<!-- Area chart -->
<h1> Etapa Chart </h1>
<div class="chart-container">
    <div class="chart-container">
        <canvas id="etapa-chart"></canvas>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    $(function(){
    //obtener el canvas del grafico de barra
    var cData = JSON.parse('<?php echo $etapa_data; ?>');
    var ctx = $("#etapa-chart");


    var data = {
        labels: cData.etapa,
        datasets:  [{
    label: cData.etapa,
    data: cData.cantidad,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
    };


    //options
    var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Usuarios registrados por distritos",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: options
      });
});
</script>


