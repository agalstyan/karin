<div>
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1 id="container">Karina Galstyan</h1>
			</div>
			<div class="panel">
				<div class="panel-body">
					<h2><?=$project->title?></h2>
					<table class="table">
						<tr>
							<?php for($i = 1; $i <= count($project->images); ++$i): ?>
								<td><a href="<?=$project->images[$i-1]['big']?>">
									<img src="<?=$project->images[$i - 1]['thumb']?>" alt=""/>
								</a></td>
								<?=($i % 3 == 0) ? '</tr><tr>' : ''?>
							<?php endfor; ?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>