<div class="page-title">
	<h2><span class="fa fa-list"></span> Adjuntos</h2>
</div>
<?= $this->Form->create('Adjunto', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Adjunto</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
														<?= $this->Form->input('id'); ?>
																	<tr>
												<th><?= $this->Form->label('tarea_id', 'Tarea'); ?></th>
												<td><?= $this->Form->input('tarea_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('administrador', 'Administrador'); ?></th>
												<td><?= $this->Form->input('administrador'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('descripcion', 'Descripcion'); ?></th>
												<td><?= $this->Form->input('descripcion'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('url_archivo', 'Url archivo'); ?></th>
												<td><?= $this->Form->input('url_archivo'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('archivo', 'Archivo'); ?></th>
												<td><?= $this->Form->input('archivo', array('type' => 'file')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('count_descargas', 'Count descargas'); ?></th>
												<td><?= $this->Form->input('count_descargas'); ?></td>
											</tr>
																		</table>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-right">
						<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
						<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
<?= $this->Form->end(); ?>
