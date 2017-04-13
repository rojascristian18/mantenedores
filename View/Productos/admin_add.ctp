<div class="page-title">
	<h2><span class="fa fa-list"></span> Productos</h2>
</div>
<?= $this->Form->create('Producto', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Producto</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
																				<tr>
												<th><?= $this->Form->label('tarea_id', 'Tarea'); ?></th>
												<td><?= $this->Form->input('tarea_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('grupocaracteristica_id', 'Grupocaracteristica'); ?></th>
												<td><?= $this->Form->input('grupocaracteristica_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('proveedor_id', 'Proveedor'); ?></th>
												<td><?= $this->Form->input('proveedor_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('fabricante_id', 'Fabricante'); ?></th>
												<td><?= $this->Form->input('fabricante_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('categoria_deafult_id', 'Categoria deafult'); ?></th>
												<td><?= $this->Form->input('categoria_deafult_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('parent_id', 'Producto padre'); ?></th>
												<td><?= $this->Form->input('parent_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('referencia', 'Referencia'); ?></th>
												<td><?= $this->Form->input('referencia'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre_final', 'Nombre final'); ?></th>
												<td><?= $this->Form->input('nombre_final'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('descripcion_corta', 'Descripcion corta'); ?></th>
												<td><?= $this->Form->input('descripcion_corta'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('descripcion', 'Descripcion'); ?></th>
												<td><?= $this->Form->input('descripcion'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('precio', 'Precio'); ?></th>
												<td><?= $this->Form->input('precio', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('largo', 'Largo'); ?></th>
												<td><?= $this->Form->input('largo'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('alto', 'Alto'); ?></th>
												<td><?= $this->Form->input('alto'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('profundidad', 'Profundidad'); ?></th>
												<td><?= $this->Form->input('profundidad'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('peso', 'Peso'); ?></th>
												<td><?= $this->Form->input('peso'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('cantidad', 'Cantidad'); ?></th>
												<td><?= $this->Form->input('cantidad'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('meta_titulo', 'Meta titulo'); ?></th>
												<td><?= $this->Form->input('meta_titulo'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('meta_descripcion', 'Meta descripcion'); ?></th>
												<td><?= $this->Form->input('meta_descripcion'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('validado', 'Validado'); ?></th>
												<td><?= $this->Form->input('validado', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('aceptado', 'Aceptado'); ?></th>
												<td><?= $this->Form->input('aceptado', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('rechazado', 'Rechazado'); ?></th>
												<td><?= $this->Form->input('rechazado', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																							<tr>
									<th><?= $this->Form->label('Palabraclave', 'Palabraclave'); ?></th>
									<td><?= $this->Form->input('Palabraclave'); ?></td>
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
