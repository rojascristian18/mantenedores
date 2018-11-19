<div class="page-title">
	<h2><span class="fa fa-list"></span> Cuentas</h2>
</div>
<?= $this->Form->create('Cuenta', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Cuenta</h3>
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
												<th><?= $this->Form->label('banco_id', 'Banco'); ?></th>
												<td><?= $this->Form->input('banco_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('tipo_cuenta_id', 'Tipo cuenta'); ?></th>
												<td><?= $this->Form->input('tipo_cuenta_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('otro', 'Otro'); ?></th>
												<td><?= $this->Form->input('otro'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('cuenta', 'Cuenta'); ?></th>
												<td><?= $this->Form->input('cuenta'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('principal', 'Principal'); ?></th>
												<td><?= $this->Form->input('principal', array('class' => 'icheckbox')); ?></td>
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
