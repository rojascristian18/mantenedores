<div class="page-title">
	<h2><span class="fa fa-list"></span> Productos Caracteristicas</h2>
</div>
<?= $this->Form->create('ProductosCaracteristica', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Productos Caracteristica</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
														<?= $this->Form->input('producto_id'); ?>
																	<tr>
												<th><?= $this->Form->label('id_feature', 'Id feature'); ?></th>
												<td><?= $this->Form->input('id_feature'); ?></td>
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
