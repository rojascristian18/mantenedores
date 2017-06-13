<div class="page-title">
	<h2><span class="fa fa-question-circle"></span> Preguntas Frecuentes</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<p>En esta sección de <b>Preguntas Frecuentes</b> encontrará información relevante para realizar correctamente las tareas que se le asignen.</p>
					<p>Sí su duda no aparece en este apartado, por favor contacte al administrador.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">                        
        <div class="col-md-12">
        	<div class="panel-group accordion accordion-dc">
        		<? foreach ($preguntaFrecuentes as $preguntaFrecuente) : ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#<?=$preguntaFrecuente['PreguntaFrecuente']['slug'];?>">
                                <?= $preguntaFrecuente['PreguntaFrecuente']['pregunta']?>
                            </a>
                        </h4>
                    </div>                                
                    <div class="panel-body" id="<?=$preguntaFrecuente['PreguntaFrecuente']['slug'];?>">
                        <?= $this->Text->autoParagraph($preguntaFrecuente['PreguntaFrecuente']['respuesta']); ?>
                    </div>                                
                </div>
            	<? endforeach; ?>
            </div>
        </div>
    </div>
</div>
