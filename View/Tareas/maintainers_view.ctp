<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span>Tarea "<?= $this->request->data['Tarea']['nombre']; ?>"</h2>
	<div class="pull-right fecha-creacion">
		<label>Creada el <?= $this->Time->format($this->request->data['Tarea']['created'], '%d de %m del %Y  a las %H:%M:%S'); ?></label>
	</div>
</div>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Información de la Tarea</h3>
				</div>
				<div class="panel-body">
					<div class="row tabla-tareas">
						<div class="table-responsive">
							<table class="table tabla-sin-bordes">
								<tr>
									<td>
										<table class="table">
											<tr>
												<th><?= __('Nombre'); ?></th>
												<td><?= $this->request->data['Tarea']['nombre'] ?></td>
											</tr>
											<tr>
												<th><?= __('Fecha entrega'); ?></th>
												<td><?= $this->Time->format($this->request->data['Tarea']['fecha_entrega'], '%d de %m del %Y  a las %H:%M:%S'); ?></td>
											</tr>
											<tr>
												<th><?= __('Precio'); ?></th>
												<td><?= CakeNumber::currency($this->request->data['Tarea']['precio'], 'CLP'); ?>&nbsp;</td>
											</tr>
											<tr>
												<th><?= __('Cant productos'); ?></th>
												<td><?= $this->request->data['Tarea']['cantidad_productos']; ?></td>
											</tr>
										</table>
									</td>
									<td>
										<table class="table">
											<tr>
												<th><?= __('Impuesto default'); ?></th>
												<td><?= $this->request->data['ImpuestoReglaGrupo']['name']; ?></td>
											</tr>
											<tr>
												<th><?= __('Idioma'); ?></th>
												<td><?= $this->request->data['Idioma']['name']; ?></td>
											</tr>
											<tr>
												<th><?= __('Shop'); ?></th>
												<td><?= $this->request->data['Shop']['name']; ?></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<h4><?= __('Descripción de la tarea'); ?></h4>
										<div class="descripcion-caja">
										<?= $this->request->data['Tarea']['descripcion']; ?>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
		<div class="row">
			<div class="col-xs-12 col-sm-5">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Mantenedor asigando</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table tabla-sin-bordes">
							<? if ( !empty($this->request->data['Usuario']['id']) ) : ?>
								<tr>
									<td colspan="2" align="center" class="mantenedor-avatar">
										<?= $imagenPerfil = (!empty($this->request->data['Usuario']['imagen'])) ? $this->Html->image(sprintf('Usuario/%d/mini_%s', $this->request->data['Usuario']['id'] , $this->request->data['Usuario']['imagen']), array('class' => 'img-responsive img-circle', 'alt' => $this->request->data['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-responsive img-circle image-perfil-list', 'alt' => $this->request->data['Usuario']['nombre'])) ; ?>
										<span class="mantenedor-avatar-nombre">
											<?= $this->request->data['Usuario']['nombre']; ?> <?= $this->request->data['Usuario']['apellidos']; ?>
										</span>
									</td>
								</tr>
								<tr>
									<th><label><?=__('Rut');?></label></th>
									<td><?= $this->request->data['Usuario']['rut']; ?></td>
								</tr>
								<tr>
									<th><label><?=__('Email');?></label></th>
									<td><?= $this->request->data['Usuario']['email']; ?></td>
								</tr>
								<tr>
									<th><label><?=__('Fono');?></label></th>
									<td><?= $this->request->data['Usuario']['fono']; ?></td>
								</tr>
								<tr>
									<th><label><?=__('Calificación');?></label></th>
									<td><?= $this->Html->estrellas($this->request->data['Usuario']['calificacion_media']); ?></td>
								</tr>
							<? else : ?>
								<tr>
									<td colspan="2">Aún no se ha asignado esta tarea a un mantenedor.</td>
								</tr>
							<? endif; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-7">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Grupos</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-stripped">
								<thead>
									<th>Grupo</th>
								</thead>
								<tbody>
								<? if (!empty($this->request->data['Grupocaracteristica'])) : ?>
								
									<? foreach ($this->request->data['Grupocaracteristica'] as $indice => $grupo) : ?>
									<tr>
		    							<td><?=$grupo['nombre'];?></td>
		    						</tr>
									<? endforeach; ?>

								<? endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div> <!-- end col -->
		</div>
	</div> <!-- end row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Materiales de la tarea</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table js-clon-scope">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Activo</th>
									<th>Archivo</th>
								</tr>
							</thead>
							<tbody class="js-clon-contenedor">
								
								<? if ( ! empty($this->request->data['Adjunto']) ) : ?>
								<? foreach ( $this->request->data['Adjunto'] as $index => $adjunto ) : ?>
								<tr>
									<td>
										<?= $adjunto['nombre']; ?>
									</td>
									<td><?= $adjunto['descripcion']; ?></td>
									<td><td><?= ($adjunto['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td>
									<? if (!empty($adjunto['url_archivo'])) : ?>
										<?= $this->Html->link(
											'<i class="fa fa-eye"></i> Ver',
											sprintf('/img/Adjunto/%d/%s', $adjunto['id'], $adjunto['url_archivo']),
											array(
												'class' => 'btn btn-info btn-xs btn-block', 
												'target' => '_blank', 
												'fullbase' => true,
												'escape' => false) 
											); ?>
											
									<? else : ?>
										<small>Sin archivo agregado</small>
									<? endif; ?>
									</td>
								</tr>
								<? endforeach; ?>
								<? endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Productos agregados</h3>
					<p class="parrafo-panel">Revise uno a uno los productos de la tarea antes de darla por finalizada para garantizar una correcta subida.</p>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-stripped">
							<thead>
								<th>Referecia</th>
								<th>Nombre final</th>
								<th>Precio</th>
								<th>Grupo</th>
								<th>Proveedor</th>
								<th>Fabricante</th>
								<th>Aceptado</th>
								<th>Acción</th>
							</thead>
							<tbody>
							<? foreach ($this->request->data['Producto'] as $indice => $producto) : ?>
								<tr>
									<td><?= $referencia = (!empty($producto['referencia'])) ? $producto['referencia'] : 'No agregado' ; ?></td>
									<td><?= $nombre = (!empty($producto['nombre_final'])) ? $producto['nombre_final'] : 'No agregado' ; ?></td>
									<td><?= $precio = (!empty($producto['precio'])) ? CakeNumber::currency($producto['precio'], 'CLP') : 'No agregado' ; ?></td>
									<td><?= $grupo = (!empty($producto['grupocaracteristica_id'])) ? $producto['Grupocaracteristica']['nombre'] : 'No agregado' ; ?></td>
									<td><?= $proveedor = (!empty($producto['proveedor_id'])) ? $producto['Proveedor']['name'] : 'No agregado' ; ?></td>
									<td><?= $fabricante = (!empty($producto['fabricante_id'])) ? $producto['Fabricante']['name'] : 'No agregado' ; ?></td>
									<td><?= ($producto['aceptado'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td><?= $this->Html->link('<i class="fa fa-eye"></i> Ver', array('controller' => 'productos', 'action' => 'view', $producto['id']), array('class' => 'btn btn-info btn-xs', 'rel' => 'tooltip', 'title' => 'Ver este registro', 'escape' => false)); ?></td>
								</tr>
							<? endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Comentarios de la tarea</h3>
				</div>
				<div class="panel-body panel-gris">
					<div class="comentarios">
						<div class="comentarios-contenedor">
						<? foreach ($this->request->data['Comentario'] as $comentario) : ?>
							<div class="comentario-contenedor">
							<? if (!empty($comentario['usuario_id'])) :  ?>
							<div id="comentario-<?=$comentario['id'];?>" class="comentario-item <?= $miComentario = (isset($comentario['Usuario']['id']) && $comentario['Usuario']['id'] == $this->Session->read('Auth.Mantenedor.id')) ? 'pull-right mi-comentario' : '' ; ?>">
								<div class="comentario-cebecera">
									<?= $imagen = (!empty($comentario['Usuario']['imagen'])) ? $this->Html->image(sprintf('Usuario/%d/mini_%s', $comentario['Usuario']['id'] , $comentario['Usuario']['imagen']), array('class' => 'img-responsive img-circle', 'alt' => $comentario['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-responsive img-circle', 'alt' => $comentario['Usuario']['nombre'])) ; ?>
									<span class="comentario-autor"><?=$comentario['Usuario']['nombre'];?> <?=$comentario['Usuario']['apellidos'];?> <small><?=$comentario['Usuario']['email']?></small></span>
								</div>
								<div class="comentario-cuerpo">
									<p><?=$comentario['comentario'];?></p>
								</div>
								<div class="comentario-pie">
									<? if (!empty($comentario['adjunto'])) : ?>
										<?= $this->Html->link(
											'<i class="fa fa-eye"></i> Ver adjunto',
											sprintf('/img/Comentario/%d/%s', $comentario['id'], $comentario['adjunto']),
											array(
												'class' => 'btn btn-info btn-xs', 
												'target' => '_blank', 
												'fullbase' => true,
												'escape' => false) 
											); ?>
									<? endif; ?>
									<span class="visto"><?= $visto = ($comentario['visualizado']) ? '<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>' : '<i class="fa fa-check"></i><i class="fa fa-check"></i>' ; ?></span>
									<span class="fecha">Comentado el <?= $this->Time->format($comentario['created'], '%d de %m del %Y  a las %H:%M:%S'); ?></span>
								</div>
							</div>
							<? else : ?>
							<div id="comentario-<?=$comentario['id'];?>" class="comentario-item <?= $miComentario = (isset($comentario['Administrador']['id']) && $comentario['Administrador']['id'] == $this->Session->read('Auth.Administrador.id')) ? 'pull-right mi-comentario' : '' ; ?>">
								<div class="comentario-cebecera">
									<?= $imagen = (!empty($comentario['Administrador']['imagen'])) ? $this->Html->image(sprintf('Administrador/%d/mini_%s', $comentario['Administrador']['id'] , $comentario['Administrador']['imagen']), array('class' => 'img-responsive img-circle', 'alt' => $comentario['Administrador']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-responsive img-circle', 'alt' => $comentario['Administrador']['nombre'])) ; ?>
									<span class="comentario-autor"><?=$comentario['Administrador']['nombre'];?> <?=$comentario['Administrador']['apellidos'];?> <small><?=$comentario['Administrador']['email']?></small></span>
								</div>
								<div class="comentario-cuerpo">
									<p><?=$comentario['comentario'];?></p>
								</div>
								<div class="comentario-pie">
									<? if (!empty($comentario['adjunto'])) : ?>
										<?= $this->Html->link(
											'<i class="fa fa-eye"></i> Ver adjunto',
											sprintf('/img/Comentario/%d/%s', $comentario['id'], $comentario['adjunto']),
											array(
												'class' => 'btn btn-info btn-xs', 
												'target' => '_blank', 
												'fullbase' => true,
												'escape' => false) 
											); ?>
									<? endif; ?>
									<span class="visto"><?= $visto = ($comentario['visualizado']) ? '<i class="fa fa-check visto"></i><i class="fa fa-check visto"></i>' : '<i class="fa fa-check"></i><i class="fa fa-check"></i>' ; ?></span>
									<span class="fecha">Comentado el <?= $this->Time->format($comentario['created'], '%d de %m del %Y  a las %H:%M:%S'); ?></span>
								</div>
							</div>
							<? endif; ?>
							</div>
						<? endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right guardar-botones">
				<?= $this->Html->link('Volver', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
			</div>
		</div>
	</div>
</div>