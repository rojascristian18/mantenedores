<div class="page-title">
	<h2><span class="fa fa-pencil-square-o"></span> Tarea</h2>
</div>
<?= $this->Form->create('Tarea', array('class' => 'form-horizontal tareas-form', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('administrador_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Administrador.id'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Crear Tarea</h3>
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
								<tr>
									<th><?= $this->Form->label('usuario_id', 'Asignar'); ?></th>
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
				<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
				<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end(); ?>   
