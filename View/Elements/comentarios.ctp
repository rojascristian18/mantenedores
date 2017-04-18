<a href="#"><span class="fa fa-comments"></span></a>
<div class="informer informer-danger"><?=$contTareas = (isset($comentariosNotificacion['Comentario'])) ? count($comentariosNotificacion['Comentario']) : 0 ; ?></div>
<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-comments"></span> Comentarios</h3>
        <div class="pull-right">
            <span class="label label-danger"><?=$contComent = (isset($comentariosNotificacion['Comentario'])) ? count(Hash::extract($comentariosNotificacion, '{n}.Comentario.id') ) . 'Sin visualizar' : '0 Sin visualizar' ; ?></span>
        </div>
    </div>
    <div class="panel-body list-group list-group-contacts scroll mCustomScrollbar _mCS_2 mCS-autoHide mCS_no_scrollbar" style="height: 200px;"><div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: 200px;" tabindex="0"><div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position: relative; top: 0px; left: 0px;" dir="ltr">
    <? foreach ($comentariosNotificacion as $index => $comentario) : ?>
        <?=$this->Html->link($this->Html->image() .
            '<strong>['.$tarea['Tienda']['nombre'].'] '.$tarea['Tarea']['nombre'].'</strong>
            <div class="progress progress-small progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$tarea['Tarea']['porcentaje_realizado'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$tarea['Tarea']['porcentaje_realizado'].'%;">'.$tarea['Tarea']['porcentaje_realizado'].'%</div>
            </div>
            <small class="text-muted">'.$tarea['Usuario']['nombre'].' <'.$tarea['Usuario']['email'].'>, '.$this->Time->format($tarea['Tarea']['created'], '%e de %m, %Y').' / '.$tarea['Tarea']['porcentaje_realizado'].'%</small>', 
            array('controller' => 'tareas', 'action' => 'view', $tarea['Tarea']['id']), array('escape' => false)); ?>
    <? endforeach; ?>
        <a href="#" class="list-group-item">
            <div class="list-group-status status-online"></div>
            <img src="assets/images/users/user2.jpg" class="pull-left mCS_img_loaded" alt="John Doe">
            <span class="contacts-title">John Doe</span>
            <p>Praesent placerat tellus id augue condimentum</p>
        </a>
        <a href="#" class="list-group-item">
            <div class="list-group-status status-away"></div>
            <img src="assets/images/users/user.jpg" class="pull-left mCS_img_loaded" alt="Dmitry Ivaniuk">
            <span class="contacts-title">Dmitry Ivaniuk</span>
            <p>Donec risus sapien, sagittis et magna quis</p>
        </a>
        <a href="#" class="list-group-item">
            <div class="list-group-status status-away"></div>
            <img src="assets/images/users/user3.jpg" class="pull-left mCS_img_loaded" alt="Nadia Ali">
            <span class="contacts-title">Nadia Ali</span>
            <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
        </a>
        <a href="#" class="list-group-item">
            <div class="list-group-status status-offline"></div>
            <img src="assets/images/users/user6.jpg" class="pull-left mCS_img_loaded" alt="Darth Vader">
            <span class="contacts-title">Darth Vader</span>
            <p>I want my money back!</p>
        </a>
    </div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 165px; max-height: 190px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
    <div class="panel-footer text-center">
        <?=$this->Html->link('Mostrar todos los mensajes', array('controller' => 'comentarios', 'action' => 'index')); ?>
    </div>
</div>