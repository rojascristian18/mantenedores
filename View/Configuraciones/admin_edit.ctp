<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nueva Configuración</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Configuracion', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<?= $this->Form->input('id'); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('dias_notificar_tareas', 'Notificar tarea'); ?></th>
						<td><?= $this->Form->input('dias_notificar_tareas'); ?></td>
					</tr>
				</table>

				<div class="pull-right">
					<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
					<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
				</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>