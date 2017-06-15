<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span> Tarea "<?= $this->request->data['Tarea']['nombre']; ?>"</h2>
	<div class="pull-right fecha-creacion">
		<label>Creada el <?= $this->Time->format($this->request->data['Tarea']['created'], '%d de %m del %Y  a las %H:%M:%S'); ?></label>
	</div>
</div>
<div class="pull-right guardar-botones">
<? if ($this->request->data['Tarea']['en_revision'] && !$this->request->data['Tarea']['en_progreso'] && !$this->request->data['Tarea']['finalizado'] && !$this->request->data['Tarea']['rechazado']) : ?>
	<? if ($pNoAceptados == 0 ) : ?>
		<button class="btn btn-success btn-aceptar-tarea" data-toggle="modal" data-target="#calificar"><i class="fa fa-check"></i> Aceptar tarea y finalizar</button>
	<? else : ?>
		<label class="label label-form label-warning">Para aprobar la tarea debe aceptar todos los productos.</label>
	<? endif; ?>
	<?= $this->Form->postLink('<i class="fa fa-remove"></i> Rechazar tarea', array('action' => 'refuse', $this->request->data['Tarea']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
<? endif; ?>
</div>
<?= $this->Form->create('Tarea', array('class' => 'form-horizontal tareas-form', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?=	$this->Form->input('id');?>
<?= $this->Form->input('administrador_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Administrador.id'))); ?>
<?= $this->Form->input('ElementosEliminados', array('type' => 'hidden', 'id' => 'ElementosEliminados')); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Tarea</h3>
				</div>
				<div class="panel-body">
					<div class="row tabla-tareas">
						<div class="table-responsive">
							<table class="table tabla-sin-bordes">
								<tr>
									<td>
										<table class="table">
											<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
											<tr>
												<th><?= $this->Form->label('fecha_entrega', 'Fecha entrega'); ?></th>
												<td><?= $this->Form->input('fecha_entrega', array('type' => 'text', 'class' => 'datetimepicker form-control' )); ?></td>
											</tr>
											<tr>
												<th><?= $this->Form->label('precio', 'Precio'); ?></th>
												<td><?= $this->Form->input('precio', array('class' => 'mask_money form-control')); ?></td>
											</tr>
											<tr>
												<th><?= $this->Form->label('cantidad_productos', 'Cant productos'); ?></th>
												<td><?= $this->Form->input('cantidad_productos'); ?></td>
											</tr>
										</table>
									</td>
									<td>
										<table class="table">
											<tr>
												<th><?= $this->Form->label('impuesto_default_id', 'Impuesto default'); ?></th>
												<td><?= $this->Form->select('impuesto_default_id', $impuestos, array('class' => 'form-control', 'empty' => 'Seleccione un impuesto')); ?></td>
											</tr>
											<tr>
												<th><?= $this->Form->label('idioma_id', 'Idioma'); ?></th>
												<td><?= $this->Form->input('idioma_id', array('class' => 'form-control', 'empty' => 'Seleccione un idioma')); ?></td>
											</tr>
											<tr>
												<th><?= $this->Form->label('shop_id', 'Shop'); ?></th>
												<td><?= $this->Form->input('shop_id', array('class' => 'form-control', 'empty' => 'Seleccione una sub-tienda principal')); ?></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<ins><?= $this->Form->label('descripcion', 'Descripción de la tarea', array('style=""')); ?></ins>
										<p><small><?= __('La descripción de la tarea debe ser <mark>clara y precisa</mark>. Sin redundancias ni supuestos. Así el mantenedor tendrá claro el <mark>objetivo de la tarea</mark> y se evitarán futuros confictos de información cruzada o mal redactada.'); ?></small></p>
										<?= $this->Form->input('descripcion', array('class' => 'summernote')); ?>
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
			<div class="col-xs-5">
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
								<tr>
									<th><?= $this->Form->label('usuario_id', 'Cambiar'); ?></th>
									<td><?= $this->Form->input('usuario_id', array('class' => 'form-control select-mantenedor', 'empty' => 'Seleccione un mantenedor', 'data-live-search' => 'true')); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-7">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Agregar grupos</h3>
					</div>
					<div class="panel-body">
						<div class="col-xs-12">
							<div class="form-inline form-grupocaracteristica">
								<div class="form-group">
									<label>Ingrese el nombre del grupo <label class="label label-form label-success">(<?=count($grupocaracteristicas)?>) disponibles</label></label>
								</div>
								<div class="form-group">
									<input class="form-control input-grupocaracteristica-buscar" placeholder="Herramientas eléctricas, Carro de compras, etc" type="text"  style="min-width: 350px;">
								</div>
								<div class="form-group">
									<button class="btn btn-primary button-grupocaracteristica-buscar"><span class="fa fa-plus"></span> Agregar</button>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-stripped" id="tablaGrupocaracteristica">
								<thead>
									<th>Grupo</th>
									<th style="max-width: 60px">Acción</th>
								</thead>
								<tbody>
								<? if (!empty($this->request->data['Grupocaracteristica'])) : ?>
								
									<? foreach ($this->request->data['Grupocaracteristica'] as $indice => $grupo) : ?>
									<tr>
		    							<td><?= $this->Form->input('Grupocaracteristica.Grupocaracteristica.' . $grupo['id'], array('value' => $grupo['id'], 'type' => 'hidden')); ?><?=$grupo['nombre'];?></td>
		    							<td><button class="quitar btn btn-danger btn-xs">Quitar</button></td>
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
					<h3 class="panel-title">Agregar materiales</h3>
					<p>Agregue material guía para el mantenedor. Puede agregar imágenes, archivos PDF, Excel y Word.</p>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table js-clon-scope">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Archivo</th>
									<th>Activo</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody class="js-clon-contenedor">
								<tr class="js-clon-base hidden">
									<td><?= $this->Form->input('Adjunto.999.nombre', array('disabled' => true, 'class' => 'form-control')); ?></td>
									<td><?= $this->Form->input('Adjunto.999.descripcion', array('disabled' => true, 'class' => 'form-control')); ?></td>
									<td><?= $this->Form->input('Adjunto.999.url_archivo', array('disabled' => true, 'type' => 'file', 'class' => '')); ?></td>
									<td><?= $this->Form->input('Adjunto.999.activo', array('disabled' => true, 'checked' => true, 'class' => 'icheckbox')); ?></td>
									<td>
										<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Eliminar</a>
										<!--<a href="#" class="btn btn-xs btn-primary js-clon-clonar"><i class="fa fa-clone"></i> Duplicar</a>-->
									</td>
								</tr>
								<? if ( ! empty($this->request->data['Adjunto']) ) : ?>
								<? foreach ( $this->request->data['Adjunto'] as $index => $adjunto ) : ?>
								<tr>
									<td>
										<?= $this->Form->hidden(sprintf('Adjunto.%d.id', $index)); ?>
										<?= $this->Form->input(sprintf('Adjunto.%d.nombre', $index), array('class' => 'form-control')); ?>
									</td>
									<td><?= $this->Form->input(sprintf('Adjunto.%d.descripcion', $index), array('class' => 'form-control')); ?></td>
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
											<span class="or">o actualícelo</span>
										<?= $this->Form->input(sprintf('Adjunto.%d.url_archivo', $index), array('class' => '', 'type' => 'file')); ?>
									<? else : ?>
										<?= $this->Form->input(sprintf('Adjunto.%d.url_archivo', $index), array('class' => '', 'type' => 'file')); ?>
									<? endif; ?>
									</td>
									<td><?= $this->Form->input(sprintf('Adjunto.%d.activo', $index), array('class' => 'icheckbox')); ?></td>
									<td>
										<a href="#" class="btn btn-xs btn-danger js-clon-eliminar">Quitar</a>
										<!--<a href="#" class="btn btn-xs btn-primary js-clon-clonar"><i class="fa fa-clone"></i> Duplicar</a>-->
									</td>
								</tr>
								<? endforeach; ?>
								<? endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4">&nbsp;</td>
									<td><a href="#" class="btn btn-xs btn-success js-clon-agregar"><i class="fa fa-plus"></i> Agregar archivo</a></td>
								</tr>
							</tfoot>
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
								<!--<th>Precio</th>-->
								<th>Grupo</th>
								<!--<th>Proveedor</th> -->
								<th>Marca</th>
								<th>Fabricante</th>
								<th>Aceptado</th>
								<th>Acción</th>
							</thead>
							<tbody>
							<? foreach ($this->request->data['Producto'] as $indice => $producto) : ?>
								<tr>
									<td><?= $referencia = (!empty($producto['referencia'])) ? $producto['referencia'] : 'No agregado' ; ?></td>
									<td><?= $nombre = (!empty($producto['nombre_final'])) ? $producto['nombre_final'] : 'No agregado' ; ?></td>
									<!--<td><?= $precio = (!empty($producto['precio'])) ? CakeNumber::currency($producto['precio'], 'CLP') : 'No agregado' ; ?></td>-->
									<td><?= $grupo = (!empty($producto['grupocaracteristica_id'])) ? $producto['Grupocaracteristica']['nombre'] : 'No agregado' ; ?></td>
									<!-- <td><?= $proveedor = (!empty($producto['proveedor_id'])) ? $producto['Proveedor']['name'] : 'No agregado' ; ?></td> -->
									<td><?= $marca = (!empty($producto['marca_id'])) ? $producto['Marca']['nombre'] : 'No agregado' ; ?></td>
									<td><?= $fabricante = (!empty($producto['fabricante_id'])) ? $producto['Fabricante']['name'] : 'No agregado' ; ?></td>
									<td><?= ($producto['aceptado'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td><?= $this->Html->link('<i class="fa fa-edit"></i> Revisar', array('controller' => 'productos', 'action' => 'review', $producto['id']), array('class' => 'btn btn-info btn-xs', 'rel' => 'tooltip', 'title' => 'Revisar este registro', 'escape' => false)); ?></td>
								</tr>
							<? endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<? /* if ( !empty($revisiones)) : ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Revisiones</h3>
				</div>
				<div class="panel-body">
					<ul class="revision-lista">
					<? foreach ($revisiones as $revision) : ?>
						<li><?=$this->Html->link(sprintf('Revisión #%d %s, creada el %s', $revision['Tarea']['id'], $revision['Tarea']['nombre'], $revision['Tarea']['created']), array('controller' => 'tareas', 'action'=> 'review', $revision['Tarea']['id']), array('target' => '_blank') ); ?></li>
					<? endforeach; ?>
					</ul>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
	<? endif; */?>
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right guardar-botones">
				<input type="submit" class="btn btn-warning" value="Guardar cambios">
				<?= $this->Html->link('Volver', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
			</div>
		</div>
	</div>
	<?= $this->Form->end(); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right guardar-botones">
			<? if ($this->request->data['Tarea']['en_revision'] && !$this->request->data['Tarea']['en_progreso'] && !$this->request->data['Tarea']['finalizado'] && !$this->request->data['Tarea']['rechazado']) : ?>
				<? if ($pNoAceptados == 0 ) : ?>

				<button class="btn btn-success btn-aceptar-tarea" data-toggle="modal" data-target="#calificar"><i class="fa fa-check"></i> Aceptar tarea y finalizar</button>

				<!-- Modal calificar -->
				<div class="modal fade" id="calificar" tabindex="-1" role="dialog" aria-labelledby="calificarLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="calificarLabel"><?= $imagenPerfil = (!empty($this->request->data['Usuario']['imagen'])) ? $this->Html->image(sprintf('Usuario/%d/mini_%s', $this->request->data['Usuario']['id'] , $this->request->data['Usuario']['imagen']), array('class' => 'img-responsive img-circle', 'alt' => $this->request->data['Usuario']['nombre'])) : $this->Html->image('logo_user.jpg', array('class' => 'img-responsive img-circle image-perfil-list', 'alt' => $this->request->data['Usuario']['nombre'])) ; ?>  Calificar a <?= h($this->request->data['Usuario']['nombre']); ?>&nbsp;<?= h($this->request->data['Usuario']['apellidos']); ?></h4>
				      </div>
				      <div class="modal-body">
				        <?= $this->Form->create('Tarea', array('action' => 'accept'), array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				        <?= $this->Form->input('id');?>
				        <?= $this->Form->input('id_usuario', array('type' => 'hidden', 'value' => $this->request->data['Usuario']['id']));?>
				        <?= $this->Form->input('calificacion_media', array('type' => 'hidden', 'value' => '0')); ?>
				        <div class="form-group col-xs-12 col-sm-6">
				        	<label>Califique en una escala de 1 a 5, donde 1 es muy malo y 5 es excelente.</label>
				        	<div class="estrellas">
					        	<?= $this->Html->estrellas(0); ?>
					        </div>
				        </div>
				        <div class="form-group col-xs-12 col-sm-6">
				        		<label>Agregue un comentario <small>(opcional)</small></label>
				        	<textarea class="form-control" name="data[Tarea][mensaje]"></textarea>
				        </div>
				        <div class="form-group col-xs-12 col-sm-12">
				        	<button type="submit" class="btn btn-success btn-block">Finalizar tarea</button>
				        </div>
				        <?= $this->Form->end(); ?>
				      </div>
				    </div>
				  </div>
				</div>
				<? else : ?>
					<label class="label label-form label-warning">Para aprobar la tarea debe aceptar todos los productos.</label>
				<? endif; ?>
				<?= $this->Form->postLink('<i class="fa fa-remove"></i> Rechazar tarea', array('action' => 'refuse', $this->request->data['Tarea']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
			<? endif; ?>
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
						<div class="comentar">
							<?= $this->Form->create('Tarea', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
							<?=	$this->Form->input('id');?>
							<?=	$this->Form->input('usuario_id', array('type' => 'hidden'));?>
							<?= $this->Form->input('Comentario.1.administrador_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Administrador.id'))); ?>
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
</div>
