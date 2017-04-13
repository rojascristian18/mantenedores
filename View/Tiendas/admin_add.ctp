<div class="page-title">
	<h2><span class="fa fa-list"></span> Tiendas</h2>
</div>
<?= $this->Form->create('Tienda', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Tienda</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('url', 'URL'); ?></th>
												<td><?= $this->Form->input('url'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('db_configuracion', 'Db configuracion'); ?></th>
												<td><?= $this->Form->input('db_configuracion'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('prefijo', 'Prefijo'); ?></th>
												<td><?= $this->Form->input('prefijo'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('principal', 'Principal'); ?></th>
												<td><?= $this->Form->input('principal', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('tema', 'Tema'); ?></th>
												<td><?= $this->Form->input('tema'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('logo', 'Logo'); ?></th>
												<td><?= $this->Form->input('logo', array('type' => 'file')); ?></td>
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
