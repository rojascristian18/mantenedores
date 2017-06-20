<div class="page-title">
	<h2><span class="fa fa-crop"></span> Unidades de medidas</h2>
</div>
<div class="page-content-wrap">
	<? if ($permisos['agregar']): ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo</h3>
				</div>
				<div class="panel-body">
					<?= $this->Form->create('UnidadMedida', array('controller' => 'unidadMedidas', 'action' => 'add'), array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
					<div class="col-sm-3 col-xs-12">
						<div class="form-group">
							<?= $this->Form->label('nombre', 'Nombre'); ?>
							<?= $this->Form->input('nombre', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>
						</div>
					</div>
					<div class="col-sm-3 col-xs-12">
						<div class="form-group">
							<?= $this->Form->label('tipo_campo', 'Tipo de campo'); ?>
							<?= $this->Form->select('tipo_campo', array(
								'text' => 'Texto',
								'number' => 'Sólo números'
							) , array('class' => 'form-control', 'div' => false, 'label' => false, 'empty' => false)); ?>
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<div class="form-group">
							<?= $this->Form->label('ejemplo', 'Ejemplo para mantenedor'); ?>
							<?= $this->Form->input('ejemplo', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>
						</div>
					</div>
					<div class="col-sm-2 col-xs-12">
						<div class="form-group">
							<?= $this->Form->button('<i class="fa fa-plus" aria-hidden="true"></i> Agregar', array('type' => 'submit', 'escape' => false, 'class' => 'btn btn-buscar btn-success btn-block')); ?>
						</div>
					</div>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
<? endif;?>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Unidades de medidas</h3>
					<div class="btn-group pull-right">
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('tipo_campo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('ejemplo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('activo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('created', 'Fecha de creación', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $unidadMedidas as $unidadMedida ) : ?>
								<tr>
									<td><?= h($unidadMedida['UnidadMedida']['nombre']); ?>&nbsp;</td>
									<td><?= $campo = ($unidadMedida['UnidadMedida']['tipo_campo'] == 'text') ? 'Texto' : 'Sólo números' ; ?>&nbsp;</td>
									<td><?= h($unidadMedida['UnidadMedida']['ejemplo']); ?>&nbsp;</td>
									<td><?= ($unidadMedida['UnidadMedida']['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td><?= h($unidadMedida['UnidadMedida']['created']); ?>&nbsp;</td>
									<td>
									<? if ($permisos['editar']) : ?>
										<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $unidadMedida['UnidadMedida']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['eliminar']) : ?>
										<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $unidadMedida['UnidadMedida']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['activar']) : ?>
										<? if ($unidadMedida['UnidadMedida']['activo']) : ?>
											<?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $unidadMedida['UnidadMedida']['id']), array('class' => 'btn btn-xs btn-primary confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?>
										<? else : ?>
											<?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $unidadMedida['UnidadMedida']['id']), array('class' => 'btn btn-xs btn-success confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?>
										<? endif; ?>
									<? endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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
