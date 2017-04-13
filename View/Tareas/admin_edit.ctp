<div class="page-title">
	<h2><span class="fa fa-list"></span> Tareas</h2>
</div>
<?= $this->Form->create('Tarea', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Tarea</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
														<?= $this->Form->input('id'); ?>
																	<tr>
												<th><?= $this->Form->label('usuario_id', 'Usuario'); ?></th>
												<td><?= $this->Form->input('usuario_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('administrador_id', 'Administrador'); ?></th>
												<td><?= $this->Form->input('administrador_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('parent_id', 'Tarea padre'); ?></th>
												<td><?= $this->Form->input('parent_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('categoriatarea_id', 'Categoriatarea'); ?></th>
												<td><?= $this->Form->input('categoriatarea_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('tienda_id', 'Tienda'); ?></th>
												<td><?= $this->Form->input('tienda_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('impuesto_default_id', 'Impuesto default'); ?></th>
												<td><?= $this->Form->input('impuesto_default_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('idioma_id', 'Idioma'); ?></th>
												<td><?= $this->Form->input('idioma_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('shop_id', 'Shop'); ?></th>
												<td><?= $this->Form->input('shop_id'); ?></td>
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
												<th><?= $this->Form->label('precio', 'Precio'); ?></th>
												<td><?= $this->Form->input('precio'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('fecha_entrega', 'Fecha entrega'); ?></th>
												<td><?= $this->Form->input('fecha_entrega'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('porcentaje_realizado', 'Porcentaje realizado'); ?></th>
												<td><?= $this->Form->input('porcentaje_realizado'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('iniciado', 'Iniciado'); ?></th>
												<td><?= $this->Form->input('iniciado'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('count_comentarios', 'Count comentarios'); ?></th>
												<td><?= $this->Form->input('count_comentarios'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('en_progreso', 'En progreso'); ?></th>
												<td><?= $this->Form->input('en_progreso', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('en_revision', 'En revision'); ?></th>
												<td><?= $this->Form->input('en_revision', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('finalizado', 'Finalizado'); ?></th>
												<td><?= $this->Form->input('finalizado', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('fecha_finalizado', 'Fecha finalizado'); ?></th>
												<td><?= $this->Form->input('fecha_finalizado'); ?></td>
											</tr>
																							<tr>
									<th><?= $this->Form->label('Palabraclave', 'Palabraclave'); ?></th>
									<td><?= $this->Form->input('Palabraclave'); ?></td>
								</tr>
											<tr>
									<th><?= $this->Form->label('Usuario', 'Usuario'); ?></th>
									<td><?= $this->Form->input('Usuario'); ?></td>
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
