<div class="row">
	<div class="col-md-12">
		<div class="corpo-texto">
			<h2>Link:
			<a target="_blank" href="<?php echo $conteudo->link->url ?>">
				<i>	
				<?php 
					$url = $conteudo->link->url;

					if (strlen($url) > 80)
					   $url = substr($url, 0, 50) . '...'; 

					echo $url;
				?>
				</i>
			</a>
			</h2>
			<p><?php echo $conteudo->descricao; ?></p>
		</div>
	</div>
</div>