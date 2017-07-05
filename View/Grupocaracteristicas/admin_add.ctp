<div class="page-title">
	<h2><span class="fa fa-folder"></span> Grupos de caracatrísticas</h2>
</div>
<?= $this->Form->create('Grupocaracteristica', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('tienda_id', array('type' => 'hidden', 'value' => $this->Session->read('Tienda.id')) ); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Grupo de Caracaterísticas</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
								<td><?= $this->Form->input('nombre'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('desripcion', 'Desripcion'); ?></th>
								<td><?= $this->Form->input('desripcion'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('activo', 'Activo'); ?></th>
								<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
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
		<div class="col-xs-12 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Agregar Características al Grupo</h3>
				</div>
				<div class="panel-body">
					<div class="col-xs-12">
						<div class="form-inline form-caracteristicas">
							<div class="form-group">
								<label>Ingrese el ID o nombre de la característica <label class="label label-form label-success">(<?=$totalAtributos?>) disponibles</label></label>
							</div>
							<div class="form-group">
								<input class="form-control input-caracteristicas-buscar" placeholder="1001, Potencia, Motor, etc" type="text"  style="min-width: 350px;">
							</div>
							<div class="form-group">
								<button class="btn btn-primary button-caracteristicas-buscar"><span class="fa fa-plus"></span> Agregar</button>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-stripped" id="tablaCaracteristicas">
							<thead>
								<th>Id</th>
								<th>Características</th>
								<th>Undad de medida</th>
								<th>Acción</th>
							</thead>
							<tbody>
							</tbody>
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
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Agregar Categorías al Grupo</h3>
				</div>
				<div class="panel-body">
					<div class="col-xs-12">
						<div class="form-inline form-categoria">
							<div class="form-group">
								<label>Ingrese el ID o nombre de la categoria</label>
							</div>
							<div class="form-group">
								<input class="form-control input-categoria-buscar" placeholder="Taladros, Accesorios, etc." type="text"  style="min-width: 350px;">
							</div>
							<div class="form-group">
								<button class="btn btn-primary button-categoria-buscar"><span class="fa fa-plus"></span> Agregar</button>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-stripped" id="tablaCategoria">
							<thead>
								<th>Id</th>
								<th>Categoría</th>
								<th>Acción</th>
							</thead>
							<tbody>
							</tbody>
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
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Agregar Palabras Claves al Grupo</h3>
				</div>
				<div class="panel-body">
					<div class="col-xs-12">
						<div class="form-inline form-palabraclave">
							<div class="form-group">
								<label>Ingrese el ID o nombre de la palabra clave</label>
							</div>
							<div class="form-group">
								<input class="form-control input-palabraclave-buscar" placeholder="Taladros, Accesorios, etc." type="text"  style="min-width: 350px;">
							</div>
							<div class="form-group">
								<button class="btn btn-primary button-palabraclave-buscar"><span class="fa fa-plus"></span> Agregar</button>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-stripped" id="tablaPalabraclave">
							<thead>
								<th>Palabra Clave</th>
								<th style="max-width: 60px">Acción</th>
							</thead>
							<tbody>
							</tbody>
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
	</div>
</div>
<?= $this->Form->end(); ?>
