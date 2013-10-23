<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 id="forms">Редактирование статической страницы "<?=$project->title?>"</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-10">
		<div class="well">
			<form id="page-form" class="form-horizontal" method="POST" action="<?=base_url('admin/projects/update/' . $project->id)?>" data-success-url="<?=base_url('admin/projects')?>">
				<fieldset>
					<div class="form-group">
						<label for="title" class="col-lg-2 control-label">Название проекта</label>
						<div class="col-lg-5">
							<input type="text" value="<?=$project->title?>" name="title" class="form-control" id="title" placeholder="Заголовок">
						</div>
					</div>
					<div class="form-group">
						<label for="url" class="col-lg-2 control-label">Url</label>
						<div class="col-lg-5">
							<input type="text" value="<?=$project->url?>" name="url" class="form-control" id="url" placeholder="Url">
						</div>
					</div>
					<div class="form-group">
						<label for="creation-date" class="col-lg-2 control-label">Дата создания</label>
						<div class="col-lg-5">
							<input type="text" value="<?=$project->creation_date?>" name="creation_date" class="form-control" id="creation-date" placeholder="гггг-мм-дд">
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-lg-2 control-label">Описание</label>
						<div class="col-lg-10">
							<textarea name="description" class="form-control" rows="20" id="description"><?=$project->description?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10">
							<button type="reset" class="btn btn-default">Отмена</button>
							<button type="submit" data-text-tmp="Подождите..." data-text-default="Сохранить" class="btn btn-success">Сохранить</button>
							<a href="<?=base_url('admin/projects/images/' . $project->id)?>" class="btn btn-success" title="Добавить изображения">Изображения</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-1">
		<a href="<?=base_url('admin/projects')?>" class="btn btn-info btn-xs">Назад</a>
	</div>
</div>

<script src="<?=base_url('public/assets/js/ckeditor/ckeditor.js')?>"></script>
<script src="<?=base_url('public/assets/js/ckeditor/adapters/jquery.js')?>"></script>
<script src="<?=base_url('public/assets/js/admin/pages/add.js')?>"></script>
