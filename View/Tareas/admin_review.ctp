<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span> Revisión "<?= $this->request->data['Tarea']['nombre']; ?>"</h2>
	<div class="pull-right fecha-creacion">
		<label>Creada el <?= $this->Time->format($this->request->data['Tarea']['created'], '%d de %m del %Y  a las %H:%M:%S'); ?></label>
	</div>
</div>
<?= $this->Form->create('Tarea', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?=$this->Form->input('id');?>
<?= $this->Form->input('administrador_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Administrador.id'))); ?>
<div class="page-content-wrap">
<? if ( !empty($this->request->data['Usuario']) ) : ?>
	<div class="row">
		<div class="col-xs-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Mantenedor asigando</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td colspan="2" align="center" class="mantenedor-avatar">
									<?= $imagenPerfil = (!empty($this->request->data['Usuario']['imagen'])) ? $this->Html->image($this->request->data['Usuario']['imagen']['mini'], array('class' => 'img-responsive img-circle', 'alt' => $this->request->data['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-responsive img-circle image-perfil-list', 'alt' => $this->request->data['Usuario']['nombre'])) ; ?>
									<span class="mantenedor-avatar-nombre">
										<?= $this->request->data['Usuario']['nombre']; ?> <?= $this->request->data['Usuario']['apellidos']; ?>
									</span>
								</td>
							</tr>
							<tr>
								<th><?=__('Rut');?></th>
								<td><?= $this->request->data['Usuario']['rut']; ?></td>
							</tr>
							<tr>
								<th><?=__('Email');?></th>
								<td><?= $this->request->data['Usuario']['email']; ?></td>
							</tr>
							<tr>
								<th><?=__('Fono');?></th>
								<td><?= $this->request->data['Usuario']['fono']; ?></td>
							</tr>
							<tr>
								<th><?=__('Calificación');?></th>
								<td><?= $this->Html->estrellas($this->request->data['Usuario']['calificacion_media']); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<? endif; ?>
	<div class="row">
		<div class="col-xs-12 col-sm-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Tarea</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
								<td><?= $this->Form->input('nombre'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('descripcion', 'Descripcion'); ?></th>
								<td><?= $this->Form->input('descripcion'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('precio', 'Precio'); ?></th>
								<td><?= $this->Form->input('precio'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('fecha_entrega', 'Fecha entrega'); ?></th>
								<td><div class="form-inline"><div class="form-group"><?= $this->Form->input('fecha_entrega'); ?></div></div></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('cantidad_productos', 'Cant productos'); ?></th>
								<td><?= $this->Form->input('cantidad_productos'); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-right">
						<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
						<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
		<div class="col-xs-12 col-sm-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Configuración de la tarea</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('impuesto_default_id', 'Impuesto default'); ?></th>
								<td><?= $this->Form->input('impuesto_default_id', array('class' => 'form-control', 'empty' => 'Seleccione un impuesto')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('idioma_id', 'Idioma'); ?></th>
								<td><?= $this->Form->input('idioma_id', array('class' => 'form-control', 'empty' => 'Seleccione un idioma')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('shop_id', 'Shop'); ?></th>
								<td><?= $this->Form->input('shop_id', array('class' => 'form-control', 'empty' => 'Seleccione una tienda principal')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('Palabraclave', 'Palabraclave'); ?></th>
								<td><?= $this->Form->input('Palabraclave'); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-right">
						<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
						<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
<?= $this->Form->end(); ?>