
<li class="<?= ($this->Html->menuActivo(array('controller' => 'tareas', 'action' => 'index')) ? 'active' : ''); ?>"><?= $this->Html->link('<span class="fa fa-tasks"></span> <span class="xn-text">Mis tareas</span>', array('controller' => 'tareas', 'action' => 'index'), array('escape' => false) ); ?>
</li>
<li class="<?= ($this->Html->menuActivo(array('controller' => 'usuarios', 'action' => 'profile')) ? 'active' : ''); ?>">
	<?= $this->Html->link(
		'<span class="fa fa-user"></span> Mi Perfil',
		array('controller' => 'usuarios', 'action' => 'profile'),
		array('escape' => false)
	); ?>
</li>
<li class="<?= ($this->Html->menuActivo(array('controller' => 'pagos', 'action' => 'index')) ? 'active' : ''); ?>">
	<?= $this->Html->link(
		'<span class="fa fa-money"></span> Mis pagos',
		array('controller' => 'pagos', 'action' => 'index'),
		array('escape' => false)
	); ?>
</li>
<script type="text/javascript">
	
	$('li.active').parent().parent().addClass('active');
		
</script>