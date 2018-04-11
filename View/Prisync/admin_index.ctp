<div class="page-title">
	<h2><span class="fa fa-tags"></span> Prisync</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<?= $this->Form->create('Filtro', array('url' => array('controller' => 'prisync', 'action' => 'index'), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Filtro de busqueda</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-4 col-xs-12">
							<label>Nombre, referencia o grupo</label>
							<? if ( ! empty($this->request->params['named']['nombre']) ) : ?>
								<?= $this->Form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese nombre, referencia o tipo de herramienta', 'value' => $this->request->params['named']['nombre']));?>
							<? else : ?>
								<?= $this->Form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese nombre, referencia o tipo de herramienta'));?>
							<? endif; ?>
						</div>
						<div class="form-group col-sm-4 col-xs-12">
							<label>Tarea</label>
							<? if ( ! empty($this->request->params['named']['tarea']) ) : ?>
								<?= $this->Form->select('tarea', $tareas, array('class' => 'form-control', 'empty' => 'Seleccione tarea', 'value' => $this->request->params['named']['tarea']));?>
							<? else : ?>
								<?= $this->Form->select('tarea', $tareas, array('class' => 'form-control', 'empty' => 'Seleccione tarea'));?>
							<? endif; ?>
						</div>
						<div class="form-group col-sm-4 col-xs-12">
							<label>Mantenedor</label>
							<? if ( ! empty($this->request->params['named']['mantenedor']) ) : ?>
								<?= $this->Form->select('mantenedor', $mantenedores, array('class' => 'form-control', 'empty' => 'Seleccione estado', 'value' => $this->request->params['named']['mantenedor']));?>
							<? else : ?>
								<?= $this->Form->select('mantenedor', $mantenedores, array('class' => 'form-control', 'empty' => 'Seleccione un estado'));?>
							<? endif; ?>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-4 col-xs-12">
							<label>Marca</label>
							<? if ( ! empty($this->request->params['named']['marca']) ) : ?>
								<?= $this->Form->select('marca', $marcas, array('class' => 'form-control', 'empty' => 'Seleccione marca', 'value' => $this->request->params['named']['marca']));?>
							<? else : ?>
								<?= $this->Form->select('marca', $marcas, array('class' => 'form-control', 'empty' => 'Seleccione marca'));?>
							<? endif; ?>
						</div>
						<div class="form-group col-sm-4 col-xs-12">
							<label>Estado</label>
							<? if ( ! empty($this->request->params['named']['prisync']) ) : ?>
								<?= $this->Form->select('prisync', $prisync, array('class' => 'form-control', 'empty' => 'Seleccione estado', 'value' => $this->request->params['named']['prisync']));?>
							<? else : ?>
								<?= $this->Form->select('prisync', $prisync, array('class' => 'form-control', 'empty' => 'Seleccione estado'));?>
							<? endif; ?>
						</div>
						<div class="form-group col-sm-4 col-xs-12">
							<label>Id Prisync</label>
							<? if ( ! empty($this->request->params['named']['id_prisync']) ) : ?>
								<?= $this->Form->input('id_prisync', array('class' => 'form-control', 'placeholder' => 'Ingrese ID', 'value' => $this->request->params['named']['id_prisync']));?>
							<? else : ?>
								<?= $this->Form->input('id_prisync', array('class' => 'form-control', 'placeholder' => 'Ingrese ID'));?>
							<? endif; ?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="col-sm-2 col-xs-12 pull-right">
						<div class="form-group">
							<?= $this->Html->link('<i class="fa fa-ban" aria-hidden="true"></i> Limpiar filtro', array('action' => 'index'), array('class' => 'btn btn-primary btn-block', 'escape' => false)); ?>
						</div>
					</div>
					<div class="col-sm-2 col-xs-12 pull-right">
						<div class="form-group">
							<?= $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i> Buscar', array('type' => 'submit', 'escape' => false, 'class' => 'btn btn-success btn-block')); ?>
						</div>
					</div>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Productos  <small>(<?=sprintf('%d resultados de %d', $totalMostrados, $total)?>)</small></h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('tarea_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('nombre_final', 'Nombre', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('referencia', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('marca_id', 'Marca', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('en_tienda', sprintf('En %s', $this->Session->read('Tienda.nombre')), array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('en_prisync', 'En Prisync *', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('', 'Competidores', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<? if (empty($productos)) : ?>
									<tr>
										<td cols="7"><label>No hay productos que concuerden con su búsqueda</label></td>
									</tr>
								<? endif; ?>
								<? foreach ( $productos as $producto ) : ?>
								<tr>
									<td><?= h($producto['Tarea']['nombre']); ?></td>
									<td><?= h($producto['Producto']['nombre_final']); ?>&nbsp;</td>
									<td><?= h($producto['Producto']['referencia']); ?>&nbsp;</td>
									<td><?= h($producto['Marca']['nombre']); ?>&nbsp;</td>
									<td><?= (!$producto['Producto']['en_tienda']) ? '<i class="fa fa-close"></i>' : '<i class="fa fa-check"></i>'; ?>&nbsp;</td>
									<td><?= (!$producto['Producto']['en_prisync']) ? '<i class="fa fa-close"></i>' : '<i class="fa fa-check"></i>'; ?>&nbsp;</td>
									<td><?= count($producto['Competidor']); ?>&nbsp;</td>
									<td>
										<div class="btn-group">
	                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle" aria-expanded="true"><span class="fa fa-cog"></span> Acciones</a>
	                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
								            <? if ($permisos['editar'] && $producto['Producto']['en_tienda'] && empty($producto['Producto']['prisync_id'])) : ?>
												<li><?= $this->Html->link('<i class="fa fa-eye"></i> Publicar', array('action' => 'publish', $producto['Producto']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Publicar este registro', 'escape' => false)); ?></li>
											<? elseif($permisos['editar'] && $producto['Producto']['en_tienda'] && !empty($producto['Producto']['prisync_id'])) : ?>
												<li><?= $this->Html->link('<i class="fa fa-eye"></i> Editar', array('action' => 'editar', $producto['Producto']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
											<? endif; ?>
											<? if ($permisos['eliminar']) : ?>
												<li><?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $producto['Producto']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
												</li>
											<? endif; ?>
											</ul>
										</div>
									</td>
								</tr>
								<? endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="8">* Éste dato se actualiza cada 6 horas</td>
								</tr>
							</tfoot>
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
