<div class="page-title">
	<h2><span class="fa fa-crop"></span> Unidades de medidas</h2>
</div>
<?= $this->Form->create('UnidadMedida', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Unidad de medida</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<?= $this->Form->input('id'); ?>
							<tr>
								<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
								<td><?= $this->Form->input('nombre'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('tipo_campo', 'Tipo de campo'); ?></th>
								<td><?= $this->Form->select('tipo_campo', array(
								'text' => 'Texto',
								'number' => 'Sólo números'
							) , array('class' => 'form-control', 'div' => false, 'label' => false, 'empty' => false)); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('permitidos', 'Carácteres permitidos adicionales'); ?></th>
								<td><?= $this->Form->input('permitidos', array('class' => 'tagsinput')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('ejemplo', 'Ejemplo para mantenedor'); ?></th>
								<td><?= $this->Form->input('ejemplo'); ?></td>
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
