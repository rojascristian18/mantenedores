<div class="page-sidebar">
	<ul class="x-navigation x-navigation-custom">
		<li class="xn-logo">
			<?= $this->Html->link(
				'<span class="fa fa-dashboard"></span> <span class="x-navigation-control">Backend</span>',
				'/',
				array('escape' => false)
			); ?>
			<a href="#" class="x-navigation-control"></a>
		</li>
		<li class="xn-profile">
			<a href="#" class="profile-mini">
            <? if ( empty($this->Session->read('Auth.Mantenedor.imagen')) ) : ?>
                <?=$this->Html->image('logo_user.jpg', array('alt' => 'Perfil','class' => 'mCS_img_loaded')); ?>
            <? else : ?>
                <?=$this->Html->image($this->Session->read('Auth.Mantenedor.imagen.square'), array('alt' => 'Perfil','class' => 'mCS_img_loaded')); ?>
            <? endif; ?>
            </a>
            <div class="profile">
            	<div class="profile-image">
            		<? if ( empty($this->Session->read('Auth.Mantenedor.imagen')) ) : ?>
            			<?=$this->Html->image('logo_user.jpg', array('alt' => 'Perfil','class' => 'mCS_img_loaded')); ?>
            		<? else : ?>
            			<?=$this->Html->image($this->Session->read('Auth.Mantenedor.imagen.square'), array('alt' => 'Perfil','class' => 'mCS_img_loaded')); ?>
            		<? endif; ?>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?=$this->Session->read('Auth.Mantenedor.nombre');?> <?=$this->Session->read('Auth.Mantenedor.apellidos');?></div>
                    <div class="profile-data-title">Mantenedor <?=$this->Html->estrellas($this->Session->read('Auth.Mantenedor.calificacion_media'));?></div>
                </div>
            </div>                                                                        
        </li>
        <!--<li class="<?= ($this->Html->menuActivo(array('controller' => 'tareas', 'action' => 'index')) ? 'active' : ''); ?>"><?= $this->Html->link('<span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span>', array('controller' => 'tareas', 'action' => 'index'), array('escape' => false) ); ?></li>-->
		<!-- Get Modules View -->	
		<?= $this->element('maintainers_modulos'); ?>

	</ul>
</div>
