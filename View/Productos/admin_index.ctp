<div class="page-title">
	<h2><span class="fa fa-list"></span> Productos</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Productos</h3>
					<div class="btn-group pull-right">
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Producto', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
													<th><?= $this->Paginator->sort('tarea_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('grupocaracteristica_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('proveedor_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('fabricante_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('categoria_deafult_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
													<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $productos as $producto ) : ?>
								<tr>
											<td><?= $this->Html->link($producto['Tarea']['nombre'], array('controller' => 'tareas', 'action' => 'edit', $producto['Tarea']['id'])); ?></td>
											<td><?= $this->Html->link($producto['Grupocaracteristica']['nombre'], array('controller' => 'grupocaracteristicas', 'action' => 'edit', $producto['Grupocaracteristica']['id'])); ?></td>
													<td><?= h($producto['Producto']['proveedor_id']); ?>&nbsp;</td>
													<td><?= h($producto['Producto']['fabricante_id']); ?>&nbsp;</td>
													<td><?= h($producto['Producto']['categoria_deafult_id']); ?>&nbsp;</td>
											<td>
										<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $producto['Producto']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
										<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $producto['Producto']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
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
