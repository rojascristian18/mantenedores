<div class="page-title">
	<h2><span class="fa fa-shopping-bag"></span> Revisar producto <?= $aceptado = ( $this->request->data['Producto']['aceptado'] ) ? '<small>(Validado)</small>' : '<small>(Rechazado)</small>' ; ?></h2>
</div>
<div class="page-content-wrap" id="tarea_container" data-tarea="<?=$this->request->data['Tarea']['id'];?>">
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
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td><b><?= __('Grupo seleccionado'); ?></b></td>
										<td><?= $this->request->data['Grupocaracteristica']['nombre']; ?></td>
									</tr>
									<tr>
										<td><b><?= __('Características para el nombre'); ?></b></td>
										<td><?= $this->request->data['Producto']['nombre']; ?></td>
									</tr>
									<tr>
										<td><b><?= __('Marca seleccionada'); ?></b></td>
										<td><?= $this->request->data['Marca']['nombre']; ?></td>
									</tr>
									<tr>
										<td><b><?= __('Nombre final compuesto'); ?></b></td>
										<td><?= $this->request->data['Producto']['nombre_final']; ?></td>
									</tr>
									<tr>
										<td><b><?= __('Referencia del producto'); ?></b></td>
										<td><?= $this->request->data['Producto']['referencia']; ?></td>
									</tr>
									<tr>
										<td><b><?= __('Descripción corta'); ?></b></td>
										<td><?= $this->request->data['Producto']['descripcion_corta']; ?></td>
									</tr>
									<tr>
										<td><b><?= __('Descripción larga'); ?></b></td>
										<td><?= $this->request->data['Producto']['descripcion']; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<!--<div role="tabpanel" class="tab-pane" id="precio">
							<div class="form-group col-xs-12">
								<label class="btn-block"><?= __('Precio del producto'); ?></label>
								<h2><?= CakeNumber::currency($this->request->data['Producto']['precio'], 'CLP'); ?></h2>
							</div>
						</div>-->
						<div role="tabpanel" class="tab-pane" id="dimensiones">
							<div class="form-group col-xs-12 col-sm-3">
								<? if (!empty($this->request->data['Producto']['largo'])) : ?>
									<label class="btn-block"><?= __('Largo');?></label>
									<?=$this->request->data['Producto']['largo'];?> cm
								<? endif;?>
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<? if (!empty($this->request->data['Producto']['alto'])) : ?> 
									<label class="btn-block"><?= __('Alto');?></label>
									<?=$this->request->data['Producto']['alto'];?> cm
								<? endif;?>
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<? if (!empty($this->request->data['Producto']['profundidad'])) : ?>
									<label class="btn-block"><?= __('Profundidad');?></label>
									<?=$this->request->data['Producto']['profundidad'];?> cm
								<? endif;?>
							</div>
							<div class="form-group col-xs-12 col-sm-3">
								<? if (!empty($this->request->data['Producto']['peso'])) : ?>
									<label class="btn-block"><?= __('Peso');?></label>
									<?=$this->request->data['Producto']['peso'];?> kg
								<? endif;?>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="caracteristicas">
							<div class="table">
								<table class="table table.stripped">
									<thead>
										<th>Característica</th>
										<th>Valor</th>
										<th>Key:Value</th>
									</thead>
									<tbody>
									<? foreach($this->request->data['Especificacion'] as $ix => $especificacion) : ?>
										<tr>
											<td><b><?=$especificacion['Idioma'][0]['EspecificacionIdioma']['name']?></b></td>
											<td><?=$especificacion['EspecificacionesProducto']['valor'];?></td>
											<td><?=$especificacion['EspecificacionesProducto']['llave_valor'];?></td>
										</tr>
									<? endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="fabricante">
							<div class="form-group col-xs-12">
								<label class="btn-block"><?= __('Fabricante'); ?></label>
								<?=$this->request->data['Fabricante']['name'];?>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="imagenes">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Imagen</th>
											<th>Ruta absoluta</th>
										</tr>
									</thead>
									<tbody>
										<? if ( ! empty($this->request->data['Imagen']) ) : ?>
										<? foreach ( $this->request->data['Imagen'] as $index => $imagen ) : ?>
											<tr>
												<td>
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
											</tr>
										<? endforeach; ?>
										<? endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="competencias">
							<div class="table-responsive">
								<table class="table table.stripped">
									<thead>
										<th>Competencia</th>
										<th style="width: 90%;">URL del producto</th>
									</thead>
									<tbody>
										<? foreach($this->request->data['Competidor'] as $ic => $competidor) : ?>
										<tr>
											<td><b><?=$competidor['nombre'];?></b></td>
											<td><?=$competidor['CompetidoresProducto']['url'];?></td>
										</tr>
									<? endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="pull-right">
							<?= $this->Html->link('Volver', array('controller' => 'tareas', 'action' => 'edit', $this->request->data['Tarea']['id']), array('class' => 'btn btn-danger')); ?>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

