<div class="page-title">
	<h2><span class="fa fa-money"></span> Pago #<?=$pago['Pago']['id']; ?></h2>
</div>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-body">
					<h3><span class="fa fa-money"></span> Información del pago</h3>
				</div>                                
                <div class="panel-body">
                	<div class="table-responsive">
                		<table class="table table-bordered">
                			<tr>
                				<th><?= _('Tarea'); ?></th>
                				<td><?= $pago['Pago']['nombre_tarea']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Porcentaje realizado de la tarea'); ?></th>
                				<td><?= $pago['Pago']['porcentaje_realizado']; ?>%</td>
                			</tr>
                			<tr>
                				<th><?= _('Monto a pagar'); ?></th>
                				<td><?= CakeNumber::currency($pago['Pago']['monto_a_pagar'], 'CLP'); ?></td>
                			</tr>
                			<? if ($pago['Pago']['pagado']) : ?>
                			<tr>
                				<th><?= _('Monto pagado'); ?></th>
                				<td><?= CakeNumber::currency($pago['Pago']['monto_pagado'], 'CLP'); ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Código de transferencia'); ?></th>
                				<td><?= $pago['Pago']['codigo_pago']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Medio de pago'); ?></th>
                				<td><?= $pago['Pago']['medio_de_pago']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Detalle u observación del pago'); ?></th>
                				<td><?= $pago['Pago']['detalle']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Fecha del pago'); ?></th>
                				<td><?= $pago['Pago']['fecha_pagado']; ?></td>
                			</tr>
                			<? endif; ?>
                			<tr>
                				<th><?= _('Pago creado'); ?></th>
                				<td><?= $pago['Pago']['created']; ?></td>
                			</tr>
                		</table>
                	</div>
                </div>
            </div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-body">
					<h3><span class="fa fa-tasks"></span> Tarea</h3>
				</div>                                
                <div class="panel-body">
                	<div class="table-responsive">
                		<table class="table table-bordered">
                			<tr>
                				<th><?= _('#ID'); ?></th>
                				<td><?= $pago['Tarea']['id']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Nombre'); ?></th>
                				<td><?= $pago['Tarea']['nombre']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Fecha de entrega'); ?></th>
                				<td><?= $pago['Tarea']['fecha_entrega']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Precio'); ?></th>
                				<td><?= CakeNumber::currency($pago['Tarea']['precio'], 'CLP'); ?></td>

                			</tr>
                			<tr>
                				<th><?= _('Productos a cargar'); ?></th>
                				<td><?= $pago['Tarea']['cantidad_productos']; ?></td>
                			</tr>
                			<tr>
                				<th><?= _('Porcentaje de avance'); ?></th>
                				<td><?= $pago['Tarea']['porcentaje_realizado']; ?>%</td>
                			</tr>
                			<? if ($pago['Tarea']['iniciado']) : ?>
                			<tr>
                				<th><?= _('Fecha de inicio <br>del trabajo'); ?></th>
                				<td><?= $pago['Tarea']['fecha_iniciado']; ?></td>
                			</tr>
                			<? endif; ?>
                			<tr>
                				<th><?= _('Estado'); ?></th>
                				<td>	
                					<? if ($pago['Tarea']['en_progreso']) : ?>
                					<label class="label label-info">
                						<?= _('En progreso'); ?>
                					</label>	
                					<? endif; ?>
                					<? if ($pago['Tarea']['en_revision']) : ?>
                					<label class="label label-warning">
                						<?= _('En revisión'); ?>
                					</label>	
                					<? endif; ?>
                					<? if ($pago['Tarea']['rechazado']) : ?>
                					<label class="label label-danger">
                						<?= _('Rechazado'); ?>
                					</label>	
                					<? endif; ?>
                					<? if ($pago['Tarea']['finalizado']) : ?>
                					<label class="label label-success">
                						<?= _('Finalizado'); ?>
                					</label>	
                					<? endif; ?>
                					<? if (!$pago['Tarea']['iniciado']) : ?>
                					<label class="label label-default">
                						<?= _('Sin estado'); ?>
                					</label>	
                					<? endif; ?>
                				</td>
                			</tr>
                			<? if ($pago['Tarea']['finalizado']) : ?>
                			<tr>
                				<th><?= _('Fecha finalizado'); ?></th>
                				<td><?= $pago['Tarea']['fecha_finalizado']; ?></td>
                			</tr>
                			<? endif; ?>
                		</table>
                	</div>
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-body">
					<h3><span class="fa fa-shopping-bag"></span> Productos cargados</h3>
				</div>                                
                <div class="panel-body">
                	<div class="table-responsive">
                		<table class="table table-bordered">
                            <thead>
                                <th>Referencia</th>
                                <th>Nombre</th>
                                <!--<th>Precio</th>-->
                                <th>Marca</th>
                                <th>Fabricante</th>
                                <!--<th>Proveedor</th>-->
                                <th>Estado</th>
                            </thead>
                        <? foreach ($productos as $ix => $producto) : ?>
                            <tr>
                                <td><?=$producto['Producto']['referencia'];?></td>
                                <td><?=$producto['Producto']['nombre_final'];?></td>
                                <!--<td><?=CakeNumber::currency($producto['Producto']['precio'], 'CLP');?></td>-->
                                <td><?=$producto['Marca']['nombre'];?></td>
                                <td><?=$producto['Fabricante']['name'];?></td>
                                <!--<td><?=$producto['Proveedor']['name'];?></td>-->
                                <td><?=$estado = ($producto['Producto']['aceptado']) ? _('Aceptado') : _('Rechazado') ; ?></td>
                            </tr>
                        <? endforeach?>
                        </table>
                	</div>
                </div>
            </div>
		</div>
		<div class="col-xs-12">
			<div class="pull-right">
				<?= $this->Html->link('Volver', array('controller' => 'usuarios', 'action' => 'edit', $pago['Pago']['usuario_id']), array('class' => 'btn btn-danger')) ?>
			</div>
		</div>
	</div>
</div>