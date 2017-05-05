<div class="page-title">
	<h2><span class="fa fa-list"></span> Emails</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nuevo Email</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Email', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('estado', 'Estado'); ?></th>
						<td><?= $this->Form->input('estado'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('html', 'Html'); ?></th>
						<td><?= $this->Form->input('html'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('asunto', 'Asunto'); ?></th>
						<td><?= $this->Form->input('asunto'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('destinatario_email', 'Destinatario email'); ?></th>
						<td><?= $this->Form->input('destinatario_email'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('destinatario_nombre', 'Destinatario nombre'); ?></th>
						<td><?= $this->Form->input('destinatario_nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('remitente_email', 'Remitente email'); ?></th>
						<td><?= $this->Form->input('remitente_email'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('remitente_nombre', 'Remitente nombre'); ?></th>
						<td><?= $this->Form->input('remitente_nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('cc_email', 'Cc email'); ?></th>
						<td><?= $this->Form->input('cc_email'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('bcc_email', 'Bcc email'); ?></th>
						<td><?= $this->Form->input('bcc_email'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('traza', 'Traza'); ?></th>
						<td><?= $this->Form->input('traza'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('proceso_origen', 'Proceso origen'); ?></th>
						<td><?= $this->Form->input('proceso_origen'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('procesado', 'Procesado'); ?></th>
						<td><?= $this->Form->input('procesado', array('class' => 'icheckbox')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('enviado', 'Enviado'); ?></th>
						<td><?= $this->Form->input('enviado', array('class' => 'icheckbox')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('reintentos', 'Reintentos'); ?></th>
						<td><?= $this->Form->input('reintentos'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('atachado', 'Atachado'); ?></th>
						<td><?= $this->Form->input('atachado'); ?></td>
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
