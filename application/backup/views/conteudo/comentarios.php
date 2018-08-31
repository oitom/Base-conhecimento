</div>

<div id="area-comentario" class="container">
	<div class="row">			
		<div class="col-md-12">
			<h3>Comentários:</h3>
			<?php foreach ($conteudo->comentarios as $comentario) { ?>
				<div class="container texto-comentario">
					<div class="row">
						<div class="col-md-12">

							<ul class="media-list">
						  		<li class="media">
						    		<a class="pull-left" href="#">
						      			<img class="img-thumbnail" width='74' height='74' src="//lh6.googleusercontent.com/-Qsuw_9AAmIk/AAAAAAAAAAI/AAAAAAAAAH0/QQtDWkmynEM/s120-c/photo.jpg" class="fa-kz Zxa" style="cursor: pointer;">
						    		</a>
						    		<div class="media-body">
						      			<h4 class="media-heading">Professor Domingos</h4>
						      			<p><?php echo $comentario->texto; ?></p>
						    		</div>
						  		</li>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>	