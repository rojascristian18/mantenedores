<div class="page-title">
	<h2><span class="fa fa-list"></span> Imagenes</h2>
</div>
<?= $this->Form->create('Imagen', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Imagen</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
														<?= $this->Form->input('id'); ?>
																	<tr>
												<th><?= $this->Form->label('producto_id', 'Producto'); ?></th>
												<td><?= $this->Form->input('producto_id', array('class' => 'form-control select')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('imagen', 'Imagen'); ?></th>
												<td><?= $this->Form->input('imagen', array('type' => 'file')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
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
