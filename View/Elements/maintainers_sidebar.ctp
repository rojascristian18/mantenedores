 <!-- START SIDEBAR -->
<div class="sidebar" data-id="<?=$this->Session->read('Auth.Mantenedor.id');?>" data-role="usuario">

    <div class="sidebar-wrapper scroll">
        
        <div class="sidebar-tabs">
            <a href="#sidebarMensajes" class="sidebar-tab active"><span class="fa fa-comments"></span> Mensajes</a>
            <a href="#" class="sidebar-toggle"><span class="fa fa-close"></span> Cerrar</a>
        </div>
        
        <div class="sidebar-tab-content active" id="sidebarMensajes">

            <? if (!empty($misTareas)) : ?>
            <div class="sidebar-title"><i class="fa fa-envelope"></i> Enviar mensaje rápido<a class="btn btn-success btn-toggle-formulario pull-right" role="button" data-toggle="collapse" href="#FormularioComentarios" aria-expanded="false" aria-controls="FormularioComentarios">Escribir mensaje</a></div>

            <?= $this->Form->create('Comentario', array('url' => array('controller' => 'comentarios', 'action' => 'comentar', 'maintainers' => false), 'class' => 'form-horizontal form-comentarios collapse', 'type' => 'file', 'id' => 'FormularioComentarios' ,'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
            
            <?  if ($this->request->params['prefix'] == 'admin') : ?>
                <?= $this->Form->input('usuario_id', array('type' => 'hidden'));?>
                <?= $this->Form->input('administrador_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Administrador.id'))); ?>
            <?  endif; ?>

            <?  if ($this->request->params['prefix'] == 'maintainers') : ?>
                <?= $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Mantenedor.id')));?>
                <?= $this->Form->input('administrador_id', array('type' => 'hidden')); ?>
                <?= $this->Form->input('notificar_comentario_administrador', array('type' => 'hidden', 'value' => 1));?>
            <?  endif; ?>

            <div class="col-xs-12">
                <div class="form-group">
                    <?= $this->Form->label('tarea_id', 'Seleccione la tarea'); ?>
                    <?= $this->Form->select('tarea_id', $misTareas , array('class' => 'form-control', 'empty' => 'Seleccione la tarea')); ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->label('comentario', 'Mensaje'); ?>
                    <?= $this->Form->textarea('comentario', array('class' => 'form-control', 'placeholder' => 'Ingrese su mensaje', 'required' => 'required', 'rows' => 3)); ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->label('adjunto', 'Adjuntar archivo (opcional)'); ?>
                    <?= $this->Form->file('adjunto', array('class' => 'fileinput btn-block', 'data-filename-placement' => 'inside',  'title' => 'Seleccione archivo')); ?>
                </div>
                <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-success btn-block">Enviar mensaje <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="respuestaMessage">
                <div class="col-xs-12 card text-center">
                    <h1 class="cardTitle"></h1>
                    <a class="btn btn-success btn-toggle-respuesta"></a>
                </div>
            </div>
            <?= $this->Form->end(); ?>
            <? endif; ?>
            
            <div class="sidebar-title">
                <span class="pull-left"><i class="fa fa-list"></i> Comentarios por tarea</span> <button id="actualizarTareas" class="btn btn-default pull-right"><i class="fa fa-refresh"></i> Actualizar listado</button>
            </div>
            <div id="listadoTareasAjax">
                <ul class="list-group">
                    
                </ul>
                <div class="loading hide">
                    <i class="fa fa-spin animate"></i>
                </div>
            </div>
            
        </div>
        
        <div class="sidebar-tab-content form-horizontal" id="sidebar_2">
            
            
        </div>
        
    </div>            
</div>
<!-- END SIDEBAR --> 

<div id="listadoTareasAjaxModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header col-xs-12">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body modal-body-comentarios col-xs-12 col-sm-8">

            </div>
            <div class="modal-body col-xs-12 col-sm-4">
                <div class="col-xs-12">
                    <h4>Escribir nuevo mensaje</h4>
                </div>
                <? if (!empty($misTareas)) : ?>

                <?= $this->Form->create('Comentario', array('url' => array('controller' => 'comentarios', 'action' => 'comentar', 'maintainers' => false), 'class' => 'form-horizontal form-comentarios', 'type' => 'file', 'id' => 'FormularioComentariosModal' ,'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
                
                <?  if ($this->request->params['prefix'] == 'admin') : ?>
                    <?= $this->Form->input('usuario_id', array('type' => 'hidden'));?>
                    <?= $this->Form->input('administrador_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Administrador.id'))); ?>
                <?  endif; ?>

                <?  if ($this->request->params['prefix'] == 'maintainers') : ?>
                    <?= $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Mantenedor.id')));?>
                    <?= $this->Form->input('administrador_id', array('type' => 'hidden')); ?>
                    <?= $this->Form->input('notificar_comentario_administrador', array('type' => 'hidden', 'value' => 1));?>
                <?  endif; ?>

                <?= $this->Form->input('tarea_id', array('type' => 'hidden')); ?>

                <div class="col-xs-12">
                    <div class="form-group">
                        <?= $this->Form->label('comentario', 'Mensaje'); ?>
                        <?= $this->Form->textarea('comentario', array('class' => 'form-control', 'placeholder' => 'Ingrese su mensaje', 'required' => 'required', 'rows' => 3)); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('adjunto', 'Adjuntar archivo (opcional)'); ?>
                        <?= $this->Form->file('adjunto', array('class' => 'fileinput btn-block', 'data-filename-placement' => 'inside',  'title' => 'Seleccione archivo')); ?>
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-success btn-block">Enviar mensaje <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="respuestaMessage">
                    <div class="col-xs-12 card text-center">
                        <h1 class="cardTitle"></h1>
                        <a class="btn btn-success btn-toggle-respuesta"></a>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
                <? endif; ?>
            </div>
            <div class="modal-footer col-xs-12">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->