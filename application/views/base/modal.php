	<header id="cabecalho-base">
		<div class="container">
			<div class="row">
				<div class="col-sm-1 bases-grandes">
					<span class="fa fa-database"></span>
				</div>
				<div class="col-sm-11">
					<div class="row">
						<div class="col-sm-11">
							<h1>
								<?php echo $titulo ?>	
							</h1>
						</div>
						<div id="proprietario-xs"class="col-xs-12 icone-usuario hidden-sm hidden-md hidden-lg">
							<?php if (!empty($usuarios['proprietarios'])) { ?>
								<div class="row">
									<div class="col-xs-12">
										<strong>Proprietários: </strong>
										<?php foreach ($usuarios['proprietarios'] as $proprietario) { ?>
												<span class="glyphicon glyphicon-user"></span>
												<label><?php echo $proprietario->nome; ?></label>
										<?php } ?>
									</div>
								</div>
							<?php } ?>	

							<?php if (!empty($usuarios['colaboradores'])) { ?>
								<div class="row">
									<div class="col-xs-12">
										<strong>Colaboradores: </strong>
										<?php foreach ($usuarios['colaboradores'] as $colaborador) { ?>
												<span class="glyphicon glyphicon-user"></span>
												<label><?php echo $colaborador->nome; ?></label>
										<?php } ?>
									</div>
								</div>
							<?php } ?>	
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="descricao-base">
							<?php echo $base->descricao; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>



<section>
	<div class="container">
		<?php if(count($conteudos) > 0 || count($base->sub_bases) > 0) {?>
		<div id="estrutura-base" class="row">
			<div class="col-xs-12 bloco-conteudo">

				<?php if(count($base->sub_bases) > 0){ ?>
				<div class="row">
					<div class="col-xs-12">
						<h4>Subbases</h4>
					</div>
				</div>
				<div class="row bases-pequenas">
					<?php foreach ($base->sub_bases as $base_filho) { ?>
					<div class="col-xs-4">
							<?php if($base_filho->restricao == "publica" || isset($acesso)){ ?>
								<span class="fa fa-database">
									<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-1x icone-total-base"></i>
										<i class="fa fa-check fa-stack-1x fa-inverse icone-dentro-total-base"></i>
									</span>
								</span>
							<?php }
							else{ 
								if($base_filho->restricao == "parcial") { ?>
									<span class="fa fa-database">
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-1x icone-parcial-base"></i>
											<i class="fa fa-exclamation fa-stack-1x text-danger icone-dentro-parcial-base"></i>
										</span>
									</span>
								<?php }
								else if ($base_filho->restricao == "restrita"){?>
									<span class="fa fa-database">
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-1x icone-restrito-base"></i>
											<i class="fa fa-remove fa-stack-1x text-danger icone-dentro-restrito-base"></i>
										</span>
									</span>
								<?php } ?>
							<?php } ?>
							<?php echo $base_filho->nome; ?>
					</div>
				<?php } ?>
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
							<div class="col-xs-6">
								<div class="conteudos">
									<a>
										<?php if(isset($acesso) || $conteudo_->publico == 1){ ?>
											<span class="<?php echo $icone; ?>">
												<span class="fa-stack fa-lg">
													<i class="fa fa-circle fa-stack-1x icone-total<?php if($chave == "artigos") echo "-fafa"; ?>"></i>
													<i class="fa fa-check fa-stack-1x fa-inverse icone-dentro-total<?php if($chave == "artigos") echo "-fafa"; ?>"></i>
												</span>
											</span>
										<?php }
										else{ 
											if($conteudo_->publico == 0) { ?>
												<span class="<?php echo $icone; ?>">
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-1x icone-restrito<?php if($chave == "artigos") echo "-fafa"; ?>"></i>
								













														<i class="fa fa-remove fa-stack-1x text-danger icone-dentro-restrito<?php if($chave == "artigos") echo "-fafa"; ?>"></i>
													</span>
												</span>
											<?php }
											else {?>
												<span class="<?php echo $icone; ?>">
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-1x icone-parcial<?php if($chave == "artigos") echo "-fafa"; ?>"></i>
														<i class="fa fa-exclamation fa-stack-1x text-danger icone-dentro-parcial<?php if($chave == "artigos") echo "-fafa"; ?>"></i>
													</span>
												</span>
											<?php } ?>
										<?php } ?>
										<!--<span class="<?php echo $icone; ?>"></span>-->
										<?php echo $conteudo_->titulo; ?>
									</a>
								</div>
							</div>
						<?php $contador++; 
					} ?>
				</div>
				<?php } ?>


				<?php } else { ?>
					<h2>Esta base não possui conteúdos.</h2>
				<?php } ?>
				
				<div id="feed-noticias" class="row">
					<?php if (count($mais_acessados) > 0) { ?>
					<div class="col-xs-12">
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
									<span class="<?php echo $icone; ?>"></span> <?php echo $conteudo_acessado->titulo; ?> (<?php echo $conteudo_acessado->total; ?>)
								</div>
							<?php } ?>
					</div>
					<?php } ?>
					<?php if (count($atualizacoes) > 0) { ?>
					<div class="col-xs-12">
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
									<span class="<?php echo $icone; ?>"></span> <?php echo $conteudo->titulo; ?>
								</div>
							<?php } ?>
					</div>
					<?php } ?>

					<?php if(isset($palavraschave)) { ?>
						<?php if (count($palavraschave) > 0) { ?>
							<div class="col-xs-12">
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