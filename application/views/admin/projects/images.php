<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 id="forms">Изображения проекта "<?=$project->title?>"</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
		<div class="well">
			<!-- The file upload form used as target for the file upload widget -->
			<form>
				<div id="queue"></div>
				<input id="file_upload" name="file_upload" type="file" multiple="true">
			</form>

			<script type="text/javascript">
				<?php $timestamp = time();?>
				$(function() {
					$('#file_upload').uploadify({
						formData     : {
							timestamp : '<?php echo $timestamp;?>',
							token : '<?php echo md5('unique_salt' . $timestamp);?>'
						},
						swf : '<?=base_url('public/assets/swf/uploadify.swf')?>',
						uploader : '<?=base_url('admin/projects/images_upload/' . $project->id)?>',
						onUploadSuccess : function(file, data, response) {
							var template = $('#image-template').clone(),
								file = $.parseJSON(data).file;

							template.find('img').attr('src', file);
							template.show();
							$('#images').prepend(template);
						},
						onUploadError : function(file, errorCode, errorMsg, errorString) {
							alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
						}
					});
				});
			</script>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8">
		<ul class="list-group" id="images">
			<li class="list-group-item" id="image-template" style="display:none;">
				<img src="" alt=""/>
			</li>
		</ul>
	</div>
</div>


<div class="row">
	<div class="col-lg-1">
		<a href="<?=base_url('admin/projects/' . $project->id)?>" class="btn btn-info btn-xs">Назад</a>
	</div>
</div>

<link rel="stylesheet" href="<?=base_url('public/assets/css/uploadify.css')?>" />
<script src="<?=base_url('public/assets/js/jquery.uploadify.min.js')?>"></script>
