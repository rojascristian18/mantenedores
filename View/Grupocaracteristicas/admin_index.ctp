<div class="page-title">
	<h2><span class="fa fa-folder"></span> Grupos de características</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<?= $this->Form->create('Filtro', array('url' => array('controller' => 'grupocaracteristicas', 'action' => 'index'), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Filtro de busqueda</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-8 col-xs-12">
						<div class="form-group">
							<label>Coincidencia</label>
							<? if ( ! empty($this->request->params['named']['palabra']) ) : ?>
								<?=$this->Form->input('palabra', array('class' => 'form-control', 'placeholder' => 'Ingrese nombre del grupo', 'value' => $this->request->params['named']['palabra']));?>
							<? else : ?>
								<?=$this->Form->input('palabra', array('class' => 'form-control', 'placeholder' => 'Ingrese nombre del grupo'));?>
							<? endif; ?>
                            
						</div>
					</div>
					<div class="col-sm-2 col-xs-12">
						<div class="form-group">
							<?= $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i> Buscar', array('type' => 'submit', 'escape' => false, 'class' => 'btn btn-buscar btn-success btn-block')); ?>
						</div>
					</div>
					<?= $this->Form->end(); ?>
					<div class="col-sm-2 col-xs-12">
						<div class="form-group">
							<?= $this->Html->link('<i class="fa fa-ban" aria-hidden="true"></i> Limpiar filtro', array('action' => 'index'), array('class' => 'btn btn-buscar btn-primary btn-block', 'escape' => false)); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<? if ( !empty($textoBuscar) ) : ?>
			<div class="col-xs-12">
				<p><?=sprintf('<b>%d resultado encontrados para "%s"</b>  ', $totalMostrados, $textoBuscar)?></p>
			</div>
		<? endif; ?>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de grupos de características</h3>
					<div class="btn-group pull-right">
					<? if ($permisos['agregar']) : ?>
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Grupo', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
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
									<th><?= $this->Paginator->sort('id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('tienda_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('desripcion', 'Descripción', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('count_caracteristicas', 'Cant. características', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('count_categorias', 'Cant. categorias', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('activo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $grupocaracteristicas as $grupocaracteristica ) : ?>
								<tr>
									<td><?= h($grupocaracteristica['Grupocaracteristica']['id']); ?>&nbsp;</td>
									<td><?= h($grupocaracteristica['Tienda']['nombre']); ?>&nbsp;</td>
									<td><?= h($grupocaracteristica['Grupocaracteristica']['nombre']); ?>&nbsp;</td>
									<td><?= h($grupocaracteristica['Grupocaracteristica']['desripcion']); ?>&nbsp;</td>
									<td><?= h($grupocaracteristica['Grupocaracteristica']['count_caracteristicas']); ?>&nbsp;</td>
									<td><?= h($grupocaracteristica['Grupocaracteristica']['count_categorias']); ?>&nbsp;</td>
									<td><?= ($grupocaracteristica['Grupocaracteristica']['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td>
									<div class="btn-group">
                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle" aria-expanded="true"><span class="fa fa-cog"></span> Acciones</a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li role="presentation" class="dropdown-header">Seleccione</li>
                                            <? if ($permisos['editar']) : ?>
												<li><?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $grupocaracteristica['Grupocaracteristica']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
												<li><?= $this->Html->link('<i class="fa fa-clone"></i> Clonar', array('action' => 'clonar', $grupocaracteristica['Grupocaracteristica']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
											<? endif; ?>

											<? if ($permisos['activar']) : ?>
												<? if ($grupocaracteristica['Grupocaracteristica']['activo']) : ?>
													<li><?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $grupocaracteristica['Grupocaracteristica']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?></li>
												<? else : ?>
													<li><?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $grupocaracteristica['Grupocaracteristica']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?></li>
												<? endif; ?>
											<? endif; ?>
											
											<? if ($permisos['eliminar']) : ?>
												<li><?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $grupocaracteristica['Grupocaracteristica']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?></li>
											<? endif; ?>                                            
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
