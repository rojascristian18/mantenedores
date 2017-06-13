<div class="page-title">
	<h2><span class="fa fa-question-circle"></span> Preguntas Frecuentes</h2>
</div>
<?= $this->Form->create('PreguntaFrecuente', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id');?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Pregunta Frecuente</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('pregunta', 'Pregunta'); ?></th>
								<td><?= $this->Form->input('pregunta'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('respuesta', 'Respuesta'); ?></th>
								<td><?= $this->Form->input('respuesta', array('class' => 'summernote')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('orden', 'Orden'); ?></th>
								<td><?= $this->Form->input('orden'); ?></td>
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
