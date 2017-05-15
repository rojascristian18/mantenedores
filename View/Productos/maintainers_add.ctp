<?= $this->Form->create('Producto', array('class' => 'form-horizontal validate-product', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('tarea_id', array('type' => 'hidden', 'value' => $miTarea['Tarea']['id'])); ?>
<div class="page-title">
	<h2><span class="fa fa-shopping-bag"></span> Agregar nuevo producto</h2>
	<div class="pull-right">
		<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar producto">
		<?= $this->Html->link('Cancelar y volver', array('controller' => 'tareas', 'action' => 'work', $miTarea['Tarea']['id']), array('class' => 'btn btn-danger')); ?>
	</div>
</div>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<p>Usted está creando un producto para la tarea <b>identificador #<?=$miTarea['Tarea']['id'];?></b>.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default tabs">
				<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab"><i class="fa fa-info"></i> Información</a></li>
						<li role="presentation"><a href="#precio" aria-controls="precio" role="tab" data-toggle="tab"><i class="fa fa-dollar"></i> Precio</a></li>
						<li role="presentation"><a href="#dimensiones" aria-controls="dimensiones" role="tab" data-toggle="tab"><i class="fa fa-crop"></i> Dimensiones</a></li>
						<li role="presentation"><a href="#caracteristicas" aria-controls="caracteristicas" role="tab" data-toggle="tab"><i class="fa fa-object-group"></i> Características</a></li>
						<li role="presentation"><a href="#proveedor" aria-controls="proveedor" role="tab" data-toggle="tab"><i class="fa fa-truck"></i> Proveedor</a></li>
						<li role="presentation"><a href="#imagenes" aria-controls="imagenes" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i> Imágenes</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="panel-body tab-content">
						<div role="tabpanel" class="tab-pane row active" id="informacion">
							<div class="row">
								<div class="form-group col-xs-12 col-sm-6">
									<?= $this->Form->label('nombre', 'Crear el nombre (obligatorio)', array('class' => 'btn-block')); ?>
									<div class="input-grupo">
										<?= $this->Form->input('grupocaracteristica_id', array('class' => 'form-control string_grupo', 'empty' => 'Seleccione tipo de producto')); ?>
									</div>
									<div class="input-marca">
										<?= $this->Form->input('fabricante_id', array('class' => 'form-control string_marca', 'empty' => 'Seleccione marca')); ?>
									</div>
									<div class="input-nombre">
										<?= $this->Form->input('nombre', array('placeholder' => 'Ingrese características importantes', 'class' => 'form-control string_nombre')); ?>
									</div>
								</div>
								<div class="form-group col-xs-12 col-sm-6">
									<?= $this->Form->label('nombre_final', 'Nombre final del producto'); ?>
									<span class="form-control string_nombre_final"><span class="grupo_preview"></span> <span class="nombre_preview"></span> <span class="marca_preview"></span></span>
									<?= $this->Form->input('nombre_final', array('type' => 'hidden', 'class' => 'input_nombre_final')); ?>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<?= $this->Form->label('referencia', 'Referencia (obligatorio)'); ?>
								<?= $this->Form->input('referencia', array('placeholder' => 'Ingrese referencia del producto')); ?>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<?= $this->Form->label('descripcion_corta', 'Descripción corta (obligatorio)'); ?>
								<?= $this->Form->input('descripcion_corta', array('placeholder' => 'Ingrese una descripción corta del producto', 'class' => 'summernote-small')); ?>
							</div>
							<div class="form-group col-xs-12">
								<?= $this->Form->label('descripcion', 'Descripción completa (obligatorio)'); ?>
								<p>Ingrese una descripción completa del producto, puede agregar etiquetas HTML para ordenar el texto.</p>
								<?= $this->Form->input('descripcion', array('class' => 'summernote')); ?>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="precio">
							<div class="form-group col-xs-12">
								<?= $this->Form->label('precio', 'Precio (obligatorio)'); ?>
								<div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <?= $this->Form->input('precio', array('class' => 'mask_money form-control', 'required')); ?>
                                </div>
								
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="dimensiones">
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('largo', 'Largo'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('largo'); ?>
                                    <span class="input-group-addon">cm</span>
                                </div>
								
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('alto', 'Alto'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('alto'); ?>
                                    <span class="input-group-addon">cm</span>
                                </div>
								
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('profundidad', 'Profundidad'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('profundidad'); ?>
                                    <span class="input-group-addon">cm</span>
                                </div>
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<?= $this->Form->label('peso', 'Peso'); ?>
								<div class="input-group">
                                    <?= $this->Form->input('peso'); ?>
                                    <span class="input-group-addon">Kg</span>
                                </div>
								
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="caracteristicas">
							<div class="table">
								<table class="table table.stripped">
									<thead>
										<th>Característica</th>
										<th>Valor (obligatorio)</th>
									</thead>
									<tbody class="js-add">
										
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="proveedor">
							<div class="form-group col-xs-12">
								<?= $this->Form->label('proveedor_id', 'Proveedor'); ?>
								<p>Seleccione a un proveedor de la lista (obligatorio)</p>
								<?= $this->Form->input('proveedor_id'); ?>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="imagenes">
							<div class="table-responsive">
								<table class="table js-clon-scope">
									<thead>
										<tr>
											<th>Imagen</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody class="js-clon-contenedor js-clon-blank">
										<tr class="js-clon-base hidden">
											<td><?= $this->Form->input('Imagen.999.imagen', array('disabled' => true, 'type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Imagen de producto')); ?></td>
											<td>
												<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
												<!--<a href="#" class="btn btn-xs btn-primary js-clon-clonar"><i class="fa fa-clone"></i> Duplicar</a>-->
											</td>
										</tr>
										<? if ( ! empty($this->request->data['Imagen']) ) : ?>
										<? foreach ( $this->request->data['Imagen'] as $index => $imagen ) : ?>
										<tr>
											
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
