<section>
	<div class="container">
		<div class="row">
			<div id="mensagem-pesquisa" class="input-group">
 				<?php if ($pesquisa != ""){ ?>
 					<h3><?php echo count($conteudos) ?> Resultados encontrado(s) para pesquisa <i> <?php echo $pesquisa; ?>:</i></h3>
 				<?php } ?>
		   	</div>
	    </div>
		<div id="estrutura-base" class="row">
			<div class="col-xs-12 bloco-conteudo">
				<?php if (count($conteudos) > 0){ ?>

				<?php foreach ($conteudos as $key => $value) { ?>
				
				<?php 
					$caminho = "conteudo";
					switch ($key) {
						
						case "bases": $chave = "bases"; $titulo = "Bases"; $icone = "fa fa-database"; break;
						case "artigos": $chave = "artigos"; $titulo = "Artigos"; $icone = "fa fa-file-text-o"; break; 
						case "videos": $chave = "videos"; $titulo = "Vídeos"; $icone = "glyphicon glyphicon-facetime-video"; break; 
						case "imagens": $chave = "imagens"; $titulo = "Imagens"; $icone = "glyphicon glyphicon-picture"; break; 
						case "audios": $chave = "audios"; $titulo = "Audios"; $icone = "glyphicon glyphicon-volume-up"; break; 
						case "livros": $chave = "livros"; $titulo = "Livros"; $icone = "glyphicon glyphicon-book"; break; 
						case "perguntas": $chave = "perguntas"; $titulo = "Perguntas"; $icone = "glyphicon glyphicon-question-sign"; break; 
						case "links": $chave = "links"; $titulo = "Links"; $icone = "glyphicon glyphicon-link"; break; 
						case "outros": $chave = "outros"; $titulo = "Outros Arquivos"; $icone = "glyphicon glyphicon-file"; $caminho = "base"; break;
					}
				 ?>

				<div class="row">
					<div class="col-xs-12">
						<h4> <?php echo $titulo .'('. count($conteudos[$chave]); ?>)</h4>
					</div>
				</div>
				<div class="row icone-conteudos">
					<?php $contador = 1; 
					foreach ($conteudos[$chave] as $conteudo_) {
						if($conteudo_->situacao == 3){  
							if($chave == "bases") $dominio = CTIPO_BASE;
							else $dominio = $conteudo_->tipo;
						?>
							<div class="col-xs-12 col-md-4">
								<div class="conteudos">
									<a href="<?php if($chave != "bases") echo site_url('conteudo/index/'.$conteudo_->codigo); else echo site_url('base/index/'.$conteudo_->codigo); ?>">
										<!--<span class="<?php echo $icone; ?>"></span>-->
										<?php if(isset($conteudo_->acesso) || ($chave != "bases" && $conteudo_->publico == 1) || ($chave == "bases" && $conteudo_->restricao == "publica")){ ?>
											<span class="<?php echo $icone; ?>">
												<span class="fa-stack fa-lg">
													<i class="fa fa-circle fa-stack-1x icone-total<?php if($chave == "artigos" || $chave == "bases") echo "-fafa"; ?>"></i>
													<i class="fa fa-check fa-stack-1x fa-inverse icone-dentro-total<?php if($chave == "artigos" || $chave == "bases") echo "-fafa"; ?>"></i>
												</span>
											</span>
										<?php }
										else{ 
											if($chave == "bases" && $conteudo_->restricao == "parcial") { ?>
												<span class="<?php echo $icone; ?>">
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-1x icone-parcial<?php if($chave == "artigos" || $chave == "bases") echo "-fafa"; ?>"></i>
														<i class="fa fa-exclamation fa-stack-1x text-danger icone-dentro-parcial<?php if($chave == "artigos" || $chave == "bases") echo "-fafa"; ?>"></i>
													</span>
												</span>
											<?php }
											else {?>
												<span class="<?php echo $icone; ?>">
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-1x icone-restrito<?php if($chave == "artigos" || $chave == "bases") echo "-fafa"; ?>"></i>
														<i class="fa fa-remove fa-stack-1x text-danger icone-dentro-restrito<?php if($chave == "artigos" || $chave == "bases") echo "-fafa"; ?>"></i>
													</span>
												</span>
											<?php } ?>
										<?php } ?>
										<p>
											<?php echo $chave == 'bases' ? $conteudo_->nome : $conteudo_->titulo; ?>
										
											<?php if($chave != "bases"){ ?><br>
												<span class="fa fa-database base-min"></span>
												<span class="titulo-base-min"><?php echo $conteudo_->base; ?></span>
											<?php } ?>
										</p>
									</a>
								</div>
							</div>
							<?php if($contador % 3 == 0){ ?>
								<div class="clearfix"></div>
							<?php } ?>
						<?php if($contador == 6 && count($conteudos[$chave]) > 6) { ?>
							<a class="ver-mais glyphicon glyphicon-plus-sign" href="<?php echo site_url('base/ver_mais_filtro/'.$plataforma->codigo.'/'.$dominio.'/'.$pesquisa) ?>"></a>
						<?php break; } ?>
						<?php $contador++; 
						}
					} ?>
				</div>
				<?php } ?>


				<?php } else { ?>
					<h2>Esta base não possui conteúdos.</h2>
				<?php } ?>
				
				<div id="feed-noticias" class="row hidden-sm hidden-md hidden-lg">
					<div id="mais-acessados">
						<h4>Mais acessados</h4>
					</div>
					<div id="atualizacoes">
						<h4>Atualizações</h4>
					</div>
				</div>	
			</div>
		</div>
		</div>
	</div> 
</section>