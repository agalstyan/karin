<div>
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1 id="container">Karina Galstyan</h1>
			</div>
			<div class="panel">
				<div class="panel-body">
					<?php foreach($projects as $project): ?>
					<h3><a href="<?=base_url('project/' . $project->url)?>"><?=$project->title?></a></h3>
					<table class="table">
						<tr>
							<?php foreach ($project->images as $image):?>
								<td><img src="<?=$image['thumb']?>" alt=""/></td>
							<?php endforeach; ?>
						</tr>
					</table>
				    <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>