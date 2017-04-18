<a href="#"><span class="fa fa-tasks"></span></a>
<div class="informer informer-warning"><?=$contTareas = (isset($tareasNotificacion['Tarea'])) ? count($tareasNotificacion['Tarea']) : 0 ; ?></div>
<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-tasks"></span> Tareas a revisar</h3>
        <div class="pull-right">
            <span class="label label-warning"><?=$contTareas = (isset($tareasNotificacion['Tarea'])) ? count(Hash::extract($tareasNotificacion, '{n}.Tarea.en_revision') ) . 'En Revisión' : '0 En Revisión' ; ?></span>
        </div>
    </div>
    <div class="panel-body list-group scroll mCustomScrollbar _mCS_3 mCS-autoHide mCS_no_scrollbar" style="height: 200px;"><div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: 200px;" tabindex="0"><div id="mCSB_3_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
    <? foreach ($tareasNotificacion as $index => $tarea) : ?>
    	<?=$this->Html->link(
    		'<strong>['.$tarea['Tienda']['nombre'].'] '.$tarea['Tarea']['nombre'].'</strong>
            <div class="progress progress-small progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$tarea['Tarea']['porcentaje_realizado'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$tarea['Tarea']['porcentaje_realizado'].'%;">'.$tarea['Tarea']['porcentaje_realizado'].'%</div>
            </div>
            <small class="text-muted">'.$tarea['Usuario']['nombre'].' <'.$tarea['Usuario']['email'].'>, '.$this->Time->format($tarea['Tarea']['created'], '%e de %m, %Y').' / '.$tarea['Tarea']['porcentaje_realizado'].'%</small>', 
            array('controller' => 'tareas', 'action' => 'view', $tarea['Tarea']['id']), array('escape' => false)); ?>
    <? endforeach; ?>
    </div>
    <div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
    <div class="panel-footer text-center">
        <?=$this->Html->link('Mostrar todas', array('controller' => 'tareas', 'action' => 'index')); ?>
    </div>
</div>