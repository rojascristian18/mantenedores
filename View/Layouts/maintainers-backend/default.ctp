<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Trabajo | Mantenedores</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?= $this->Html->meta('icon'); ?>
		<?= $this->Html->css(array(
			'/maintainers-backend/css/theme-nodriza',
			'/maintainers-backend/css/custom',
			/*
			'/maintainers-backend/css/ion/ion.rangeSlider',
			'/maintainers-backend/css/ion/ion.rangeSlider.skinFlat',
			'/maintainers-backend/css/cropper/cropper.min.css',
			'/maintainers-backend/css/jstree/jstree.min'
			*/
		)); ?>
		<?= $this->fetch('css'); ?>
		<?= $this->Html->scriptBlock("var webroot = '{$this->webroot}';"); ?>
		<?= $this->Html->scriptBlock("var fullwebroot = '{$this->Html->url('', true)}';"); ?>
		<?= $this->Html->script(array(
			'/maintainers-backend/js/plugins/jquery/jquery.min',
			'/maintainers-backend/js/plugins/jquery/jquery-ui.min',
			'/maintainers-backend/js/plugins/bootstrap/bootstrap.min',
			'/maintainers-backend/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min',
			'/maintainers-backend/js/plugins/bootstrap/bootstrap-select',
			'/maintainers-backend/js/plugins/bootstrap/bootstrap-datepicker',
			'/maintainers-backend/js/plugins/smartwizard/jquery.smartWizard-2.0.min',
			
			'/maintainers-backend/js/plugins/jquery-validation/jquery.validate',
			'/maintainers-backend/js/plugins/summernote/summernote',
			'/maintainers-backend/js/plugins/summernote/summernote_espanol',
			'/maintainers-backend/js/plugins/bootstrap/bootstrap-file-input',
			'/maintainers-backend/js/plugins/owl/owl.carousel.min',
			'/maintainers-backend/js/plugins/tour/intro.min',
			'/maintainers-backend/js/custom'
			/*
			'/maintainers-backend/js/plugins/bootstrap/bootstrap-datepicker',

			'/maintainers-backend/js/plugins/icheck/icheck.min',
			'/maintainers-backend/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min',
			'/maintainers-backend/js/plugins/summernote/summernote',
			'/maintainers-backend/js/plugins/codemirror/codemirror',
			'/maintainers-backend/js/plugins/codemirror/mode/sql/sql',

			'/maintainers-backend/js/plugins',
			'/maintainers-backend/js/plugins/owl/owl.carousel.min',
			//'/maintainers-backend/js/actions',
			//'/maintainers-backend/js/demo_sliders',
			//'/maintainers-backend/js/demo_charts_morris',

			'/maintainers-backend/js/plugins/morris/raphael-min',
			'/maintainers-backend/js/plugins/morris/morris.min',
			'/maintainers-backend/js/custom',
			//'/maintainers-backend/js/demo_dashboard',
			'/maintainers-backend/js/plugins/ion/ion.rangeSlider.min',
			'/maintainers-backend/js/plugins/rangeslider/jQAllRangeSliders-min',

			'/js/vendor/bootstrap3-typeahead'
			*/
		)); ?>
		<?= $this->fetch('script'); ?>
	</head>
	<body>
        <div class="page-container">
			<?= $this->element('maintainers_menu_lateral'); ?>
            <div class="page-content">
                <?= $this->element('maintainers_menu_superior'); ?>
				<?= $this->element('breadcrumbs'); ?>
				<?= $this->element('maintainers_alertas'); ?>
				<?= $this->fetch('content'); ?>
			</div>
		</div>
        <audio id="audio-alert" src="<?= $this->Html->url('/maintainers-backend/audio/alert.mp3'); ?>" preload="auto"></audio>
        <audio id="audio-fail" src="<?= $this->Html->url('/maintainers-backend/audio/fail.mp3'); ?>" preload="auto"></audio>
		<?= $this->Html->script(array('/maintainers-backend/js/actions')); ?>

		<? if ( $this->Session->read('Auth.Mantenedor.tour_inicio') ) : ?>
		<script type="text/javascript">
			/*$(window).on('load', function(){
				introJs().start();
			});*/
		</script>
		<? endif; ?>
    </body>
</html>
