<div class="page-title">
	<h2><span class="fa fa-list"></span> Modulos</h2>
</div>
<?= $this->Form->create('Modulo', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Modulo</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
																				<tr>
												<th><?= $this->Form->label('parent_id', 'Modulo padre'); ?></th>
												<td><?= $this->Form->input('parent_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('url', 'URL'); ?></th>
												<td><?= $this->Form->input('url'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('icono', 'Icono'); ?></th>
												<td><?= $this->Form->input('icono'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('orden', 'Orden'); ?></th>
												<td><?= $this->Form->input('orden'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																							<tr>
									<th><?= $this->Form->label('Rol', 'Rol'); ?></th>
									<td><?= $this->Form->input('Rol'); ?></td>
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
