<style>
    .col{
        border: 2px;
        border-style: groove;
    }

    .row{
        border: 3px;
    }

    .titulo{
        background-color: lightblue;
    }
</style>

<div class="container">
    <div class="w3-panel w3-card-4">
        <form class="form" action="evaluar/save" method="post" >
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombres">Nombre:</label>
                        <input type="text" name="nombres" id="nombres" value=<?= esc($nombre) ?> class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos" value=<?= esc($apellido) ?> class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <span><h4>Fecha:</span><span> <div id="current_date"></div></h4></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label for="cedula">Cedula:</label>
                            <input type="text" name="cedula" id="cedula" value=<?= esc($cedula) ?> class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                            <label for="periodo">Periodo que cubre la evaluacion:</label>
                            <input type="text" name="periodo" id="periodo" class="form-control periodo">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                            <label for="edad">Edad:</label>
                            <input type='hidden' id='fechaNace' value=<?= esc($fecnacimiento) ?>>
                            <input type="text" name="edad" id="edad" class="form-control edad">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label for="cargo">Cargo:</label>
                            <input type="text" name="cargo" id="cargo" value=<?= esc($cargo) ?> class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <input type="text" name="sexo" id="sexo" value=<?= esc($sexo) ?> class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col">
                    <div class="form-group">
                            <label for="fecingreso">Fecha de Ingreso a la institucion:</label>
                            <input type="text" name="fecingreso" id="fecingreso" value=<?= esc($fecingreso) ?> class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3 col">
                    <h2>CALIFICACION</h2>
                </div>
                <div class="col-md-3 col">
                    <h5>OBSERVACIONES DEL EVALUADOR</h5>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12 col titulo">
                    <h5>1. DESEMPEÑO DE LA FUNCION: (Valor 60 Puntos)</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col">
                    <h4>1.1 CALIDAD DEL TRABAJO:</h4>
                    <P>Cuidado, esmero, preocupacion por la exactitud y forma de presentacion de las labores asignadas:
                        Califiquese la presencia o ausencia de errores y su frecuencia e incidencia.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbcalidad">6</div>
                    <input type="range" class="form-range" min="2" max="10" step="2" id="calidad" name="calidad" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_calidad" name="obs_calidad" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col">
                    <h4>1.2 CANTIDAD DE TRABAJO:</h4>
                    <P>Volumen de trabajo ejecutado. Tomar en cuenta la rapidez en la ejecución de la labor, 
                        atención de servicios de modo eficiente y en tiempo oportuno.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbcantidad">6</div>
                    <input type="range" class="form-range" min="2" max="10" step="2" id="cantidad" name="cantidad" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_cantidad" name="obs_cantidad" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>1.3 ORGANIZACION DEL TRABAJO:</h4>
                    <P>Capacidad para lograr eficiencia en su labor haciendo uso adecuado de los medios y del tiempo
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lborganizacion">6</div>
                    <input type="range" class="form-range" min="2" max="10" step="2" id="organizacion" name="organizacion" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_organizacion" name="obs_organizacion" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>1.4 COLABORACION:</h4>
                    <P>Actitud para alcanzar los objetivos a través del trabajo propio y en equipo.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbcolaboracion">6</div>
                    <input type="range" class="form-range" min="2" max="10" step="2" id="colaboracion" name="colaboracion"  onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_colaboracion" class="form-control" name="obs_colaboracion" ></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>1.5 OPORTUNIDAD:</h4>
                    <P>Entrega los trabajos de acuerdo con la programación previamente establecida
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lboportunidad">6</div>
                    <input type="range" class="form-range" min="2" max="10" step="2" id="oportunidad" name="oportunidad" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_oportunidad" name="obs_oportunidad" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>1.6 CONOCIMIENTO DEL TRABAJO:</h4>
                    <P>Aplica las destrezas y los conocimientos necesario para el cumplimiento de las 
                        actividades y funciones
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbconocimiento">6</div>
                    <input type="range" class="form-range" min="1" max="10" id="conocimiento" name="conocimiento" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_conocimiento" name= "obs_conocimiento" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col titulo">
                    <h5>2 CARACTERISTICAS INDIVIDUALES: (Valor 40 Puntos)</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.1 PUNTUALIDAD:</h4>
                    <P>Cumplimiento estricto con el horario establecido en el trabajo. LLegar a la hora establecida.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbpuntualidad">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="puntualidad" name="puntualidad">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_puntualidad" name ="obs_puntualidad" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.2 RESPONSABILIDAD:</h4>
                    <P>actitud para completar tareas y deberes asignados de acuerdo a metas y `plazos originalmente pactados.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbresponsabilidad">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="responsabilidad" name="responsabilidad" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_responsabilidad" name= "obs_responsabilidad" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.3 INICIATIVA:</h4>
                    <P>Tendencia a contribuir, desarrollar y llevar a cabo nuevas ideas o métodos
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbiniciativa">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="iniciativa" name= "iniciativa" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_iniciativa" name="obs_iniciativa" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.4 CAPACIDAD PARA SOPORTAR PRESION AL ENTREGAR RESULTADOS:</h4>
                    <P>Habilidad para apresurarse en el trabajo asignado. Cumplir sin tomarse ansioso, agresivo y/o voluble
                    en su temperamento.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbcapacidad">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="capacidad" name="capacidad"  onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_capacidad" name="obs_capacidad" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.5 DISCRECION Y TACTO:</h4>
                    <P>Actitud reservada para actuar o para guardar datos importantes para la organización sin 
                        repetir más que cuanto sea necesario.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbdiscrecion">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="discrecion" name="discrecion" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_discrecion" name="obs_discrecion" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.6 RELACIONES INTERPERSONALES:</h4>
                    <P>Comportamiento social adecuado en el trato con supervisores, compañeros de trabajo, 
                        usuarios y visitantes.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbrelaciones">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="relaciones" name="relaciones" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_relaciones" name="obs_relaciones"   class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.7 COMPROMISO INSTITUCIONAL:</h4>
                    <P>Asume y Transmite el conjunto de valores Organizacionales. En su comportamiento y actitudes 
                        demuestra sentido de pertenencia a la entidad.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbcompromiso">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="compromiso" name="compromiso" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_compromiso" name="obs_compromiso"  class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col">
                    <h4>2.8 UTILIZACION DE RECURSOS:</h4>
                    <P>Forma como emplea los equipos y elementos dispuestos para el empeño de sus funciones.
                    </P>
                </div>
                <div class="col-md-3 col">
                    <div class="lbutilizacion">3</div>
                    <input type="range" class="form-range" min="1" max="5" id="utilizacion" name="utilizacion" onchange="sumar(this.value);">
                </div>
                <div class="col-md-3 col">
                    <textarea type="textarea" id="obs_utilizacion" name="obs_utilizacion" class="form-control"></textarea>
                </div>
            </div>
            
        <span><h1>El resultado es:<input type="hidden" name="calificacion"></span> <span id="spTotal"></span></h1>
        <input type="hidden" name="empleado" value=<?= esc($codigo) ?>>
            <a href="<?php echo base_url('empleados/evaluacion');?>" class="btn btn-secundary">Cancelar</a>
            <a onClick="window.location.reload();" class="btn btn-secundary">Limpiar</a>
            <button class="btn btn-primary" type="submit">Aceptar</button>
        </form>
    </div>
</div>
<!-- script para que haga las sumatoria de los rangos -->
<script src=<?php echo base_url('public/assets/js/evaluar.js');?>></script>

<script src=<?php echo base_url('public/assets/js/calcular_edad.js');?>></script>
