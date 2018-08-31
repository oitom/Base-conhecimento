<section>
	<div class="container">
		<?php if(count($conteudos) > 0 || count($base->sub_bases) > 0) {?>
		<div class="row">
			<div id="pesquisa-na-base" class="input-group">
 				<form method="post" action="">
	 				<input name="pesquisa" id="pesquisa" type="text" class="form-control" results="10" placeholder="Pesquise dentro da base atual.">
	  				<span class="glyphicon glyphicon-search"></span>
  				</form>
		   	</div>
	    </div>
		<div id="estrutura-base" class="row">
			<div class="col-xs-12 col-sm-3">
				<?php if(count($base->sub_bases) > 0){ ?>
				<div class="row">
					<div class="col-xs-12">
						<h4>Subbases</h4>
					</div>
				</div>
				<div class="row bases-pequenas">
				<?php foreach ($base->sub_bases as $base_filho) { ?>
					<div class="col-xs-6 col-sm-12">
						<a href="<?php echo site_url('base/index/'.$base_filho->codigo) ?>"><span class="fa fa-database"></span><?php echo $base_filho->nome; ?></a>
					</div>
				<?php } ?>
				</div>
				<?php } ?>

				<div id="feed-noticias" class="row hidden-xs">
					<div class="col-xs-12">
						<?php if (count($mais_acessados) > 0) { ?>
						<div>
							<h4>Mais acessados</h4>
							<?php foreach ($mais_acessados as $conteudo_acessado){ ?>
								
								<?php 
									switch ($conteudo_acessado->tipo) {
										
										case CTIPO_ARTIGO: $icone = "fa fa-file-text-o"; break; 
										case CTIPO_VIDEO: $icone = "glyphicon glyphicon-facetime-video"; break; 
										case CTIPO_IMAGEM: $icone = "glyphicon glyphicon-picture"; break; 
										case CTIPO_AUDIO: $icone = "glyphicon glyphicon-volume-up"; break; 
										case CTIPO_LIVRO: $icone = "glyphicon glyphicon-book"; break; 
										case CTIPO_PERGUNTA: $icone = "glyphicon glyphicon-question-sign"; break; 
										case CTIPO_LINK: $icone = "glyphicon glyphicon-link"; break; 
										case CTIPO_OUTRO: ; $icone = "glyphicon glyphicon-file"; break;
									}
								 ?>
								<div class="conteudos">
									<a href="<?php echo site_url('conteudo/index/'.$conteudo_acessado->codigo_conteudo) ?>"><span class="<?php echo $icone; ?>"></span> <?php echo $conteudo_acessado->titulo; ?> (<?php echo $conteudo_acessado->total; ?>)</a>
								</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					<div class="col-xs-12">
						<?php if (count($atualizacoes) > 0) { ?>
						<div>
							<h4>Atualizações</h4>
							<?php foreach ($atualizacoes as $conteudo){ ?>
								
								<?php 
									$caminho = "conteudo";
									switch ($conteudo->tipo) {
										
										case CTIPO_ARTIGO: $titulo = "Artigos"; $icone = "fa fa-file-text-o"; break; 
										case CTIPO_VIDEO: $titulo = "Vídeos"; $icone = "glyphicon glyphicon-facetime-video"; break; 
										case CTIPO_IMAGEM: $titulo = "Imagens"; $icone = "glyphicon glyphicon-picture"; break; 
										case CTIPO_AUDIO: $titulo = "Audios"; $icone = "glyphicon glyphicon-volume-up"; break; 
										case CTIPO_LIVRO: $titulo = "Livros"; $icone = "glyphicon glyphicon-book"; break; 
										case CTIPO_PERGUNTA: $titulo = "Perguntas"; $icone = "glyphicon glyphicon-question-sign"; break; 
										case CTIPO_LINK: $titulo = "Links"; $icone = "glyphicon glyphicon-link"; break; 
										case CTIPO_OUTRO: $titulo = "Outros Arquivos"; $icone = "glyphicon glyphicon-file"; break;
									}
								 ?>
								<div class="conteudos">
									<a href="<?php echo site_url('conteudo/index/'.$conteudo->codigo) ?>"><span class="<?php echo $icone; ?>"></span> <?php echo $conteudo->titulo; ?></a>
								</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div>

					<?php if(isset($palavraschave)) { ?>
					<div class="col-xs-12">
						<?php if (count($palavraschave) > 0) { ?>
							<div>
								<h4>Palavras-chave</h4>
								<?php foreach ($palavraschave as $palavra){ ?>
									<div class="conteudos">
										<form action="" method="post">
											<input name="pesquisa" type="hidden" value="<?php echo $palavra->titulo; ?>"> 
											<span class="fa fa-key"></span><input type="submit" class="link-palavra-chave" value="<?php echo $palavra->titulo; ?>">
										</form>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="col-xs-12 col-sm-9 bloco-conteudo">
				<?php if (isset($pesquisa)){ ?>
					
				<div class="row">
					<div class="col-sm-12">
						<p><?php echo count($conteudos); ?> Resultados encontrado(s) para a pesquisa <i><?php echo $pesquisa ?></i>:</p>
					</div>
				</div>
				<?php } ?>
				
				<?php if (count($conteudos) > 0){ ?>

				<?php foreach ($conteudos as $key => $value) { ?>
				
				<?php 
					$caminho = "conteudo";
					switch ($key) {
						
						case "artigos": $chave = "artigos"; $titulo = "Artigos"; $icone = "fa fa-file-text-o"; break; 
						case "videos": $chave = "videos"; $titulo = "Vídeos"; $icone = "glyphicon glyphicon-facetime-video"; break; 
						case "imagens": $chave = "imagens"; $titulo = "Imagens"; $icone = "glyphicon glyphicon-picture"; break; 
						case "audios": $chave = "audios"; $titulo = "Audios"; $icone = "glyphicon glyphicon-volume-up"; break; 
						case "livros": $chave = "livros"; $titulo = "Livros"; $icone = "glyphicon glyphicon-book"; break; 
						case "perguntas": $chave = "perguntas"; $titulo = "Perguntas"; $icone = "glyphicon glyphicon-question-sign"; break; 
						case "links": $chave = "links"; $titulo = "Links"; $icone = "glyphicon glyphicon-link"; break; 
						case "outros": $chave = "outros"; $titulo = "Outros Arquivos"; $icone = "glyphicon glyphicon-file"; break;
					}
				 ?>

				<div class="row">
					<div class="col-xs-12">
						<h4> <?php echo $titulo .'('. count($conteudos[$chave]); ?>)</h4>
					</div>
				</div>
				<div class="row icone-conteudos">
					<?php $contador = 1; 
					foreach ($conteudos[$chave] as $conteudo_) {  ?>
							<div class="col-xs-12 col-md-6">
								<div class="conteudos">
									<a href="<?php echo site_url('conteudo/index/'.$conteudo_->codigo) ?>"><span class="<?php echo $icone; ?>"></span><?php echo $conteudo_->titulo; ?></a>
								</div>
							</div>
						<?php if($contador == 4 && count($conteudos[$chave]) > 4)  { ?>
							<a class="ver-mais glyphicon glyphicon-plus-sign" href="<?php echo site_url('base/ver_mais/'.$base->codigo.'/'.CTIPO_ARTIGO); ?>"></a>
						<?php break; } ?>
						<?php $contador++; 
					} ?>
				</div>
				<?php } ?>


				<?php } else { ?>
					<h2>Esta base não possui conteúdos.</h2>
				<?php } ?>
				
				<div id="feed-noticias" class="row hidden-sm hidden-md hidden-lg">
					<?php if (count($mais_acessados) > 0) { ?>
					<div>
						<h4>Mais acessados</h4>
						<?php foreach ($mais_acessados as $conteudo_acessado){ ?>
								
								<?php 
									switch ($conteudo_acessado->tipo) {
										
										case CTIPO_ARTIGO: $icone = "fa fa-file-text-o"; break; 
										case CTIPO_VIDEO: $icone = "glyphicon glyphicon-facetime-video"; break; 
										case CTIPO_IMAGEM: $icone = "glyphicon glyphicon-picture"; break; 
										case CTIPO_AUDIO: $icone = "glyphicon glyphicon-volume-up"; break; 
										case CTIPO_LIVRO: $icone = "glyphicon glyphicon-book"; break; 
										case CTIPO_PERGUNTA: $icone = "glyphicon glyphicon-question-sign"; break; 
										case CTIPO_LINK: $icone = "glyphicon glyphicon-link"; break; 
										case CTIPO_OUTRO: ; $icone = "glyphicon glyphicon-file"; break;
									}
								 ?>
								<div class="conteudos">
									<a href="<?php echo site_url('conteudo/index/'.$conteudo_acessado->codigo_conteudo) ?>"><span class="<?php echo $icone; ?>"></span> <?php echo $conteudo_acessado->titulo; ?> (<?php echo $conteudo_acessado->total; ?>)</a>
								</div>
							<?php } ?>
					</div>
					<?php } ?>
					<?php if (count($atualizacoes) > 0) { ?>
					<div>
						<h4>Atualizações</h4>
						<?php foreach ($atualizacoes as $conteudo){ ?>
								
								<?php 
									$caminho = "conteudo";
									switch ($conteudo->tipo) {
										
										case CTIPO_ARTIGO: $titulo = "Artigos"; $icone = "fa fa-file-text-o"; break; 
										case CTIPO_VIDEO: $titulo = "Vídeos"; $icone = "glyphicon glyphicon-facetime-video"; break; 
										case CTIPO_IMAGEM: $titulo = "Imagens"; $icone = "glyphicon glyphicon-picture"; break; 
										case CTIPO_AUDIO: $titulo = "Audios"; $icone = "glyphicon glyphicon-volume-up"; break; 
										case CTIPO_LIVRO: $titulo = "Livros"; $icone = "glyphicon glyphicon-book"; break; 
										case CTIPO_PERGUNTA: $titulo = "Perguntas"; $icone = "glyphicon glyphicon-question-sign"; break; 
										case CTIPO_LINK: $titulo = "Links"; $icone = "glyphicon glyphicon-link"; break; 
										case CTIPO_OUTRO: $titulo = "Outros Arquivos"; $icone = "glyphicon glyphicon-file"; break;
									}
								 ?>
								<div class="conteudos">
									<a href="<?php echo site_url('conteudo/index/'.$conteudo->codigo) ?>"><span class="<?php echo $icone; ?>"></span> <?php echo $conteudo->titulo; ?></a>
								</div>
							<?php } ?>
					</div>
					<?php } ?>

					<?php if(isset($palavraschave)) { ?>
						<?php if (count($palavraschave) > 0) { ?>
							<div>
								<h4>Palavras-chave</h4>
								<?php foreach ($palavraschave as $palavra){ ?>
									
										<form action="" method="post">
											<input name="pesquisa" type="hidden" value="<?php echo $palavra->titulo; ?>"> 
											<input type="submit" class="link-palavra-chave" value="<?php echo $palavra->titulo; ?>">
										</form>
									
								<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>	
			</div>
		</div>
		<?php }else { // senão existir conteudos e subbases?>
		<h2>Página em desenvolvimento, esta Base não possui conteúdos!</h2>
		<p>Talvez uma pesquisa ajude</p>

		<?php } ?>
	</div> 
</section>