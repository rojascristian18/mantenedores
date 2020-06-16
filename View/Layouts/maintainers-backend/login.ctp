<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Acceso | Matenedores</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?= $this->Html->meta('icon'); ?>
		<?= $this->Html->css(array(
			'/maintainers-backend/css/theme-dark',
			'/maintainers-backend/css/custom'
		)); ?>
		<?= $this->Html->scriptBlock("var webroot = '{$this->webroot}';"); ?>
		<?= $this->Html->scriptBlock("var fullwebroot = '{$this->Html->url('', true)}';"); ?>
		<?= $this->Html->script(array(
			'/maintainers-backend/js/plugins/jquery/jquery.min',
			'/maintainers-backend/js/plugins/bootstrap/bootstrap.min',
		)); ?>
		<?= $this->fetch('meta'); ?>
		<?= $this->fetch('css'); ?>
		<?= $this->fetch('script'); ?>
	</head>
    <body>
		<div class="login-container">
			<?= $this->fetch('content'); ?>
        </div>
    </body>
</html>
