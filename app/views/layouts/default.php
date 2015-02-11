<!doctype html>
<html>
	<head>
		<meta charset=utf-8>
		<title><?php echo $title; ?></title>
		<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name=author content="Piotr Grabowski // compelo.com">
		<link href="<?php echo URL; ?>css/s.css" media=all rel=stylesheet>
		<link rel="shortcut icon" href="<?php echo URL; ?>favicon.png">
	</head>
	<body>
		<?php echo $this->render('elements' . DS . 'topnav'); ?>

		<div class="container-fluid">
			<div class="row row-offcanvas row-offcanvas-left">
				<?php echo $this->render('elements' . DS . 'menu'); ?>
				<div class="col-xs-12 col-sm-9" data-spy="scroll" data-target="#sidebar-nav">
					<div class="row">
						<?php echo $content; ?>
					</div>
				</div>
			</div>
		</div>

		<?php echo $this->render('elements' . DS . 'footer'); ?>

		<script src="<?php echo URL; ?>js/all.js"></script>
	</body>
</html>