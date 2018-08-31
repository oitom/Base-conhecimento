<div class="row">
	<div class="col-md-12">
		<div class="container"> 
		    <h2><?php echo $conteudo->pergunta->texto; ?></h2>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="corpo-texto"><h3>Respostas:</h3></div>

		<div class="container texto-comentario">

			<?php foreach ($conteudo->pergunta->respostas as $resposta) { ?>
				
				<div class="row">
					<div class="col-md-12">

						<ul class="media-list">
					  		<li class="media">
					    		<a class="pull-left" href="#">
					      			<img class="img-thumbnail" width='74' height='74' src="//lh6.googleusercontent.com/-Qsuw_9AAmIk/AAAAAAAAAAI/AAAAAAAAAH0/QQtDWkmynEM/s120-c/photo.jpg" class="fa-kz Zxa" style="cursor: pointer;">
					    		</a>
					    		<div class="media-body">
					      			<h4 class="media-heading">Professor Domingos</h4>
					      			<p><?php echo $resposta->texto; ?></p>
					    		</div>
					  		</li>
						</ul>
					</div>
				</div>
				
			<?php } ?>
		</div>
	</div>
</div>