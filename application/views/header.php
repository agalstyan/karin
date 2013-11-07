<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.png">

	<title>Karina Galstyan Admin</title>

	<?=link_tag('public/assets/css/bootstrap.css');?>
	<?=link_tag('public/assets/css/starter-template.css');?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?=base_url('public/assets/js/html5shiv.js')?>"></script>
	<script src="<?=base_url('public/assets/js/respond.min.js')?>"></script>
	<![endif]-->

	<script src="<?=base_url('public/assets/js/jquery-2.0.2.min.js')?>"></script>
	<script src="<?=base_url('public/assets/js/bootstrap.min.js')?>"></script>
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<span class="navbar-brand">Админка</span>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php $current_section = $this->uri->segment(2); ?>
				<li <?php if($current_section == 'projects') {echo 'class="active"';}?>>
					<a href="<?=base_url('admin/projects')?>">Проекты</a>
				</li>
				<li <?php if($current_section == 'pages') {echo 'class="active"';}?>>
					<a href="<?=base_url('admin/pages')?>">Статические страницы</a>
				</li>
				<li <?php if($current_section == 'settings') {echo 'class="active"';}?>>
					<a href="<?=base_url('admin/settings')?>">Настройки</a>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>

<div class="container">
	<div class="starter-template">