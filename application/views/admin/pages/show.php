<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 id="forms">Редактирование статической страницы "<?=$page->title?>"</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-10">
		<div class="well">
			<form id="page-form" class="form-horizontal" method="POST" action="<?=base_url('admin/pages/update/' . $page->id)?>" data-success-url="<?=base_url('admin/pages')?>">
				<fieldset>
					<div class="form-group">
						<label for="title" class="col-lg-2 control-label">Заголовок</label>
						<div class="col-lg-5">
							<input type="text" name="title" class="form-control" id="title" value="<?=$page->title?>" placeholder="Заголовок"/>
							<span class="help-block">Заголовок будет отображаться в менюшке сверху</span>
						</div>
					</div>
					<div class="form-group">
						<label for="url" class="col-lg-2 control-label">Url</label>
						<div class="col-lg-5">
							<input type="text" name="url" class="form-control" id="url" value="<?=$page->url?>" placeholder="Url">
							<span class="help-block">Url по которому будет отображаться страница</span>
						</div>
					</div>
					<div class="form-group">
						<label for="text" class="col-lg-2 control-label">Текст</label>
						<div class="col-lg-10">
							<textarea name="text" class="form-control" rows="20" id="text"><?=$page->text?></textarea>
							<span class="help-block">Содержимое страницы</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10">
							<button type="reset" class="btn btn-default">Отмена</button>
							<button type="submit" data-text-tmp="Подождите..." data-text-default="Сохранить" class="btn btn-success">Сохранить</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-1">
		<a href="<?=base_url('admin/pages')?>" class="btn btn-info btn-xs">Назад</a>
	</div>
</div>

<script src="<?=base_url('public/assets/js/ckeditor/ckeditor.js')?>"></script>
<script src="<?=base_url('public/assets/js/ckeditor/adapters/jquery.js')?>"></script>
<script src="<?=base_url('public/assets/js/admin/pages/add.js')?>"></script>
