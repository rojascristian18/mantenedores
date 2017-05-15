<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">
			<?= $this->Html->image('nodrizablanco.png', array('class' => 'img-responsive logo')); ?>	
			<h1>Plataforma de trabajos de Nodriza Spa.</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 text-right">
			<?=$this->Html->link('<i class="fa fa-users"></i> Acceso mantenedores', array('controller' => 'usuarios', 'action' => 'login', 'maintainers' => true), array('class' => 'btn btn-primary btn-lg', 'escape' => false)); ?>
		</div>
		<div class="col-xs-12 col-sm-6 text-left">
			<?=$this->Html->link('<i class="fa fa-cogs"></i> Acceso administración', array('controller' => 'administradores', 'action' => 'login', 'admin' => true), array('class' => 'btn btn-success btn-lg', 'escape' => false)); ?>
		</div>
	</div>
</div>