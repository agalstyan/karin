<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 id="forms">Добавление проекта</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-10">
		<div class="well">
			<form id="page-form" class="form-horizontal" method="POST" action="<?=base_url('admin/projects/create')?>" data-success-url="<?=base_url('admin/projects')?>">
				<fieldset>
					<div class="form-group">
						<label for="title" class="col-lg-2 control-label">Название проекта</label>
						<div class="col-lg-5">
							<input type="text" name="title" class="form-control" id="title" placeholder="Заголовок">
						</div>
					</div>
					<div class="form-group">
						<label for="url" class="col-lg-2 control-label">Url</label>
						<div class="col-lg-5">
							<input type="text" name="url" class="form-control" id="url" placeholder="Url">
						</div>
					</div>
					<div class="form-group">
						<label for="creation-date" class="col-lg-2 control-label">Дата создания</label>
						<div class="col-lg-5">
							<input type="text" name="creation_date" class="form-control" id="creation-date" placeholder="гггг-мм-дд">
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-lg-2 control-label">Описание</label>
						<div class="col-lg-10">
							<textarea name="description" class="form-control" rows="20" id="description"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10">
							<button type="submit" data-text-tmp="Подождите..." data-text-default="Добавить" class="btn btn-success">Добавить</button>
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
<script src="<?=base_url('public/assets/js/admin/projects/add.js')?>"></script>
