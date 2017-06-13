<div class="page-title">
	<h2><span class="fa fa-question-circle"></span> Preguntas Frecuentes</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Preguntas Frecuentes</h3>
					<div class="btn-group pull-right">
						<? if ($permisos['agregar']) : ?>
							<?= $this->Html->link('<i class="fa fa-plus"></i> Nueva Pregunta Frecuente', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<? endif; ?>
						<? if ($permisos['exportar']) : ?>
							<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
						<? endif; ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?= $this->Form->create('PreguntaFrecuente', array('action' => 'ordenar'), array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('orden', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('pregunta', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('respuesta', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('slug', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('activo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody class="js-generico-contenedor-sort">
								<?php foreach ( $preguntaFrecuentes as $ix => $preguntaFrecuente ) : ?>
								<tr class="ui-state-default">
									<td class="js-generico-orden" data-id="<?=$preguntaFrecuente['PreguntaFrecuente']['id'];?>"><i class="fa fa-bars"></i>&nbsp;
									<?= $this->Form->input(sprintf('%d.id', $ix), array('type' => 'hidden'));?>
									<?= $this->Form->input(sprintf('%d.orden', $ix), array('type' => 'hidden', 'class' => 'order-input')); ?>
									</td>
									<td><?= h($preguntaFrecuente['PreguntaFrecuente']['pregunta']); ?>&nbsp;</td>
									<td><?= $this->Text->truncate($preguntaFrecuente['PreguntaFrecuente']['respuesta'], 150); ?>&nbsp;</td>
									<td><?= h($preguntaFrecuente['PreguntaFrecuente']['slug']); ?>&nbsp;</td>
									<td><?= ($preguntaFrecuente['PreguntaFrecuente']['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td>
									<? if ($permisos['editar']) : ?>
										<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $preguntaFrecuente['PreguntaFrecuente']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['eliminar']) : ?>
										<?= $this->Html->link('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $preguntaFrecuente['PreguntaFrecuente']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['activar']) : ?>
										<? if ($preguntaFrecuente['PreguntaFrecuente']['activo']) : ?>
											<?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $preguntaFrecuente['PreguntaFrecuente']['id']), array('class' => 'btn btn-xs btn-primary confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?>
										<? else : ?>
											<?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $preguntaFrecuente['PreguntaFrecuente']['id']), array('class' => 'btn btn-xs btn-success confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?>
										<? endif; ?>
									<? endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right">
				<ul class="pagination">
					<?= $this->Paginator->prev('« Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'first disabled hidden')); ?>
					<?= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'modulus' => 2, 'currentClass' => 'active', 'separator' => '')); ?>
					<?= $this->Paginator->next('Siguiente »', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'last disabled hidden')); ?>
				</ul>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
