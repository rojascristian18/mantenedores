<div class="page-title">
	<h2><span class="fa fa-list"></span> Usuarios</h2>
</div>
<?= $this->Form->create('Usuario', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Usuario</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
														<?= $this->Form->input('id'); ?>
																	<tr>
												<th><?= $this->Form->label('rut', 'Rut'); ?></th>
												<td><?= $this->Form->input('rut'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('apellidos', 'Apellidos'); ?></th>
												<td><?= $this->Form->input('apellidos'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('email', 'Email'); ?></th>
												<td><?= $this->Form->input('email'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('clave', 'Clave'); ?></th>
												<td><?= $this->Form->input('clave', array('type' => 'password', 'autocomplete' => 'off', 'value' => '')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('repetir_clave', 'Repetir clave'); ?></th>
												<td><?= $this->Form->input('repetir_clave', array('type' => 'password', 'autocomplete' => 'off', 'value' => '')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('codigo_fono', 'Codigo fono'); ?></th>
												<td><?= $this->Form->input('codigo_fono'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('fono', 'Fono'); ?></th>
												<td><?= $this->Form->input('fono'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('imagen', 'Imagen'); ?></th>
												<td><?= $this->Form->input('imagen', array('type' => 'file')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('count_tareas_terminadas', 'Count tareas terminadas'); ?></th>
												<td><?= $this->Form->input('count_tareas_terminadas'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('ultimo_acceso', 'Ultimo acceso'); ?></th>
												<td><?= $this->Form->input('ultimo_acceso'); ?></td>
											</tr>
																							<tr>
									<th><?= $this->Form->label('Tarea', 'Tarea'); ?></th>
									<td><?= $this->Form->input('Tarea'); ?></td>
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
