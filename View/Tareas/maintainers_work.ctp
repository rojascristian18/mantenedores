<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span> Trabajando en Tarea "<?= $this->request->data['Tarea']['nombre']; ?>"</h2>
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
	<!--<div class="row">
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
					<h3 class="panel-title">Grupos disponibles</h3>
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
	<!--</div>--> <!-- end row -->
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
					<h3 class="panel-title">Productos de la tarea</h3>
					<p class="parrafo-panel">Los productos que no se pueden modificar están aceptados por el administrador o no pertenecen a usted.</p>
					<? if ( count($this->request->data['Producto']) < $this->request->data['Tarea']['cantidad_productos'] ) : ?>
					<?=$this->Html->link('<i class="fa fa-plus"></i> Agregar producto', array('controller' => 'productos', 'action' => 'add', $this->request->data['Tarea']['id']), array('class' => 'btn btn-success btn-xs pull-right', 'escape' => false)); ?>
					<? endif; ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<th>Aceptado</th>
								<th>Referecia</th>
								<th>Nombre final</th>
								<!--<th>Precio</th>-->
								<th>Grupo</th>
								<!--<th>Proveedor</th>-->
								<th>Marca</th>
								<th>Fabricante</th>
								<th>Activado</th>
								<th>Acción</th>
							</thead>
							<tbody>
							<? foreach ($this->request->data['Producto'] as $indice => $producto) : ?>
								<tr>
									<td class="<?= $aceptado = ($producto['aceptado']) ? 'aceptado' : 'rechazado' ; ?>"><?= $estado = ($producto['aceptado'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td><?= $referencia = (!empty($producto['referencia'])) ? $producto['referencia'] : 'No agregado' ; ?></td>
									<td><?= $nombre = (!empty($producto['nombre_final'])) ? $producto['nombre_final'] : 'No agregado' ; ?></td>
									<!--<td><?= $precio = (!empty($producto['precio'])) ? CakeNumber::currency($producto['precio'], 'CLP') : 'No agregado' ; ?></td>-->
									<td><?= $grupo = (!empty($producto['grupocaracteristica_id'])) ? $producto['Grupocaracteristica']['nombre'] : 'No agregado' ; ?></td>
									<!--<td><?= $proveedor = (!empty($producto['proveedor_id'])) ? $producto['Proveedor']['name'] : 'No agregado' ; ?></td>-->
									<td><?= $marca = (!empty($producto['marca_id'])) ? $producto['Marca']['nombre'] : 'No agregado' ; ?></td>
									<td><?= $fabricante = (!empty($producto['fabricante_id'])) ? $producto['Fabricante']['name'] : 'No agregado' ; ?></td>
									<td><?= $activo = ($producto['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td>
									<? if (!$producto['aceptado'] && $producto['usuario_id'] == $this->Session->read('Auth.Mantenedor.id')) : ?>
										<div class="btn-group">
	                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle" aria-expanded="true"><span class="fa fa-cog"></span> Acciones</a>
	                                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
	                                            <li role="presentation" class="dropdown-header">Seleccione</li>
												<li><?= $this->Html->link('<i class="fa fa-edit"></i> Revisar', array('controller' => 'productos', 'action' => 'edit', $producto['id'], $producto['tarea_id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
												</li>
												<li><?= $this->Form->postLink('<i class="fa fa-trash"></i> Eliminar', array('controller' => 'productos', 'action' => 'delete', $producto['id'], $producto['tarea_id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Eliminar este producto', 'escape' => false)); ?></li>
											</ul>
	                                    </div>
	                                <? else : ?>
	                                	<button class="btn btn-success btn-xs" disabled>Imposible cambiar</button>
                                   <? endif; ?>
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
							<? if (!empty($comentario['administrador_id'])) :  ?>
								<div id="comentario-<?=$comentario['id'];?>" class="comentario-item">
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
							<? else : ?>
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
							<? endif; ?>
							</div>
						<? endforeach; ?>
						</div>
						<div class="comentar">
							<?= $this->Form->create('Tarea', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
							<?=	$this->Form->input('id');?>
							<?=	$this->Form->input('administrador_id', array('type' => 'hidden'));?>
							<?= $this->Form->input('Comentario.1.usuario_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Mantenedor.id'))); ?>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Adjunto</label>
									<?= $this->Form->input('Comentario.1.adjunto', array('class' => '', 'type' => 'file')); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-8 form-group">
								<label>Comentario</label>
								<?= $this->Form->textarea('Comentario.1.comentario', array('class' => 'form-control', 'placeholder' => 'Ingrese su comentario', 'value' => '')); ?>
							</div>
							
							<?= $this->Form->button('Comentar', array('class' => 'btn btn-primary pull-right'));?>
							<?= $this->Form->end(); ?>   
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right guardar-botones">
				<a href="#" class="mb-control btn btn-primary" data-box="#mb-review"><i class="fa fa-eye"></i> Enviar a revisión</a>
				<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
			</div>
		</div>
	</div>
</div>

<div class="message-box message-box-warning animated fadeIn" data-sound="alert" id="mb-review">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-sign-out"></span>¿Enviar a <strong>revisión</strong>?</div>
			<div class="mb-content">
				<p>¿Seguro que desea enviar a revisión la tarea?</p>
				<p>Recuerde que mientras la tarea se encuentra en revisión usted no podrá hacer cambios de ningun tipo.</p>
				<p>Presiona NO para continuar trabajando y SI para enviar a revisión.</p>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<?= $this->Form->postLink('Enviar a revisión', array('action' => 'enviar_a_revision', $this->request->data['Tarea']['id']), array('class' => 'btn btn-primary btn-lg')); ?>
					<button class="btn btn-default btn-lg mb-control-close">No</button>
				</div>
			</div>
		</div>
	</div>
</div>