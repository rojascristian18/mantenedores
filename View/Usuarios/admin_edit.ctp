<div class="page-title">
	<h2><span class="fa fa-user"></span> Mantenedores</h2>
</div>
<div class="page-content-wrap">
    <div class="row">                        
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="panel panel-default form-horizontal">                                
                <div class="panel-body">
                    <h3><span class="fa fa-user"></span> <?= $this->request->data['Usuario']['nombre'];?> <?= $this->request->data['Usuario']['apellidos'];?></h3>
                    <div class="text-center">
                        <?= $imagenPerfil = (!empty($this->request->data['Usuario']['imagen'])) ? $this->Html->image($this->request->data['Usuario']['imagen']['square'], array('class' => 'img-thumbnail', 'alt' => $this->request->data['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-thumbnail', 'alt' => $this->request->data['Usuario']['nombre'])) ; ?>
                    </div>                               
                </div>
                <div class="panel-body form-group-separated">
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            Mantenedor <?= $this->Html->estrellas($this->request->data['Usuario']['calificacion_media']); ?>
                        </div>                            
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">#ID</label>
                        <div class="col-md-9 col-xs-7">
                            <span class="control-label"><?= $this->request->data['Usuario']['id']; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Email</label>
                        <div class="col-md-9 col-xs-7">
                            <span class="control-label"><?= $this->request->data['Usuario']['email']; ?></span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-8 col-xs-12">
            <div class="panel panel-default form-horizontal">
                <div class="panel-body">
                    <h3><span class="fa fa-pencil"></span> Perfil</h3>
                </div>
                <div class="panel-body form-group-separated">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Nombre</label>
                        <div class="col-md-9 col-xs-7">
                            <span class="control-label"><?= $this->request->data['Usuario']['nombre']; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Apellidos</label>
                        <div class="col-md-9 col-xs-7">
                            <span class="control-label"><?= $this->request->data['Usuario']['apellidos']; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label" style="line-height: 15px;">Rut<small style="display: block;">* Sin puntos ni guión</small></label>
                        <div class="col-md-9 col-xs-7">
                            <span class="control-label"><?= $this->request->data['Usuario']['rut']; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Fono</label>
                        <div class="col-md-9 col-xs-7 form-inline">
                        	<span class="control-label"> +<?= $this->request->data['Codigopaise']['nombre']; ?> <?= $this->request->data['Usuario']['fono']; ?></span>
                        </div>
                    </div>                                          
                </div>
            </div>
            <div class="panel panel-default tabs" id="tabs-perfil">
                <ul class="nav nav-tabs">
                    <li><a href="#tareas" data-toggle="tab">Tareas Finalizadas</a></li>
                    <li class="active"><a href="#cuentas" data-toggle="tab">Datos bancarios</a></li>   
                    <li><a href="#calificaciones" data-toggle="tab">Calificaciones</a></li>                                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane panel-body" id="tareas">
                    <? foreach ($this->request->data['Tarea'] as $indice => $tarea) : ?>                                                                      
                        <div class="list-group list-group-contacts border-bottom">
                            <?= $this->Html->link(
                                '<span class="contacts-title">#' . $tarea['id'] .'</span> ' . 
                                '<span class="contacts-title">[' . $tarea['Tienda']['nombre'] . '] ' . $tarea['nombre'] . '</span>' .
                                '<p>Finalizada el ' . $tarea['fecha_finalizado'] . '</p>' . 
                                '<div class="list-group-controls">
                                    <label class="label label-form label-info">Valor ' . CakeNumber::currency($tarea['precio'], 'CLP') . '</label>
                                </div>',
                                array('controller' => 'tareas', 'action' => 'view', $tarea['id']),
                                array('class' => 'list-group-item', 'escape' => false)
                                ); ?>                                                                                        
                        </div>
                    <? endforeach; ?>
                    </div>
                    <div class="tab-pane panel-body active" id="cuentas">                                        
                        <p>Cuenta bancaria del mantenedor.</p>
                        <div class="table table-stripped">
                            <table class="table">
                                <thead>
                                    <th>Banco</th>
                                    <th>Tipo de cuenta</th>
                                    <th>Cuenta</th>
                                </thead>
                                <tbody>
                                    <? if ( ! empty($this->request->data['Cuenta']) ) : ?>
                                        <? foreach ($this->request->data['Cuenta'] as $ix => $cuenta) : ?>
                                        <tr>
                                            <td>
                                            	<?= $cuenta['Banco']['nombre'];?>
                                            </td>
                                            <td>
                                            	<?= $cuenta['TipoCuenta']['nombre'];?>
                                            </td>
                                            <td>
                                                <?= $cuenta['cuenta']; ?>
                                            </td>
                                        </tr>
                                        <? endforeach; ?>
                                    <? else : ?>
                                    	<tr>
                                    		<td>No tiene cuenta asociada.</td>
                                    	</tr>
                                    <? endif; ?>
                                </tbody>
                            </table>
                        </div>                   
                    </div>
                    <div class="tab-pane panel-body" id="calificaciones">
                        <p>¿Cómo va el trabajo del mantenedor?</p>
                        <div class="table-scroll">
                            <table class="table table-stripped">
                                <thead>
                                    <th>Calificación</th>
                                    <th>Comentario</th>
                                </thead>
                                <tbody>
                                    <? foreach( $this->request->data['Calificacion'] as $calificacion ) : ?>
                                        <tr>
                                            <td><?= $this->Html->estrellas($calificacion['calificacion']); ?></td>
                                            <td><?= $calificacion['mensaje']; ?></td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                                                                  
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default form-horizontal">
                <div class="panel-body">
                    <h3><span class="fa fa-info-circle"></span> Información rápida</h3>
                    <p>algunos datos rápidos sobre el mantenedor.</p>
                </div>
                <div class="panel-body form-group-separated">                                    
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label" style="line-height: 15px;">Último acceso</label>
                        <div class="col-md-8 col-xs-7 line-height-30"><?= $this->request->data['Usuario']['ultimo_acceso']; ?></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label" >Ingreso</label>
                        <div class="col-md-8 col-xs-7 line-height-30"><?= $this->request->data['Usuario']['created']; ?></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label" style="line-height: 15px;">Tareas finalizadas</label>
                        <div class="col-md-8 col-xs-7 line-height-30"><?= $this->request->data['Usuario']['count_tareas_terminadas']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-xs-12">
    		<div class="panel panel-default tabs" id="tabs-pagos">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#nopagados" data-toggle="tab">Tareas no pagadas </a></li>
                    <li><a href="#pagados" data-toggle="tab">Tareas pagadas</a></li>                                      
                </ul>
                <div class="tab-content">
                    <div class="tab-pane panel-body active" id="nopagados">
                    	<table class="table table-striped table-bordered">
                    		<thead>
                    			<th>
                    				<input type="checkbox" id="seleccionar-todo-lista" value="0"> 
                    				<button type="button" class="btn btn-primary" data-toggle="modal" id="btn-pagar-modal" data-target="#pagarModal">Pagar</button>
                    				<!-- Modal Pagar -->
									<div class="modal fade" id="pagarModal" tabindex="-1" role="dialog" aria-labelledby="pagarModalLabel">
										<div class="modal-dialog" role="document">
                                            <?= $this->Form->create('Usuario', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
                                                    <?= $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $this->request->data['Usuario']['id'])); ?>
                                                    <?= $this->Form->input('id_pago', array('type' => 'hidden')); ?>
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" id="btn-cerrar-modal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="pagarModalLabel">Detalles del pago</h4>
												</div>
												<div class="modal-body">
													<div class="form-group col-xs-12 col-sm-6">
														<?=$this->Form->label('monto_pagado', _('Monto pagado'));?>
														<?=$this->Form->input('monto_pagado'); ?>
													</div>
													<div class="form-group col-xs-12 col-sm-6">
														<?=$this->Form->label('codigo_pago', _('Código de transferencia'));?>
														<?=$this->Form->input('codigo_pago', array('placeholder' => 'Ingrese código de la operación')); ?>
													</div>
													<div class="form-group col-xs-12 col-sm-6">
														<?=$this->Form->label('medio_de_pago', _('Medio de pago'));?>
														<?=$this->Form->input('medio_de_pago', array('placeholder' => 'Efectivo, transferencia, cheque, etc.')); ?>
													</div>
                                                    <div class="form-group col-xs-12 col-sm-6">
                                                        <?=$this->Form->label('fecha_pagado', _('Fecha del pago'));?>
                                                        <?=$this->Form->input('fecha_pagado', array('class' => 'form-control datetimepicker')); ?>
                                                    </div>
													<div class="form-group col-xs-12 col-sm-12">
														<?=$this->Form->label('detalle', _('Detalle o comentario'));?>
														<?=$this->Form->textarea('detalle', array('class' => 'form-control', 'placeholder' => 'Agregue información adicional del pago realizado.')); ?>
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													<button type="submit" class="btn btn-primary">Guardar</button>
												</div>
                                                <?= $this->Form->end(); ?>
											</div>
										</div>
									</div>
                    			</th>
                    			<th>Tarea</th>
                    			<th>Tienda</th>
                    			<th>Cuenta</th>
                    			<th>Porcentaje <br>de avance</th>
                    			<th>Monto a pagar</th>
                    			<th>Creado</th>
                                <th></th>
                    		</thead>
                    	<? foreach ($this->request->data['Pago'] as $key => $pago) : ?>
                    	<? if ( ! $pago['pagado'] ) : ?>
                    		<tr>
                    			<td><input type="checkbox" class="lista-check" value="<?=$pago['id'];?>"></td>
                    			<td> #<?= $pago['tarea_id']; ?> <?= $pago['nombre_tarea']; ?></td>
                    			<td><?= $pago['Tienda']['nombre'];?></td>
                    			<td><?= $pago['Cuenta']['cuenta']?></td>
                    			<td><?= $pago['porcentaje_realizado'];?>%</td>
                    			<td><input type="hidden" value="<?= $pago['monto_a_pagar']; ?>" class="montoAPagar"> <?= CakeNumber::currency($pago['monto_a_pagar'], 'CLP'); ?></td>
                    			<td><?= $pago['created']; ?></td>
                                <td><?=$this->Html->link(_('Detalle'), array('controller' => 'pagos', 'action' => 'detail', $pago['id']), array('class' => 'btn btn-info btn-xs'));?></td>
                    		</tr>
                    	<? endif; ?>
                    	<? endforeach; ?>
                    	</table>
                    </div>
                    <div class="tab-pane panel-body" id="pagados">                                        
                        <table class="table table-striped table-bordered">
                    		<thead>
                    			<th>Tarea</th>
                    			<th>Tienda</th>
                    			<th>Cuenta</th>
                    			<th>Porcentaje <br>de avance</th>
                    			<th>Monto a pagar</th>
                    			<th>Monto pagado</th>
                    			<th>Código de <br>transferencia</th>
                    			<th>Medio de pago</th>
                    			<th>Detalle</th>
                    			<th>Fecha pagado</th>
                                <th></th>
                    		</thead>
                    	<? foreach ($this->request->data['Pago'] as $key => $pago) : ?>
                    	<? if ( $pago['pagado'] ) : ?>
                    		<tr>
                    			<td> #<?= $pago['tarea_id']; ?> <?= $pago['nombre_tarea']; ?></td>
                    			<td><?= $pago['Tienda']['nombre'];?></td>
                    			<td><?= $pago['Cuenta']['cuenta']?></td>
                    			<td><?= $pago['porcentaje_realizado'];?>%</td>
                    			<td><?= CakeNumber::currency($pago['monto_a_pagar'], 'CLP'); ?></td>
                    			<td><?= CakeNumber::currency($pago['monto_pagado'], 'CLP'); ?></td>
                    			<td><?= $pago['codigo_pago']; ?></td>
                    			<td><?= $pago['medio_de_pago']; ?></td>
                    			<td><?= $pago['detalle']; ?></td>
                    			<td><?= $pago['fecha_pagado']; ?></td>
                                <td><?=$this->Html->link(_('Detalle'), array('controller' => 'pagos', 'action' => 'detail', $pago['id']), array('class' => 'btn btn-info btn-xs'));?></td>
                    		</tr>
                    	<? endif; ?>
                    	<? endforeach; ?>
                    	</table>
                    </div>
                                                                               
                </div>
            </div>
    	</div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->                                                 