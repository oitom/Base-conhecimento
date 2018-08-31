<div class="row">
	<div class="col-md-12">
		<div class="corpo-texto">
			<h2>
				<center>
					<a href="<?php echo $conteudo->arquivo->caminho; ?>"><span class="glyphicon glyphicon-download"></span>
					<p><i>download</i></p>
					</a>
				</center>
			</h2>
			<p><strong>Estensão: </strong><?php echo $conteudo->arquivo->extensao; ?></p>
			<p><strong>Tamanho: </strong><?php echo $conteudo->arquivo->tamanho; ?>kb</p>
			<p><strong>Tipo do arquivo: </strong><?php echo $conteudo->arquivo->outro->descricao; ?></p>
		</div>
	</div>
</div>