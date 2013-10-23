<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>Проекты</h1>
		</div>
	</div>
</div>

<div class="panel panel-default" style="width: 350px">
	<div class="panel-heading">
		<h3 class="panel-title">Список</h3>
	</div>
	<table class="table" style="border-top: 0px">
		<?php if (empty($projects)): ?>
		<tr>
			<td>Записей нет</td>
		</tr>
		<?php else: ?>
		<tr>
			<th style="width: 75%">Название проекта</th>
			<th></th>
		</tr>
		<?php foreach ($projects as $project): ?>
			<tr>
				<td>
					<a href="<?=base_url('admin/projects/show/' . $project->id)?>" title="Редактировать">
						<?=htmlentities($project->title)?>
					</a>
				</td>
				<td>
					<a href="<?=base_url('admin/projects/images/' . $project->id)?>"
					   class="btn btn-xs btn-success" title="Добавить изображения">img</a>
					<a data-url="<?=base_url('admin/projects/delete/' . $project->id)?>" href="#"
					   class="btn btn-xs btn-danger delete-project" title="Удалить">X</a>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<tr>
			<td colspan="2">
				<a href="<?=base_url('admin/projects/add')?>" class="btn btn-xs btn-success" title="Добавить">+</a>
			</td>
		</tr>
	</table>
</div>

<script src="<?=base_url('public/assets/js/admin/projects/index.js')?>"></script>