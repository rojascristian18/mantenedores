<div class="page-sidebar">
	<ul class="x-navigation x-navigation-custom">
		<li class="xn-logo">
			<?= $this->Html->link(
				'<span class="fa fa-dashboard"></span> <span class="x-navigation-control">Backend</span>',
				'/admin',
				array('escape' => false)
			); ?>
		</li>
		<li class="xn-title"></li>
		<li class="<?= ($this->Html->menuActivo(array('controller' => 'compras', 'action' => 'dashboard')) ? 'active' : ''); ?>">
			<?= $this->Html->link(
				'<span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span>',
				'/admin',
				array('escape' => false)
			); ?>
		</li>
		<li class="xn-title">Sección 1</li>
		<li class="<?= ($this->Html->menuActivo(array('controller' => 'administradores', 'action' => 'index')) ? 'active' : ''); ?>">
			<?= $this->Html->link(
				'<span class="fa fa-list-ol"></span> <span class="xn-text">Administradores</span>',
				array('controller' => 'administradores', 'action' => 'index'),
				array('escape' => false)
			); ?>
		</li>

		<li class="xn-title">Sección 2</li>
		<li class="<?= ($this->Html->menuActivo(array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false)) ? 'active' : ''); ?>">
			<?= $this->Html->link(
				'<span class="fa fa-image"></span> <span class="xn-text">Home</span>',
				array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false),
				array('escape' => false)
			); ?>
		</li>

		<li class="xn-title">Sección Expandible</li>
		<li class="xn-openable <?= (
			(
				$this->Html->menuActivo(array('controller' => 'controlador1')) ||
				$this->Html->menuActivo(array('controller' => 'controlador2'))
			)
			? 'active' : ''
		); ?>">
			<a href="#"><span class="fa fa-cog"></span> <span class="xn-text">Expandible 1</span></a>
			<ul>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'controlador1')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-user"></span> <span class="xn-text">Controlador 1</span>',
						array('controller' => 'controlador1', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'controlador2')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-database"></span> <span class="xn-text">Controlador 2</span>',
						array('controller' => 'controlador2', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
			</ul>
		</li>

		<?
		$controladores		=  array_map(function($controlador)
		{
			return str_replace('Controller', '', $controlador);
		}, App::objects('controller'));
		?>
		<li class="xn-openable">
			<a href="#"><span class="fa fa-cog"></span> <span class="xn-text">Controladores</span></a>
			<ul>
				<? foreach ( $controladores as $controlador ) : ?>
				<? if ( $controlador === 'App' ) continue; ?>
				<li class="<?= ($this->Html->menuActivo(array('controller' => strtolower($controlador))) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						sprintf('<span class="fa fa-list"></span> <span class="xn-text">%s</span>', ucfirst($controlador)),
						array('controller' => strtolower($controlador), 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<? endforeach; ?>
			</ul>
		</li>

	</ul>
</div>
