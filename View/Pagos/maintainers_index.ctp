<div class="page-title">
	<h2><span class="fa fa-money"></span> Mis Pagos</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<?= $this->Form->create('Filtro', array('url' => array('controller' => 'pagos', 'action' => 'index'), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
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
					<h3 class="panel-title">Listado de Pagos</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									
									<th><?= $this->Paginator->sort('nombre_tarea', 'Tarea', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('monto_a_pagar', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('pagado', 'Estado', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('monto_pagado', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('cuenta_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('created', 'Creada', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $pagos as $pago ) : ?>
								<tr>
									<td><?= $pago['Pago']['nombre_tarea']; ?></td>
									<td><?= $pago['Pago']['monto_a_pagar']; ?></td>
									<td><?= ($pago['Pago']['pagado'] ? '<i class="fa fa-check"></i> Pagado' : '<i class="fa fa-remove"></i> No pagado'); ?>&nbsp;</td>
									<td><?= $pago['Pago']['monto_pagado']; ?></td>
									<td><?= $pago['Cuenta']['cuenta']; ?></td>
									<td><?= $pago['Pago']['created']; ?></td>
									<td>
                                      <?= $this->Html->link('<i class="fa fa-eye"></i> Detalle', array('action' => 'detail', $pago['Pago']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false)); ?>
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
