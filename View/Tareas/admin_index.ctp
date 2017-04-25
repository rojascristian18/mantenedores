<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span> Tareas</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Tareas</h3>
					<div class="btn-group pull-right">
					<? if ($permisos['agregar']) : ?>
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nueva Tarea', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
					<? endif; ?>
					<? if ($permisos['exportar']) : ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					<? endif; ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('nombre', 'Tarea', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('usuario_id', 'Mantenedor', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('administrador_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('iniciado', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('fecha_entrega', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('porcentaje_realizado', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $tareas as $tarea ) : ?>
								<tr>
									<td><?= $tarea['Tarea']['nombre']; ?></td>
									<td><?= $this->Html->link($tarea['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $tarea['Usuario']['id'])); ?></td>
									<td><?= $tarea['Administrador']['nombre']; ?></td>
									<td><?= ($tarea['Tarea']['iniciado'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td><?= $tarea['Tarea']['fecha_entrega']; ?></td>
									<td><?= $tarea['Tarea']['porcentaje_realizado']; ?>%</td>
									<td>
									<div class="btn-group">
                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle" aria-expanded="true"><span class="fa fa-cog"></span> Acciones</a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li role="presentation" class="dropdown-header">Seleccione</li>
											<? if ($permisos['editar']) : ?>
												<li><?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $tarea['Tarea']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
											<? endif; ?>
											<? if ($permisos['eliminar']) : ?>
												<li><?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $tarea['Tarea']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?></li>
											<? endif; ?>
											<? if ($permisos['activar']) : ?>
												<? if ($tarea['Tarea']['activo']) : ?>
													<li><?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $tarea['Tarea']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?></li>
												<? else : ?>
													<li><?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $tarea['Tarea']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?></li>
												<? endif; ?>
											<? endif; ?>
											</ul>
										</li>                                                    
                                        </ul>
                                    </div>
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
