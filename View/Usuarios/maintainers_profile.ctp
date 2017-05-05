<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-cogs"></span> Mi Perfil</h2>
</div>
<!-- END PAGE TITLE -->                     
<?= $this->Form->create('Usuario', array('class' => 'form-horizontal validate', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id');?>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">                        
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="panel panel-default">                                
                <div class="panel-body">
                    <h3><span class="fa fa-user"></span> <?= $this->request->data['Usuario']['nombre'];?> <?= $this->request->data['Usuario']['apellidos'];?></h3>
                    <p>Mantenedor <?= $this->Html->estrellas($this->request->data['Usuario']['calificacion_media']); ?></p>
                    <div class="text-center">
                        <?= $imagenPerfil = (!empty($this->request->data['Usuario']['imagen'])) ? $this->Html->image($this->request->data['Usuario']['imagen']['square'], array('class' => 'img-thumbnail', 'alt' => $this->request->data['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-thumbnail', 'alt' => $this->request->data['Usuario']['nombre'])) ; ?>
                    </div>                               
                </div>
                <div class="panel-body form-group-separated">
                    <div class="form-group">
                            <div class="col-md-12">
                                <a class="file-input-wrapper btn btn-default  fileinput btn-info btn-block">
                                    <span>Elije una nueva foto <small>(max 1MB)</small></span>
                                    <?= $this->Form->input('imagen', array('class' => 'fileinput btn-info', 'data-filename-placement' => 'inside', 'type' => 'file')); ?>
                                </a>
                            </div>                            
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">#ID</label>
                        <div class="col-md-9 col-xs-7">
                            <?= $this->Form->input('id', array('disabled' => 'disabled', 'type' => 'text')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Usuario</label>
                        <div class="col-md-9 col-xs-7">
                            <?= $this->Form->input('email'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">                                        
                        <div class="col-md-12 col-xs-12">
                            <a href="#" class="btn btn-danger btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_password">Actualizar contraseña</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3><span class="fa fa-pencil"></span> Perfil</h3>
                </div>
                <div class="panel-body form-group-separated">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Nombre</label>
                        <div class="col-md-9 col-xs-7">
                            <?= $this->Form->input('nombre'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Apellidos</label>
                        <div class="col-md-9 col-xs-7">
                            <?= $this->Form->input('apellidos'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label" style="line-height: 15px;">Rut<small style="display: block;">* Sin puntos ni guión</small></label>
                        <div class="col-md-9 col-xs-7">
                            <?= $this->Form->input('rut', array('class' => 'masked_rut form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Fono</label>
                        <div class="col-md-9 col-xs-7 form-inline">
                            <?= $this->Form->select('codigopais_id', $codigopaises, array('empty' => false, 'class' => 'form-control')); ?>&nbsp;<?= $this->Form->input('fono', array('class' => 'mask_fono form-control')); ?>
                        </div>
                    </div>                                          
                    <div class="form-group">
                        <div class="col-md-12 col-xs-5">
                            <button type="submit" class="btn btn-primary btn-rounded pull-right">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tareas" data-toggle="tab">Últimas Tareas Finalizadas</a></li>
                    <li><a href="#cuentas" data-toggle="tab">Datos bancarios</a></li>   
                    <li><a href="#pagos" data-toggle="tab">Pagos</a></li>                                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane panel-body active" id="tareas">
                    <? foreach ($tareas as $indice => $tarea) : ?>                                                                      
                        <div class="list-group list-group-contacts border-bottom">
                            <?= $this->Html->link(
                                '<span class="contacts-title">#' . $tarea['Tarea']['id'] .'</span> ' . 
                                '<span class="contacts-title">[' . $tarea['Tienda']['nombre'] . '] ' . $tarea['Tarea']['nombre'] . '</span>' .
                                '<p>Finalizada el ' . $tarea['Tarea']['fecha_finalizado'] . '</p>' . 
                                '<div class="list-group-controls">
                                    <label class="label label-form label-info">Valor ' . CakeNumber::currency($tarea['Tarea']['precio'], 'CLP') . '</label>
                                </div>',
                                array('controller' => 'tareas', 'action' => 'view', $tarea['Tarea']['id']),
                                array('class' => 'list-group-item', 'escape' => false)
                                ); ?>                                                                                        
                        </div>
                    <? endforeach; ?>
                    </div>
                    <div class="tab-pane panel-body" id="cuentas">                                        
                        <p>Agregue su cuenta bancaria principal. En esta cuenta se haran los pagos de las tareas finalizadas.</p>
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
                                                <?= $this->Form->input(sprintf('Cuenta.%d.id', $ix), array('type' => 'hidden')); ?>
                                                <?= $this->Form->select(sprintf('Cuenta.%d.banco_id', $ix), $bancos, array('class' => 'form-control', 'empty' => false)); ?></td>
                                            <td><?= $this->Form->select(sprintf('Cuenta.%d.tipo_cuenta_id', $ix), $tipoCuentas, array('class' => 'form-control', 'empty' => false)); ?></td>
                                            <td>
                                                <?= $this->Form->input(sprintf('Cuenta.%d.cuenta', $ix)); ?>
                                                <? if ( ! empty($cuenta['Cuenta']['otro']) ) : ?>
                                                <?= $this->Form->input(sprintf('Cuenta.%d.otro', $ix)); ?>
                                                <? endif; ?>
                                            </td>
                                        </tr>
                                        <? endforeach; ?>
                                    <? else : ?>
                                        <td><?= $this->Form->select('Cuenta.0.banco_id', $bancos, array('class' => 'form-control', 'empty' => false)); ?></td>
                                        <td>
                                            <?= $this->Form->select('Cuenta.0.tipo_cuenta_id', $tipoCuentas, array('class' => 'form-control', 'empty' => false)); ?>
                                        </td>
                                        <td>
                                            <?= $this->Form->input('Cuenta.0.otro', array('class' => 'form-control hide')); ?>
                                            <?= $this->Form->input('Cuenta.0.cuenta'); ?>        
                                        </td>
                                    <? endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-xs-5">
                                <button type="submit" class="btn btn-primary btn-rounded pull-right">Guardar</button>
                            </div>
                        </div>                               
                    </div>
                    <div class="tab-pane panel-body" id="pagos">                                        
                        <p>Acá se listan los últimos 10 pagos realizados a su cuenta.</p>
                        <? if ( ! empty($this->request->data['Pagos']) ) : ?>
                        <? foreach ($this->request->data['Pagos'] as $indice => $pago) : ?>                                                                      
                        <div class="list-group list-group-contacts border-bottom">
                            <?= $this->Html->link(
                                '<span class="contacts-title">#' . $tarea['Tarea']['id'] .'</span> ' . 
                                '<span class="contacts-title">[' . $tarea['Tienda']['nombre'] . '] ' . $tarea['Tarea']['nombre'] . '</span>' .
                                '<p>Finalizada el ' . $tarea['Tarea']['fecha_finalizado'] . '</p>' . 
                                '<div class="list-group-controls">
                                    <label class="label label-form label-info">Valor ' . CakeNumber::currency($tarea['Tarea']['precio'], 'CLP') . '</label>
                                </div>',
                                array('controller' => 'tareas', 'action' => 'view', $tarea['Tarea']['id']),
                                array('class' => 'list-group-item', 'escape' => false)
                                ); ?>                                                                                        
                        </div>
                        <? endforeach; ?>
                        <? else : ?>
                            <div class="list-group list-group-contacts border-bottom">
                                <label class="list-group-item">No registra pagos aún.</>
                            </div>
                        <? endif; ?>                            
                    </div>                                                                        
                </div>
                
            </div>

        </div>
        
        <div class="col-md-3">
            <div class="panel panel-default form-horizontal">
                <div class="panel-body">
                    <h3><span class="fa fa-info-circle"></span> Información rápida</h3>
                    <p>algunos datos rápidos sobre ti.</p>
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
                        <label class="col-md-4 col-xs-5 control-label" style="line-height: 15px;">Tareas terminadas</label>
                        <div class="col-md-8 col-xs-7 line-height-30"><?= $this->request->data['Usuario']['count_tareas_terminadas']; ?></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->                                                 

<div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="smallModalHead">Actualizr contraseña</h4>
            </div>
            <div class="modal-body">
                <p>Al actualizar la contraseña, se recargará la página actual.</p>
            </div>
            <div class="modal-body form-horizontal form-group-separated">                        
                <div class="form-group">
                    <label class="col-md-3 control-label">Contraseña actual</label>
                    <div class="col-md-9">
                        <?= $this->Form->input('clave', array('type' => 'password', 'autocomplete' => 'off', 'value' => '')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Contraeña nueva</label>
                    <div class="col-md-9">
                         <?= $this->Form->input('clave_nueva', array('type' => 'password')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Repetir contraseña nueva</label>
                    <div class="col-md-9">
                        <?= $this->Form->input('rep_clave_nueva', array('type' => 'password')); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-danger" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end(); ?>     