<div class="page-title">
	<h2><span class="fa fa-list"></span> Comentarios</h2>
</div>
<?= $this->Form->create('Comentario', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Comentario</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
														<?= $this->Form->input('id'); ?>
																	<tr>
												<th><?= $this->Form->label('parent_id', 'Comentario padre'); ?></th>
												<td><?= $this->Form->input('parent_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('tarea_id', 'Tarea'); ?></th>
												<td><?= $this->Form->input('tarea_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('importancia_id', 'Importancia'); ?></th>
												<td><?= $this->Form->input('importancia_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('usuario', 'Usuario'); ?></th>
												<td><?= $this->Form->input('usuario', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('administrador', 'Administrador'); ?></th>
												<td><?= $this->Form->input('administrador'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('comentario', 'Comentario'); ?></th>
												<td><?= $this->Form->input('comentario'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('visualizado', 'Visualizado'); ?></th>
												<td><?= $this->Form->input('visualizado', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('fecha_visualizado', 'Fecha visualizado'); ?></th>
												<td><?= $this->Form->input('fecha_visualizado'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('adjunto', 'Adjunto'); ?></th>
												<td><?= $this->Form->input('adjunto'); ?></td>
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
