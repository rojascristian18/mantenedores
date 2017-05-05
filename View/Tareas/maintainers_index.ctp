<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span> Mis Tareas</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12 glosario">
			<h4>Glosario</h4>
			<div class="table-responsive">
				<table class="table tabla-sin-bordes">
					<tr>
						<td style="width: 77px;"><label class="label label-info">En progreso</label></td>
						<td>Iniciaste el trabajo en la tarea.</td>
					</tr>
					<tr>
						<td><label class="label label-warning">En revision</label></td>
						<td>El administrador está revisando tu tarea.</td>
					</tr>
					<tr>
						<td><label class="label label-danger">Rechazado</label></td>
						<td>El administrador ha rechazado tu tarea.</td>
					</tr>
					<tr>
						<td><label class="label label-success">Finalizado</label></td>
						<td>El administrador ha dado por finalizada la tarea.</td>
					</tr>
					<tr>
						<td><label class="label label-default">Sin estado</label></td>
						<td>No se ha iniciado el trabajo en la tarea.</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?= $this->Form->create('Filtro', array('url' => array('controller' => 'tareas', 'action' => 'index'), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Filtro de busqueda</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Estado</label>
							<? if ( ! empty($this->request->params['named']['estado']) ) : ?>
								<?= $this->Form->select('estado', $estados, array('class' => 'form-control', 'empty' => 'Seleccione estado', 'value' => $this->request->params['named']['estado']));?>
							<? else : ?>
								<?= $this->Form->select('estado', $estados, array('class' => 'form-control', 'empty' => 'Seleccione un estado'));?>
							<? endif; ?>
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<label>Rango de fechas <small>(Creada)</small></label>
					<? if ( ! empty($this->request->params['named']['f_inicio'])  &&  ! empty($this->request->params['named']['f_inicio']) ) : ?>
						<div class="input-group">
							<?= $this->Form->input('f_inicio', array('class' => 'form-control datepicker', 'type' => 'text', 'value' => $this->request->params['named']['f_inicio']));?>
                            <span class="input-group-addon add-on"> - </span>
                            <?= $this->Form->input('f_final', array('class' => 'form-control datepicker', 'type' => 'text', 'value' => $this->request->params['named']['f_final']));?>
                        </div>
                    <? else : ?>
                    	<div class="input-group">
							<?= $this->Form->input('f_inicio', array('class' => 'form-control datepicker', 'type' => 'text'));?>
                            <span class="input-group-addon add-on"> - </span>
                            <?= $this->Form->input('f_final', array('class' => 'form-control datepicker', 'type' => 'text'));?>
                        </div>
                    <? endif; ?>
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
					<h3 class="panel-title">Listado de Tareas</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('nombre', 'Tarea', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('administrador_id', 'Admnistrador', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('iniciado', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('fecha_entrega', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('porcentaje_realizado', 'Avanzado', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><a><?= __('Estado'); ?></a></th>
									<th><?= $this->Paginator->sort('created', 'Creada', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $tareas as $tarea ) : ?>
								<tr>
									<td><?= $tarea['Tarea']['nombre']; ?></td>
									<td><?= $tarea['Administrador']['nombre']; ?></td>
									<td><?= ($tarea['Tarea']['iniciado'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td><?= $tarea['Tarea']['fecha_entrega']; ?></td>
									<td><?= $tarea['Tarea']['porcentaje_realizado']; ?>%</td>
									<td>
										<? if ($tarea['Tarea']['en_progreso']) : ?>
											<label class="label label-info">En progreso</label>
										<? endif; ?>
										<? if ($tarea['Tarea']['en_revision']) : ?>
											<label class="label label-warning">En revision</label>
										<? endif; ?>
										<? if ($tarea['Tarea']['rechazado']) : ?>
											<label class="label label-danger">Rechazado</label>
										<? endif; ?>
										<? if ($tarea['Tarea']['finalizado']) : ?>
											<label class="label label-success">Finalizado</label>
										<? endif; ?>
										<? if ( ! $tarea['Tarea']['en_progreso'] && ! $tarea['Tarea']['en_revision'] && ! $tarea['Tarea']['finalizado']) : ?>
											<label class="label label-default">Sin estado</label>
										<? endif; ?>
									</td>
									<td><?= $tarea['Tarea']['created']; ?></td>
									<td>
                                        <? if (!$tarea['Tarea']['iniciado'] && !$tarea['Tarea']['en_progreso'] && !$tarea['Tarea']['en_revision'] && !$tarea['Tarea']['rechazado'] && !$tarea['Tarea']['finalizado'] ) : ?>
                                            <?= $this->Html->link('<i class="fa fa-hourglass-start"></i> Iniciar tarea', array('action' => 'start', $tarea['Tarea']['id']), array('class' => 'btn btn-success btn-xs', 'rel' => 'tooltip', 'title' => 'Iniciar esta tarea', 'escape' => false)); ?>
                                        <? endif; ?>
                                        <? if ($tarea['Tarea']['iniciado'] && $tarea['Tarea']['en_progreso'] ) : ?>
											<?= $this->Html->link('<i class="fa fa-play"></i> Continuar trabajando', array('action' => 'work', $tarea['Tarea']['id']), array('class' => 'btn btn-success btn-xs', 'rel' => 'tooltip', 'title' => 'Trabajar en esta tarea', 'escape' => false)); ?>
										<? endif;?>
										<? if ($tarea['Tarea']['iniciado'] && $tarea['Tarea']['rechazado'] ) : ?>
											<?= $this->Html->link('<i class="fa fa-play"></i> Volver a trabajar', array('action' => 'work', $tarea['Tarea']['id']), array('class' => 'btn btn-success btn-xs', 'rel' => 'tooltip', 'title' => 'Trabajar en esta tarea', 'escape' => false)); ?>
										<? endif;?>
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
