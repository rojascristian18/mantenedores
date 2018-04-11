<div class="page-title">
	<h2><span class="fa fa-cogs"></span> Configuraciones</h2>
</div>
<?= $this->Form->create('Configuracion', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id'); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<h3>Configuraciones de notificación</h3>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th style="max-width:300px;"><label>Comenzar a notificar al mantenedor antes que su tarea finalice en :</label></th>
									<td>
										<div class="input-group">
			                                <?= $this->Form->input('dias_notificar_tareas'); ?>
			                                <span class="input-group-addon">Días</span>
			                            </div>
									</td>
								</tr>
								<tr>
									<th style="max-width:300px;"><label>Email cópia oculta de las tareas <small>(Separadas por coma ',')</small>:</label></th>
									<td><?= $this->Form->input('bcc_tareas'); ?></td>
								</tr>
								<tr>
									<th style="max-width:300px;"><label>Email cópia oculta de los comentarios <small>(Separadas por coma ',')</small>:</label></th>
									<td><?= $this->Form->input('bcc_comentarios'); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div><!-- Configuración de notificaciones -->
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<h3>Configuraciones de productos</h3>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th style="max-width:300px;"><label>Stock inicial para los productos :</label></th>
									<td>
										<?= $this->Form->input('stock_minimo'); ?>
									</td>
								</tr>
								<tr>
									<th><?= $this->Form->label('imagen_ancho_min',_('Ancho mínimo de la imagen de los productos (pixeles)'));?></th>
									<td><?= $this->Form->input('imagen_ancho_min'); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('imagen_ancho_max',_('Ancho máximo de la imagen de los productos (pixeles)'));?></th>
									<td><?= $this->Form->input('imagen_ancho_max'); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('imagen_alto_min',_('Alto mínimo de la imagen de los productos (pixeles)'));?></th>
									<td><?= $this->Form->input('imagen_alto_min'); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('imagen_alto_max',_('Alto máximo de la imagen de los productos (pixeles)'));?></th>
									<td><?= $this->Form->input('imagen_alto_max'); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('imagen_peso',_('Peso máximo de la imagen (MB)'));?></th>
									<td><div class="input-group"><?= $this->Form->input('imagen_peso'); ?><span class="input-group-addon">Megabyte</span>
			                            </div></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div><!-- Configuración de productos -->
			<h2><i class="fa fa-cog"></i> Integraciones</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<h3>Optimizador de imágenes (TinyPNG)</h3>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th style="max-width:300px;"><?= $this->Form->label('comprimir_imagenes',_('Comprimir imágenes automáticamente'));?></th>
									<td><?= $this->Form->input('comprimir_imagenes', array('class' => 'icheckbox')); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('tiny_api_key',_('API KEY de TinyPNG <br><a href="https://tinypng.com/dashboard/developers" target="_blank">Obtener API KEY</a>'));?></th>
									<td><?= $this->Form->input('tiny_api_key'); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<h3>Priscync</h3>
							<p>Herramienta que se utiliza para conocer las diferencias de precio de mis productos con respecto a el o los competidores.</p>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th><?= $this->Form->label('usar_prisync',_('¿Activar Priscync?'));?></th>
									<td><?= $this->Form->input('usar_prisync', array('class' => 'icheckbox')); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('prisync_key',_('API KEY (email de usuario)'));?></th>
									<td><?= $this->Form->input('prisync_key'); ?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('prisync_token',_('API TOKEN'));?></th>
									<td><?= $this->Form->input('prisync_token'); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-footer">
					<div class="pull-right">
						<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
						<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end(); ?>