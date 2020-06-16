
<li data-step="1" data-intro="En esta sección encontrará las tareas que se le asignen." data-position="right" class="<?= ($this->Html->menuActivo(array('controller' => 'tareas', 'action' => 'index')) ? 'active' : ''); ?>"><?= $this->Html->link('<span class="fa fa-tasks"></span> <span class="xn-text">Mis tareas</span>', array('controller' => 'tareas', 'action' => 'index'), array('escape' => false) ); ?>
</li>
<li data-step="2" data-intro="Aca encontrará su información personal y sus datos bancarios. ¡Manténgalos actualizados!" data-position="right" class="<?= ($this->Html->menuActivo(array('controller' => 'usuarios', 'action' => 'profile')) ? 'active' : ''); ?>">
	<?= $this->Html->link(
		'<span class="fa fa-user"></span> Mi Perfil',
		array('controller' => 'usuarios', 'action' => 'profile'),
		array('escape' => false)
	); ?>
</li>
<li data-step="3" data-intro="Aquí podrá ver el estado de sus pagos." data-position="right" class="<?= ($this->Html->menuActivo(array('controller' => 'pagos', 'action' => 'index')) ? 'active' : ''); ?>">
	<?= $this->Html->link(
		'<span class="fa fa-money"></span> Mis pagos',
		array('controller' => 'pagos', 'action' => 'index'),
		array('escape' => false)
	); ?>
</li>
<li data-step="4" data-intro="Resuelva sus dudas con la sección de preguntas frecuentes que hemos desarrollado para usted." data-position="right" class="<?= ($this->Html->menuActivo(array('controller' => 'preguntaFrecuentes', 'action' => 'index')) ? 'active' : ''); ?>">
	<?= $this->Html->link(
		'<span class="fa fa-question-circle"></span> Preguntas Frecuentes',
		array('controller' => 'preguntaFrecuentes', 'action' => 'index'),
		array('escape' => false)
	); ?>
</li>
<script type="text/javascript">
	
	$('li.active').parent().parent().addClass('active');
		
</script>