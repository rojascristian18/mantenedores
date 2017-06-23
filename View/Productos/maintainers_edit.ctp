<?= $this->Form->create('Producto', array('class' => 'form-horizontal validate-product', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id');?>
<?= $this->Form->input('tarea_id', array('type' => 'hidden', 'value' => $miTarea['Tarea']['id'])); ?>
<?= $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Mantenedor.id'))); ?>
<?= $this->Form->input('ElementosEliminados', array('type' => 'hidden', 'id' => 'ElementosEliminados')); ?>
<div class="page-title">
	<h2><span class="fa fa-shopping-bag"></span> Editar producto</h2>
	<div class="pull-right">
		<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Actualizar producto">
		<?= $this->Html->link('Cancelar y volver', array('controller' => 'tareas', 'action' => 'work', $miTarea['Tarea']['id']), array('class' => 'btn btn-danger')); ?>
	</div>
</div>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<p>Usted está creando un producto para la tarea <b>identificador #<?=$miTarea['Tarea']['id'];?></b>.</p>
			<div class="alert alert-warning" role="alert">
	            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	            <strong>¡Recuerde!</strong> Todos los campos con (*) son obligatorios. Sí usted no encuentra un valor comenteselo al administrador.
	        </div>
		</div>
	</div>
	<div class="row">                        
        <div class="col-md-12">
        	<div class="panel-group accordion accordion-dc">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#materiales"><i class="fa fa-tasks"></i> Detalles de la tarea</a>
                        </h4>
                    </div>                                
                    <div class="panel-body" id="materiales">
                    	<h4>Descripción de la tarea</h4>
                    	<div>
                    		<?= $miTarea['Tarea']['descripcion']; ?>
                    	</div>
                    	<br>
                    	<br>
                    	<h4>Materiales de la tarea</h4>
                       	<? if ( !empty($miTarea['Adjunto']) ) : ?>
                       	<div class="table-responsive">
                       		<table class="table table-bordered">
                       			<thead>
                       				<th>Nombre</th>
                       				<th>Descripción</th>
                       				<th>Acción</th>
                       			</thead>
                       			<tbody>
	                       	<? foreach($miTarea['Adjunto'] as $i => $material) : ?>
	                       		<tr>
	                       			<td><?= h($material['nombre']);?></td>
	                       			<td><?= h($material['descripcion']);?></td>
	                       			<td>
	                       				<? if (!empty($material['url_archivo'])) : ?>
											<?= $this->Html->link(
												'<i class="fa fa-eye"></i> Ver',
												sprintf('/img/Adjunto/%d/%s', $material['id'], $material['url_archivo']),
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
	                       		</tbody>
                       		</table>
                       	</div>
                       	<? else : ?>
                       	<p>Esta tarea no tiene materiales adjuntos.</p>	
                   		<? endif; ?>
                    </div>                                
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default tabs">
				<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab"><i class="fa fa-info"></i> Información</a></li>
						<!--<li role="presentation"><a href="#precio" aria-controls="precio" role="tab" data-toggle="tab"><i class="fa fa-dollar"></i> Precio</a></li>-->
						<li role="presentation"><a href="#dimensiones" aria-controls="dimensiones" role="tab" data-toggle="tab"><i class="fa fa-crop"></i> Dimensiones</a></li>
						<li role="presentation"><a href="#caracteristicas" aria-controls="caracteristicas" role="tab" data-toggle="tab"><i class="fa fa-object-group"></i> Características</a></li>
						<li role="presentation"><a href="#fabricante" aria-controls="fabricante" role="tab" data-toggle="tab"><i class="fa fa-industry"></i> Fabricante</a></li>
						<li role="presentation"><a href="#imagenes" aria-controls="imagenes" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i> Imágenes</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="panel-body tab-content">
						<div role="tabpanel" class="tab-pane row active" id="informacion">
							<div class="row">
								<div class="col-xs-12">
									<h3><?= _('Creando el nombre del producto');?></h3>
								</div>
							</div>
							<div class="divisor-sm"></div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('grupocaracteristica_id', _('Seleccione la categoría del producto (*)'));?>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?= $this->Form->input('grupocaracteristica_id', array('class' => 'form-control string_grupo', 'empty' => 'Seleccione')); ?>
								</div>
							</div>
							<div class="divisor-sm"></div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('marca_id', _('Seleccione la marca del producto (*)'));?>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?= $this->Form->input('marca_id', array('class' => 'form-control string_marca', 'empty' => 'Seleccione marca')); ?>
								</div>
							</div>
							<div class="divisor-sm"></div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('nombre', _('Ingrese carácteristicas del producto como por ejemplo: <b>650W 1,7L 48"</b> (*)'));?>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?= $this->Form->input('nombre', array('placeholder' => 'Ingrese características importantes del producto', 'class' => 'form-control string_nombre')); ?>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('referencia', 'Referencia del producto (*)'); ?><br>
									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#refeenciaProducto">
									  Ejemplo
									</button>
								</div>
								<div class="col-xs-12 col-sm-8">
									<?= $this->Form->input('referencia', array('placeholder' => 'Ingrese referencia del producto', 'class' => 'form-control string_referencia')); ?>
								</div>
							</div>
							<div class="divisor-sm"></div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('nombre_final', 'Nombre final del producto <br/><small><b>(categoría + carácteristicas + marca + referencia)</b></small>'); ?>
								</div>
								<div class="col-xs-12 col-sm-8">
									<span class="form-control string_nombre_final"><span class="grupo_preview"></span> <span class="nombre_preview"></span> <span class="marca_preview"></span> <span class="referencia_preview"></span>
									<?= $this->Form->input('nombre_final', array('type' => 'hidden', 'class' => 'input_nombre_final')); ?>
								</div>
							</div>
							<div class="divisor-md"></div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('descripcion_corta', 'Descripción corta (*)'); ?>
									<p><small>Describa brevemente el producto, destacando sus cualidades, materiales o especificaciones.</small></p>
								</div>
								<div class="col-xs-12 col-sm-8">
									<p><b>Puede agregar formato al texto.</b></p>
									<?= $this->Form->input('descripcion_corta', array('placeholder' => 'Ingrese una descripción corta del producto', 'class' => 'summernote-small')); ?>
								</div>
							</div>
							<div class="divisor-sm"></div>
							<div class="row form-group">
								<div class="col-xs-12 col-sm-4">
									<?= $this->Form->label('descripcion', 'Descripción completa (*)'); ?>
								</div>
								<div class="col-xs-12 col-sm-8">
									<p><b>Puede agregar formato al texto.</b></p>
									<?= $this->Form->input('descripcion', array('class' => 'summernote')); ?>
								</div>
							</div>
						</div>
						<!--<div role="tabpanel" class="tab-pane" id="precio">
							<div class="form-group col-xs-12">
								<?= $this->Form->label('precio', 'Precio (obligatorio)'); ?>
								<div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <?= $this->Form->input('precio', array('class' => 'mask_money form-control', 'required')); ?>
                                </div>
								
							</div>
						</div>-->
						<div role="tabpanel" class="tab-pane" id="dimensiones">
							<div class="alert alert-info" role="alert">
					            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					            Debe agregar las dimensiones del producto embalado o en su caja, no las dimensiones del producto desembalado.
					        </div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('largo', 'Largo (*)'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('largo', array('class' => 'mask_medida form-control', 'type' => 'text')); ?>
                                    <span class="input-group-addon">cm</span>
                                </div>
								
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('alto', 'Alto (*)'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('alto', array('class' => 'mask_medida form-control', 'type' => 'text')); ?>
                                    <span class="input-group-addon">cm</span>
                                </div>
								
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('profundidad', 'Profundidad (*)'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('profundidad', array('class' => 'mask_medida form-control', 'type' => 'text')); ?>
                                    <span class="input-group-addon">cm</span>
                                </div>
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('peso', 'Peso (*)'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('peso', array('class' => 'mask_medida form-control', 'type' => 'text')); ?>
                                    <span class="input-group-addon">Kg</span>
                                </div>
								
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="caracteristicas">
							<div class="alert alert-info" role="alert">
					            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					            Las características del producto las encuentra en la ficha técnica del producto, ya sea, en catálogos, sitio web de la marca, etc.
					        </div>
							<div class="table">
								<table class="table table.stripped">
									<thead>
										<th>Característica</th>
										<th>Valor (*)</th>
										<th>Unidad de medida</th>
										<th>Ejemplo</th>
									</thead>
									<tbody class="js-add">
										
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="fabricante">
							<div class="form-group col-xs-12">
								<?= $this->Form->label('fabricante_id', 'Fabricante'); ?>
								<p>Seleccione a un fabricante de la lista (*)</p>
								<?= $this->Form->input('fabricante_id'); ?>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="imagenes">
							<div class="alert alert-info" role="alert">
					            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					            El peso máximo de la imagen debe ser de <?= configuracion('imagen_peso'); ?> MB.<br>
					            Las medidas de las imágenes deben estar dentro de los siguientes rangos:
					            <ul>
					            	<li><b>Ancho:</b> mínimo <?= configuracion('imagen_ancho_min'); ?>px y máximo de <?= configuracion('imagen_ancho_max')?>px</li>
					            	<li><b>Alto:</b> mínimo <?= configuracion('imagen_alto_min'); ?>px y máximo de <?= configuracion('imagen_alto_max')?>px</li>
					            </ul>
					        </div>
							<div class="table-responsive">
								<table class="table js-clon-scope">
									<thead>
										<tr>
											<th>Imagen (*)</th>
											<th>Ruta absoluta</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody class="js-clon-contenedor js-clon-blank">
										<tr class="js-clon-base hidden">
											<td colspan="2"><?= $this->Form->input('Imagen.999.imagen', array('disabled' => true, 'type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Imagen de producto')); ?></td>
											<td>
												<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
											</td>
										</tr>
										<? if ( ! empty($this->request->data['Imagen']) ) : ?>
										<? foreach ( $this->request->data['Imagen'] as $index => $imagen ) : ?>
											<tr>
												<td>
													<?= $this->Form->hidden(sprintf('Imagen.%d.id', $index)); ?>
													<?= $this->Html->image(sprintf('Imagen/%d/mini_%s', $imagen['id'], $imagen['imagen']));?>
												</td>
												<td>
													<?= $this->Html->link(
														$this->Html->url(sprintf('/img/Imagen/%d/%s', $imagen['id'], $imagen['imagen']),true),
													sprintf('/img/Imagen/%d/%s', $imagen['id'], $imagen['imagen']),
													array(
														'target' => '_blank', 
														'fullbase' => true) 
													); ?>
												</td>
												<td>
													<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
												</td>
											</tr>
										<? endforeach; ?>
										<? endif; ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2">&nbsp;</td>
											<td><a href="#" class="btn btn-xs btn-success js-clon-agregar"><i class="fa fa-plus"></i> Agregar imagen</a></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="pull-right">
							<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar producto">
							<?= $this->Html->link('Cancelar y volver', array('controller' => 'tareas', 'action' => 'work', $miTarea['Tarea']['id']), array('class' => 'btn btn-danger')); ?>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end(); ?>

<!-- Modal Referencia de producto -->
<div class="modal fade" id="refeenciaProducto" tabindex="-1" role="dialog" aria-labelledby="referenciaProductoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="referenciaProductoLabel">Referencia de producto</h4>
      </div>
      <div class="modal-body">
        <?=$this->Html->image('referencia.png', array('class' => 'img-responsive'));?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>