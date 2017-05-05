<div class="page-title">
	<h2><span class="fa fa-user"></span> Mantenedores</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de mentenedores</h3>
					<div class="btn-group pull-right">
					<? if ($permisos['agregar']) : ?>
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Mantenedor', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
					<? endif; ?>
					<? if ($permisos['exportar']) : ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					<? endif; ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table usuarios-tabla">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('imagen', 'Mantenedor', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('rut', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('apellidos', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('email', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('calificacion_media', 'Calificaciones', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $usuarios as $usuario ) : ?>
								<tr>
									<td><?= $imagenPerfil = (!empty($usuario['Usuario']['imagen'])) ? $this->Html->image($usuario['Usuario']['imagen']['mini'], array('class' => 'img-responsive img-circle image-perfil-list', 'alt' => $usuario['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-responsive img-circle image-perfil-list', 'alt' => $usuario['Usuario']['nombre'])) ; ?></td>
									<td valign="center"><?= h($usuario['Usuario']['rut']); ?>&nbsp;</td>
									<td valign="center"><?= h($usuario['Usuario']['nombre']); ?>&nbsp;</td>
									<td valign="center"><?= h($usuario['Usuario']['apellidos']); ?>&nbsp;</td>
									<td valign="center"><?= h($usuario['Usuario']['email']); ?>&nbsp;</td>
									<td valign="center"><?= $this->Html->estrellas($usuario['Usuario']['calificacion_media']); ?>&nbsp;</td>
									<td valign="center">
									<? if ($permisos['editar']) : ?>
										<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $usuario['Usuario']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['eliminar']) : ?>
										<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $usuario['Usuario']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['activar']) : ?>
										<? if ($usuario['Usuario']['activo']) : ?>
											<?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $usuario['Usuario']['id']), array('class' => 'btn btn-xs btn-primary confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?>
										<? else : ?>
											<?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $usuario['Usuario']['id']), array('class' => 'btn btn-xs btn-success confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?>
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
