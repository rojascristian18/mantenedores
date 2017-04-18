<div class="page-title">
	<h2><span class="fa fa-list"></span> Tareas</h2>
</div>
<?= $this->Form->create('Tarea', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Tarea</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('usuario_id', 'Usuario'); ?></th>
								<td><?= $this->Form->input('usuario_id', array('class' => 'form-control select')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('administrador_id', 'Administrador'); ?></th>
								<td><?= $this->Form->input('administrador_id'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('categoriatarea_id', 'Categoriatarea'); ?></th>
								<td><?= $this->Form->input('categoriatarea_id', array('class' => 'form-control select')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('impuesto_default_id', 'Impuesto default'); ?></th>
								<td><?= $this->Form->select('impuesto_default_id', $impuestos, array('class' => 'form-control', 'empty' => 'Seleccione un impuesto')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('idioma_id', 'Idioma'); ?></th>
								<td><?= $this->Form->select('idioma_id', $idiomas, array('class' => 'form-control', 'empty' => 'Seleccione un idioma')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('shop_id', 'Shop'); ?></th>
								<td><?= $this->Form->select('shop_id', $shops, array('class' => 'form-control', 'empty' => 'Seleccione una tienda principal')); ?></td>
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
								<td><div class="form-inline"><div class="form-group"><?= $this->Form->input('fecha_entrega'); ?></div></div></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('porcentaje_realizado', 'Porcentaje realizado'); ?></th>
								<td><?= $this->Form->input('porcentaje_realizado'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('count_comentarios', 'Count comentarios'); ?></th>
								<td><?= $this->Form->input('count_comentarios'); ?></td>
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
