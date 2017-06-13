<div class="login-box animated fadeInDown">
	<div class="login-logo"></div>
	<?= $this->element('maintainers_alertas'); ?>	
	<div class="login-body">
		<div class="login-title text-center"><strong>Bienvenido</strong></div>
		<div class="login-title text-center">Para iniciar sesión debes identificarte.</div>
		<?= $this->Form->create('Usuario', array('class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
			<div class="form-group">
				<div class="col-md-12">
					<?= $this->Form->input('email', array('placeholder' => 'Email')); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<?= $this->Form->input('clave', array('type' => 'password', 'placeholder' => 'Contraseña')); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<button type="button" class="btn btn-link btn-block" data-toggle="modal" data-target="#recuperarContrsena">Recuperar contraseña</button>
				</div>
				<div class="col-md-6">
					<button type="submit" class="btn btn-info btn-block">Entrar</button>
				</div>
			</div>
		<?= $this->Form->end(); ?>
	</div>
	<div class="login-footer">
		<div class="pull-left">
			&copy; 2015 Nodriza Spa
		</div>
	</div>
</div>
<!-- Modal recuperar contraseña -->
<div class="modal fade" id="recuperarContrsena" tabindex="-1" role="dialog" aria-labelledby="recuperarContrsenaLabel">
<?= $this->Form->create('Usuario', array('class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="recuperarContrsenaLabel">Recuperar contraseña</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="form-group col-xs-12 col-sm-6 co-md-4">
        		<label>Ingrese su email</label>
        	</div>
        	<div class="form-group col-xs-12 col-sm-6 co-md-8">
        		<?= $this->Form->input('email_recuperar', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'ejemplo@email.com', 'label' => false));?>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
      </div>
    </div>
  </div>
<?= $this->Form->end(); ?>
</div>