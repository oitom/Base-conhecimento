<section>
	<div class="container">
		<div id="estrutura-base" class="row bloco-conteudo">
			<div class="col-xs-12">
				<?php 
					$caminho = "conteudo";
					switch ($tipo) {
						
						case 1: $titulo = "Artigos"; $icone = "fa fa-file-text-o"; break; 
						case 2: $titulo = "Vídeos"; $icone = "glyphicon glyphicon-facetime-video"; break; 
						case 3: $titulo = "Imagens"; $icone = "glyphicon glyphicon-picture"; break; 
						case 4: $titulo = "Audios"; $icone = "glyphicon glyphicon-volume-up"; break; 
						case 5: $titulo = "Livros"; $icone = "glyphicon glyphicon-book"; break; 
						case 6: $titulo = "Perguntas"; $icone = "glyphicon glyphicon-question-sign"; break; 
						case 7: $titulo = "Links"; $icone = "glyphicon glyphicon-link"; break; 
						case 8: $titulo = "Outros Arquivos"; $icone = "glyphicon glyphicon-file"; break; 
						case 9: $titulo = "Base"; $icone = "fa fa-database"; $caminho = "base"; break;
					}
				 ?>
				<?php if(count($conteudos) > 0) { ?>
					<div class="row">
						<div class="col-xs-12">
							<h4><?php echo $titulo."(".count($conteudos).")";?></h4>
						</div>
					</div>
					
					<div class="row icone-conteudos">
						<?php foreach ($conteudos as $conteudo) {  ?>
							<div class="col-xs-12 col-md-4">
								<div class="conteudos">
									<a href="<?php echo site_url($caminho.'/index/'.$conteudo->codigo) ?>"><span class="<?php echo $icone; ?>"></span><?php echo  $tipo != 9 ? $conteudo->titulo : $conteudo->nome; ?></a>
								</div>
							</div>
						<?php } ?>	
					</div>
				<?php } 
					else{ ?>
					<div class="row">
						<div class="col-xs-12">
							<h2>Não existe nenhum conteúdo.</h2>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div> 
</section>