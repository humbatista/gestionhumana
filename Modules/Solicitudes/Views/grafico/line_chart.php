<!-- Page Content -->
<div style="margin-left:20%">
<!-- Area chart -->
<h1> Line Chart </h1>

<!-- Page Content -->
<div style="margin-left:20%">

<div class="chart-container">
    <div class="bar-chart-container">
        <canvas id="line-chart"></canvas>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    $(function(){
    //obtener el canvas del grafico de barra
    var cData = JSON.parse('<?php echo $area_data; ?>');
    var ctx = $("#line-chart");


    var data = {
        labels: cData.x,
        datasets: [{
        data: cData.y,
        label: 'My First Dataset',
        data: cData.y,
        fill: true,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
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
        type: "line",
        data: data,
        options: options
      });
});
</script>
