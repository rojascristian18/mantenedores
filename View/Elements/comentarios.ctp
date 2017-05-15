<a href="#"><span class="fa fa-comments"></span></a>
<div class="informer informer-danger"><?=$contComentarios = ( ! empty($comentariosNotificacion) ) ? count($comentariosNotificacion) : 0 ; ?></div>
<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-comments"></span> Comentarios</h3>
        <div class="pull-right">
            <span class="label label-danger"><?=$contComent = ( ! empty($comentariosNotificacion) ) ? count($comentariosNotificacion) . ' comentario sin visualizar' : '0 Sin visualizar' ; ?></span>
        </div>
    </div>
    <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
    <? foreach ($comentariosNotificacion as $index => $comentario) : ?>
        <? $imagenComentario = (!empty($comentario['Usuario']['imagen'])) ? $this->Html->image(sprintf('Usuario/%d/mini_%s', $comentario['Usuario']['id'], $comentario['Usuario']['imagen']), array('class' => 'pull-left')) : $this->Html->image('logo_user.jpg', array('class' => 'pull-left')) ; ?>

        <?=$this->Html->link(
            $imagenComentario .
            '<span class="contacts-title">'. $comentario['Usuario']['email'] . ' a comentado una tarea</span>'.
            '<p>' . $this->Text->truncate($comentario['Comentario']['comentario'], 15) .
            ' <small class="text-muted">Creado el '.$this->Time->format($comentario['Comentario']['created'], '%e de %m, %Y') . '</small></p>', 
            array('controller' => 'tareas', 'action' => 'edit', $comentario['Tarea']['id']), array('escape' => false, 'class' => 'list-group-item')); ?>
    <? endforeach; ?>
    </div>
</div>