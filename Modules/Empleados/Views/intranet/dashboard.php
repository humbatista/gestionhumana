<!-- <!DOCTYPE html>
<html>
    <div class="w3-container" style="margin-top: 20px; margin-left:10%; margin-right:15%;">
        <header>
            <div class="w3-card">
                <img src="<?php //echo base_url('public/assets/img/banner_dashboard.png');?>" style="max-height:250px">
            </div>
            <div class="w3-bar w3-black">
                <a href="#" class="w3-bar-item w3-button">Home</a>
                <a href="https://outlook.office365.com/mail/inbox" class="w3-bar-item w3-button">Correo</a>
                <a href="<?php //echo base_url('salir') ?>" class="w3-bar-item w3-button">Salir</a>
            </div>
        </header> -->
        <body>
            <div class="row">
                <div class="col-sm-4">
                        <div class ="w3-card-4" style="width:80%">
                            <header class="w3-container w3-blue">
                                <h3>Personal de Licencias</h3>
                            </header>
                            <div class="w3-container">
                                <div>
                                    <ol>
                                        <?php
                                            foreach ($licencia as $rows) {
                                            echo "<li>".
                                                        "<ul>".
                                                            "<li>". $rows->nombre." ". $rows->apellido."</li>".
                                                            "<li>"."Inicio ".$rows->fechaini."</li>".
                                                            "<li>"."Fin ".$rows->fechafin."</li>".
                                                        "</ul>".
                                                    "</li>";
                                            }
                                        ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="w3-card-4">
                            <header class="w3-container w3-blue">
                                <h4>Misión</h4>
                            </header>
                            <div class="w3-container">
                                <p><strong>Garantizar en el territorio dominicano, un sistema educativo pre universitario
                                de calidad, mediante su rectoría, regulación la prestación de servicios de educación y la investigación.</strong></p>
                                </div>
                        </div><br>
                        <div class="w3-card-4">
                            <header class="w3-container w3-blue">
                                <h4>Visión</h4>
                            </header>
                            <div class="w3-container">
                                <p><strong>Ser la entidad del Estado dominicano que asegura un servicio de educación integral, oportuno, pertinente, 
                                    inclusivo e igualitario, facilitador de la inserción a la vida en sociedad y al trabajo productivo de sus estudiantes 
                                    con propensión a una vida mejor, con el mayor grado de participación, valoración y aceptación del pueblo dominicano.</strong></p>
                            </div>
                        </div><br>
                            <div class="w3-card-4">
                                <header class="w3-container w3-blue">
                                    <h4>Valores</h4>
                                </header>
                                <div class="w3-container">
                                    <ul><strong>
                                        <li>Amor</li>
                                        <li>Transparencia</li>
                                        <li>Integridad</li>
                                        <li>Compromiso</li>
                                        <li>Equidad</li>
                                    </strong></ul>
                                </div>
                            </div>
                </div>
                <div class="col-sm-8">
                    <div class="w3-container">
                        <div class="w3-container">
                            <div class="w3-content w3-section" style="width:100%">
                                <img class="mySlides" src="<?php echo base_url('public/assets/img/laboratorios.png');?>" style="width:100%">
                                <img class="mySlides" src="<?php echo base_url('public/assets/img/calendarioescolar.png');?>" style="width:100%">
                                <img class="mySlides" src="<?php echo base_url('public/assets/img/image870.png');?>" style="width:100%">
                            </div>
                        </div>
                        <div class="w3-container">
                            <table class="table table-hover" style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <td>Nombre</td>
                                        <td>Apellido</td>
                                        <td>Cedula</td>
                                        <td>Cargo</td>
                                        <td>Funcion</td>
                                        <td>Ingreso</td>
                                        <td>Vacaciones</td>
                                        <td>Estado</td>
                                        <td>Acci&oacute;n</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($empleados as $rows) {
                                        if($rows['vacaciones']=='SI'){
                                            $color = '#E57373';
                                            $semaforo = 'text-danger';
                                        } else{
                                            $color = '#FFEE58';
                                            $semaforo = 'text-success';
                                        }
                                        echo "<tr>";
                                        echo "<td>". $rows['nombre']. "</td>";
                                        echo "<td>". $rows['apellido']. "</td>";
                                        echo "<td>". $rows['cedula']. "</td>";
                                        echo "<td>". $rows['cargo']. "</td>";
                                        echo "<td>". $rows['funcion']. "</td>";
                                        echo "<td>". $rows['fecingreso']. "</td>";
                                        echo "<td>". $rows['vacaciones']. "</td>";
                                        echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                                        echo "<td>
                                                <a class='btn btn-ver' href='http://app.regional11.gob.do/app_gestionhumana/empleados/servidor1?codigo=".$rows['codigo']."'><i class='fa fa-eye'></i></a>
                                                <a class='btn' ref='#'><i class='fa fa-pencil-square-o'></i></a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Paginacion -->
                                <div style="margin-top: 10px;">
                                    <?= $pager->links() ?>
                                </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-sm-4">
                    <br>
                    <div class="w3-card-4">
                        <header class="w3-container w3-blue">
                        <h4>Cumpleaños</h4>
                        </header>
                        <div class="w3-container">
                            <div class="carousel-inner">
                                <?php $active = 'active'; $i=0;
                                if($traer_cumple != 0)
                                {
                                    foreach ($traer_cumple as $cumpleHoy)
                                    {
                                        if($i >0){ $active="";} $i++
                                         ?>
                                        <div class ="carousel-item active"  > 
                                            <div class="carousel-item <?php echo $active;?>">
                                                <img src="<?php //echo base_url('public/assets/cumple/custom.png');?>" alt="" class="img-thumbnail foto_us">
                                                <div class="carousel-caption cumple-mes" style="color:red; font-size:16px" ><?php echo $cumpleHoy->NOMBRE; ?> </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                { ?>
                                    <div class = "carousel-item active">
                                        <p>no hay</p>
                                        <!-- <img src="<?php //echo base_url('public/assets/cumple/sin_fiesta.png');?>" alt="" class="img-thumbnail foto_us">-->
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><br> -->
                </div>
            </div>
            <script>
                var myIndex = 0;
                carousel();
                
                function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}    
                x[myIndex-1].style.display = "block";  
                setTimeout(carousel, 5000); // Cambia cada 5 segundos
                }
            </script>
        </body>
    </div>
</html>
