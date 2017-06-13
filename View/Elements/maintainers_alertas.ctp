
<? if ( $flash = $this->Session->flash('flash') ) : ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-info">
				<a class="close" data-dismiss="alert">&times;</a>
				<?= $flash; ?>
			</div>
		</div>
	</div>
</div>
<? endif; ?>

<? if ( $danger = $this->Session->flash('danger') ) : ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-danger">
				<a class="close" data-dismiss="alert">&times;</a>
				<?= $danger; ?>
			</div>
		</div>
	</div>
</div>
<? endif; ?>

<? if ( $success = $this->Session->flash('success') ) : ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-success">
				<a class="close" data-dismiss="alert">&times;</a>
				<?= $success; ?>
			</div>
		</div>
	</div>
</div>
<? endif; ?>