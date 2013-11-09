<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.png">

	<title>Karina Galstyan</title>

	<?=link_tag('public/assets/css/bootstrap.css');?>
	<?=link_tag('public/assets/css/bootswatch.min.css');?>
	<?=link_tag('public/assets/css/starter-template.css');?>
	<?=link_tag('public/assets/css/font-awesome.min.css');?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?=base_url('public/assets/js/html5shiv.js')?>"></script>
	<script src="<?=base_url('public/assets/js/respond.min.js')?>"></script>
	<![endif]-->

	<script src="<?=base_url('public/assets/js/jquery-2.0.2.min.js')?>"></script>
	<script src="<?=base_url('public/assets/js/bootstrap.min.js')?>"></script>
</head>

<body>

<div class="navbar navbar-default navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=base_url('/')?>">Karina Galstyan</a>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li class="dropdown<?=$this->uri->segment(2) == 'project' ? ' active' : ''?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Проекты<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<?php foreach ($projects as $project):?>
						<li><a href="<?=base_url('project/' . $project->url)?>"><?=$project->title?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
			<?php foreach ($pages as $page):?>
				<li><a href="<?=base_url($page->url)?>"><?=$page->title?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<div class="container">
	<div class="starter-template">