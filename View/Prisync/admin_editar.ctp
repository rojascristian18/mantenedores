<div class="page-title">
	<h2><span class="fa fa-tags"></span> Producto #<?=$prisync['id']; ?> está publicado en <b>Prisync!</b></h2>
</div>
<?= $this->Form->create('Producto', array('id' => 'AgregarProductoPrisync', 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id_prisync', array('value' => $prisync['id'], 'type' => 'hidden')); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-6 form-group">
							<?= $this->Form->label('name', 'Nombre'); ?>
							<?= $this->Form->input('name', array('value' => $prisync['name'])); ?>
						</div>
						<div class="col-xs-12 col-sm-3 form-group">
							<?= $this->Form->label('brand', 'Marca'); ?>
							<?= $this->Form->input('brand', array('value' => $prisync['brand']['name'])); ?>
						</div>
						<div class="col-xs-12 col-sm-3 form-group">
							<?= $this->Form->label('category', 'Categoria'); ?>
							<?= $this->Form->input('category', array('value' => $prisync['category']['name'])); ?>
						</div>
						<div class="col-xs-12 col-sm-6 form-group">
							<?= $this->Form->label('product_code', 'Código interno'); ?>
                            <?= $this->Form->input('product_code', array('value' => $prisync['product_code'])); ?>
						</div>
						<div class="col-xs-12 col-sm-6 form-group">
							<?= $this->Form->label('cost', 'Precio para Prisync'); ?>
							<?= $this->Form->input('cost', array('class' => 'mask_money form-control', 'value' => intval($prisync['product_cost']))); ?>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<? if(!empty($this->request->data['Competidor'])): ?>
							<div class="table-responsive">
								<table class="table table-bordered">
									<caption>Listado de competidores</caption>
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Url</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?= $this->request->data['Tarea']['Tienda']['nombre']; ?></td>
											<td><?= $this->Form->select('Competidor.00.url', $urlProducto, array('class' => 'form-control', 'empty' => false)); ?></td>
											<td><a href="" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Ver</a></td>
										</tr>
									<? foreach ($this->request->data['Competidor'] as $ic => $competidor) : ?>
										<tr>
											<td>
												<?= $this->Form->input(sprintf('Competidor.%d.id_prisync', $ic), array('type' => 'hidden', 'value' => $competidor['CompetidoresProducto']['id_prisync'])); ?>
												<?= $this->Form->input(sprintf('Competidor.%d.id', $ic), array('type' => 'hidden', 'value' => $competidor['CompetidoresProducto']['id'])); ?>
												<?= $competidor['nombre']?></td>
											<td><?= $this->Form->input(sprintf('Competidor.%d.url', $ic), array('value' => $competidor['CompetidoresProducto']['url'], 'required' => true)); ?></td>
											<td><a href="<?=$competidor['CompetidoresProducto']['url'];?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Ver</a></td>
										</tr>
									<? endforeach; ?>
									</tbody>
								</table>
							</div>
							<? else : ?>
								<p>No registra competidores</p>
							<? endif; ?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-right">
						<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="¡Editar en Prisync!">
						<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end(); ?>