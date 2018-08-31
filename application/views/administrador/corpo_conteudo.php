		<div id="menu-horizontal" class="col-sm-12">
			<ul class="nav nav-pills	">
				<li role="presentation"><a href="<?php echo site_url('administrador/bases'); ?>">Bases</a></li>
				<li role="presentation" class="active"><a href="<?php echo site_url('administrador/conteudos'); ?>">Conteúdos</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/usuarios'); ?>">Usuários</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/grupos'); ?>">Grupos</a></li>
				<li role="presentation"><a href="#">Histórico</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/palavrasChave'); ?>">Palavras-chave</a></li>
				<li role="presentation"><a href="#">Aparência</a></li>
				<li role="presentation"><a href="#">Configuração</a></li>
			</ul>
		</div>

		<div id="main" class="col-md-10 conteudos">
			<div>
				<h2> Conteúdos <a id="botao-adicionar" class="btn" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-plus"></span>Adicionar</a> </h2>
				<?php if(isset($sucesso)) { ?>
					<div id="msg-sucesso" class="col-md-12">
						<div class="alert alert-success alert-dismissible" role="alert">
					      	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					      	<p><?php echo $sucesso ?></p>
					     </div>
				    </div>
				<?php } ?>
				<hr>

				<?php if(validation_errors() == "") { ?>
		        	<div id="formulario" class="collapse">
		        <?php } else { ?>
		        	<div id="formulario" class="collapse in">
		        <?php } ?>

		           	<h2>Adicionar Conteúdo</h2>
       				<?php if(validation_errors() != "") { ?>
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger alert-dismissible" role="alert">
						      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						      <?php echo validation_errors(); ?>
						    </div>
					    </div>
					<?php } ?>
		          	<div class="col-md-12">
			          	<!-- <form class="form-horizontal" method="POST" role="form"> -->
			          	<?php echo form_open_multipart('administrador/conteudos', 'class="form-horizontal" metod="post"');?>

							<div class="form-group">
			          			<label for="conteudo-codigo-base" class="col-md-2 form-label">Base:</label>
			          			<div class="col-md-6">
				          			<select name="conteudo-codigo-base" id="conteudo-codigo-base" class="form-control">
				          				<?php foreach ($bases as $base){ ?>
					          				<option value="<?php echo $base->codigo; ?>" <?php echo set_value('conteudo-codigo-base') == $base->codigo ? 'selected="true"':"" ?>><?php echo $base->nome ?></option>
				          				<?php } ?>
				          			</select>
			          			</div>
			          		</div>

							<div class="form-group">
			          			<label for="conteudo-titulo" class="col-md-2 control-label">Titulo:</label>
			          			<div class="col-md-6">
			          				<input type="text" name="conteudo-titulo" id="conteudo-titulo" class="form-control" value="<?php echo set_value('conteudo-titulo'); ?>">
			          			</div>
			          		</div>

			          		<div class="form-group">
			          			<label for="conteudo-descricao" class="col-md-2 control-label">Descrição:</label>
			          			<div class="col-md-6">
			          				<textarea name="conteudo-descricao" id="conteudo-descricao" class="form-control"><?php echo set_value('conteudo-titulo'); ?></textarea>
			          			</div>
			          		</div>

							<div class="form-group">
			          			<label for="conteudo-tipo" class="col-md-2 form-label">Tipo:</label>
			          			<div class="col-md-6">
			          				<select name="conteudo-tipo" id="conteudo-tipo" class="form-control">
			          					<?php $tipos = explode(',', $plataforma->tipo_bloqueio); ?>
			          					<?php if(!in_array('1', $tipos)){ ?><option value="1" <?php echo set_value('conteudo-tipo') == 1 ? 'selected="true"':"" ?> id-form="#form-artigo">Artigo</option><?php } ?>	
			          					<?php if(!in_array('2', $tipos)){ ?><option value="2" <?php echo set_value('conteudo-tipo') == 2 ? 'selected="true"':"" ?> id-form="#form-video">Vídeo</option><?php } ?>	
			          					<?php if(!in_array('3', $tipos)){ ?><option value="3" <?php echo set_value('conteudo-tipo') == 3 ? 'selected="true"':"" ?> id-form="#form-imagem">Imagem</option><?php } ?>	
			          					<?php if(!in_array('4', $tipos)){ ?><option value="4" <?php echo set_value('conteudo-tipo') == 4 ? 'selected="true"':"" ?> id-form="#form-audio">Audio</option><?php } ?>	
			          					<?php if(!in_array('5', $tipos)){ ?><option value="5" <?php echo set_value('conteudo-tipo') == 5 ? 'selected="true"':"" ?> id-form="#form-livro">Livro</option><?php } ?>	
			          					<?php if(!in_array('6', $tipos)){ ?><option value="6" <?php echo set_value('conteudo-tipo') == 6 ? 'selected="true"':"" ?> id-form="#form-pergunta">Perguntas</option><?php } ?>	
			          					<?php if(!in_array('7', $tipos)){ ?><option value="7" <?php echo set_value('conteudo-tipo') == 7 ? 'selected="true"':"" ?> id-form="#form-link">Links</option><?php } ?>	
			          					<?php if(!in_array('8', $tipos)){ ?><option value="8" <?php echo set_value('conteudo-tipo') == 8 ? 'selected="true"':"" ?> id-form="#form-outro">Outros Arquivos</option><?php }?>
			          				</select>
			          			</div>
			          		</div>

			          		<div class="form-group">
			          			<label for="conteudo-palavras" class="col-md-2 form-label">Palavras-Chave:</label>
			          			<div class="col-sm-6">
					          		<select name="conteudo-palavras[]" id="conteudo-palavras" multiple class="form-control">
				 						<?php foreach ($palavras_chave as $palavra_chave){ ?>
											<option value="<?php echo $palavra_chave->codigo ?>"><?php echo $palavra_chave->titulo ?></option>
										<?php } ?>
									</select>
			          			</div>
							</div>

							<div class="form-group">
			          			<label for="conteudo-privacidade" class="col-md-2 form-label">Privacidade</label>
			          			<div class="col-sm-6">
					          			<div class="checkbox">
											<label for="conteudo-privacidade-publica"> 
												<input id="conteudo-privacidade-publica" name="conteudo-privacidade" <?php if(set_value('conteudo-privacidade') === 1 && $funcao !="editar") echo "checked" ?> type="radio" value="1"> Pública 
											</label>
											<label for="conteudo-privacidade-privada"> <input id="conteudo-privacidade-privada" <?php if(set_value('conteudo-privacidade') === 0  && $funcao !="editar") echo "checked" ?> name="conteudo-privacidade" type="radio" value="0"> Privada </label>
										</div>
			          			</div>
							</div>

			          		<div class="col-md-12 collapse" id="load">
			          			<hr>
			          			<center><h3><span class="fa fa-spinner fa-spin"></span></h3></center>
			          		</div>

			          		<div class="col-md-12 collapse" id="form-artigo">
			          			<hr>
			          			<h2><span class="fa fa-file-text-o"></span> Artigo</h2>
			          			<textarea name="artigo-conteudo" class="editor"><?php echo set_value('artigo-conteudo'); ?></textarea>
			          		</div>

			          		<div class="col-md-12 collapse" id="form-video">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-facetime-video"></span> Vídeo</h2>
			          			
			          			<div class="form-group">
								  	<label for="video-url" class="col-md-2 control-label">Link:</label>  
								    <div class="col-md-6">
									    <div class="input-group">
								          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
								          <input class="form-control" name="video-url" id="video-url" type="text" placeholder="Link Externo...">
								        </div>
								    </div>
								</div>
								
								<div class="col-md-10">
									<center>
										<strong>ou</strong>
									</center>
								</div>
								<div class="clearfix"></div>

			          			<div class="form-group">
								  	<label for="video-file" class="col-md-2 control-label">Carregar:</label>  
								    <div class="col-md-6">
								        <input id="video-file" name="video-file" class="form-control" type="file" >
								    </div>
								</div>
			          		</div>

			          		<div class="col-md-12 collapse" id="form-imagem">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-picture"></span> Imagem</h2>
			          			
			          			<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Link:</label>  
								    
								    <div class="col-md-6">
									    <div class="input-group">
								          	<div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
								          	<input class="form-control" name="imagem-url" type="text" placeholder="Link Externo..." value="<?php echo set_value('imagem-url'); ?>">
								        </div>
								    </div>
								</div>
								
								<div class="col-md-10">
									<center>
										<strong>ou</strong>
									</center>
								</div>
								<div class="clearfix"></div>

			          			<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Carregar:</label>  
								    <div class="col-md-6">
								    	<center><img class="img-thumbnail preview-img" src="#"></center>
								        <input class="form-control" type="file" name="imagem-file" onchange="readIMG(this);">
								    </div>
								</div>
			          		</div>

			          		<div class="col-md-12 collapse" id="form-audio">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-volume-up"></span> Audios</h2>
			          			
			          			<div class="form-group">
								  	<label for="audio-url" class="col-md-2 control-label">Link:</label>  
								    <div class="col-md-6">
									    <div class="input-group">
								          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
								          <input id="audio-url" name="audio-url" class="form-control" type="text" placeholder="Link Externo...">
								        </div>
								    </div>
								</div>
								
								<div class="col-md-10">
									<center>
										<strong>ou</strong>
									</center>
								</div>
								<div class="clearfix"></div>

			          			<div class="form-group">
								  	<label for="audio-file" class="col-md-2 control-label">Carregar:</label>  
								    <div class="col-md-6">
								        <input id="audio-file" name="audio-file" class="form-control" type="file" >
								    </div>
								</div>
			          		</div>

			          		<div class="col-md-12 collapse" id="form-livro">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-book"></span> Livros</h2>
			          			
			          			<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Título:</label>  
								    <div class="col-md-6">
								        <input class="form-control" type="text" disabled="true">
								    </div>
								</div>

			          			<div class="form-group">
								  	<label for="livro-subtitulo" class="col-md-2 control-label">Subtitulo:</label>  
								    <div class="col-md-6">
								        <input id="livro-subtitulo" name="livro-subtitulo" class="form-control" type="text" >
								    </div>
								</div>

								<div class="form-group">
								  	<label for="livro-autor" class="col-md-2 control-label">Autor:</label>  
								    <div class="col-md-6">
								        <input id="livro-autor" name="livro-autor" class="form-control" type="text" >
								    </div>
								</div>

								<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Páginas:</label>  
								    <div class="col-md-6">
								        <input id="livro-paginas" name="livro-paginas" class="form-control" type="text" >
								    </div>
								</div>

								<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Edição:</label>  
								    <div class="col-md-6">
								        <input id="livro-edicao" name="livro-edicao"class="form-control" type="text" >
								    </div>
								</div>

								<div class="form-group">
								  	<label for="livro-editora" class="col-md-2 control-label">Editora:</label>  
								    <div class="col-md-6">
								        <input id="livro-editora" name="livro-editora" class="form-control" type="text" >
								    </div>
								</div>

								<div class="form-group">
								  	<label for="livro-ano" class="col-md-2 control-label">Ano:</label>  
								    <div class="col-md-6">
								        <input id="livro-ano" name="livro-ano" class="form-control" type="text" >
								    </div>
								</div>
							</div>

			          		<div class="col-md-12 collapse" id="form-pergunta">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-question-sign"></span> Perguntas</h2>
			          			
			          			<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Pergunta:</label>  
								    <div class="col-md-6">
								    	<textarea id="pergunta-texto" name="pergunta-texto" class="form-control"></textarea>
								    </div>
								</div>
			          		</div>		          		

			          		<div class="col-md-12 collapse" id="form-link">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-link"></span> Links</h2>
			          			
			          			<div class="form-group">
								  	<label for="conteudo-titulo" class="col-md-2 control-label">Link:</label>  
								    <div class="col-md-6">
									    <div class="input-group">
								          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
								          <input class="form-control" type="text" id="link-url" name="link-url" placeholder="Link Externo...">
								        </div>
								    </div>
								</div>
			          		</div>

			          		<div class="col-md-12 collapse" id="form-outro">
			          			<hr>
			          			<h2><span class="glyphicon glyphicon-file"></span> Outros Arquivos</h2>
			          			
			          			<div class="form-group">
								  	<label for="outro-url" class="col-md-2 control-label">Link:</label>  
								    <div class="col-md-6">
									    <div class="input-group">
								          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
								          <input id="outro-url" name="outro-url" class="form-control" type="text" placeholder="Link Externo...">
								        </div>
								    </div>
								</div>
								
								<div class="col-md-10">
									<center>
										<strong>ou</strong>
									</center>
								</div>
								<div class="clearfix"></div>

			          			<div class="form-group">
								  	<label for="outro-file" class="col-md-2 control-label">Carregar:</label>  
								    <div class="col-md-6">
								        <input id="outro-file" name="outro-file" class="form-control" type="file" >
								    </div>
								</div>
								
			          		</div>

			          		<footer class="col-md-12">
		          				<hr>
			          			<center>
				          			<a class="btn btn-default" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
				          			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salvar</button>
			          			</center>
			          		</footer>
			          	</form>
		          	</div>
		        </div>
				 
				<?php 
					$limite = 12; // número de conteúdos por página
					$n_paginas = ceil(count($conteudos) / $limite); //arredonda para cima
					$i=1;
				?>
				<input type="hidden" id="limite" value="<?php echo $limite ?>">
				<input type="hidden" id="npaginas" value="<?php echo $n_paginas ?>">
				<input type="hidden" id="tabela" value="conteudos">

				<div class="table-responsive">
				<table id="tabela" class="table">
					<thead>
					<tr>
						<th></th>
						<th>Título</th>
						<th>Data</th>
						<th>Tipo</th>
						<th>Situação</th>
						<th>Ações</th>
					</tr>
					</thead>
					<tbody class="panel">
					<?php foreach ($conteudos as $conteudo) {
						if($i <= $limite) {?>

						<tr>
							<td><input type="checkbox"></td>
							<td><?php echo $conteudo->titulo; ?></td>
							<td><?php echo date("d/m/Y", strtotime($conteudo->data_hora)); ?></td>
							<td>
								<?php switch ($conteudo->tipo) {case CTIPO_ARTIGO: echo "artigo"; break; ?>
								<?php case CTIPO_VIDEO: echo "video"; break; ?>
								<?php case CTIPO_IMAGEM: echo "imagem"; break; ?>
								<?php case CTIPO_AUDIO: echo "audio"; break; ?>
								<?php case CTIPO_LIVRO: echo "livro"; break; ?>
								<?php case CTIPO_PERGUNTA: echo "pergunta"; break; ?>
								<?php case CTIPO_LINK: echo "link"; break; ?>
								<?php case CTIPO_OUTRO: echo "Outros"; break; ?>
								<?php } ?>
							</td>
							<td>
								<?php if ($conteudo->publico == 1) echo "público";
								else echo "privado"; ?>
							</td>

							<td class="text-center">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-<?php echo $conteudo->codigo; ?>">
									<span class="fa fa-binoculars"></span>
									<text class="hidden-conteudo"> Visualizar</text> 
								</button>
								<div class="modal fade bs-example-modal-lg" id="modal-<?php echo $conteudo->codigo; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-lg" id="modal">
								  	<div class="modal-content" id="modal">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								        <h4 class="modal-title" id="myModalLabel"><?php echo $conteudo->titulo; ?></h4>
								      </div>
								      <div class="modal-body" id="corpo-modal">
								        <iframe src="<?php echo site_url('conteudo/modal/').'/'.$conteudo->codigo; ?>"></iframe>
								      </div>
								      <div class="modal-footer">
								       	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>	
								      </div>
								    </div>
								  </div>
								</div>
								<a href="#editar-<?php echo $conteudo->codigo; ?>" class="btn btn-warning" data-toggle="collapse" data-parent="#tabela-conteudo" aria-expanded="true" aria-controls="editar-<?php echo $conteudo->codigo; ?>">
									<text class="hidden-conteudo">Editar</text> 
									<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a href="<?php echo site_url('administrador/conteudos/excluir/').'/'.$conteudo->codigo; ?>" class="btn btn-danger">
									<text class="hidden-conteudo">Excluir</text> 
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</td>
						</tr>
						<?php if(validation_errors() == "" || $funcao !="editar" || $codigo != $conteudo->codigo){ ?>
							<tr class="panel-collapse collapse" id="editar-<?php echo $conteudo->codigo; ?>">
						<?php }else if($funcao == "editar"){ ?>	
							<tr class="panel-collapse collapse in" id="editar-<?php echo $conteudo->codigo; ?>">
						<?php } ?>

							<td class="form-edit" colspan="6">
								<?php echo form_open_multipart('administrador/conteudos/editar/'.$conteudo->codigo, 'class="form-horizontal" metod="post"');?>
								<div class="form-group"> 
				          			<label for="conteudo-codigo-base" class="col-md-2 control-label">Base:</label>
				          			<div class="col-md-6">
					          			<select name="conteudo-codigo-base" id="conteudo-codigo-base" class="form-control">
					          				<?php foreach ($bases as $base){ ?>
						          				<option value="<?php echo $base->codigo; ?>" <?php echo ($conteudo->codigo_base == $base->codigo) ? 'selected="true"':"" ?>><?php echo $base->nome ?></option>
					          				<?php } ?>
					          			</select>
				          			</div>
				          		</div>

								<div class="form-group">
				          			<label for="conteudo-titulo" class="col-md-2 control-label">Titulo:</label>
				          			<div class="col-md-6">
				          				<input type="text" name="conteudo-titulo" id="conteudo-titulo" class="form-control" value="<?php echo $conteudo->titulo ?>">
				          			</div>
				          		</div>
				          	

				          		<div class="form-group">
				          			<label for="conteudo-descricao" class="col-md-2 control-label">Descrição:</label>
				          			<div class="col-md-6">
				          				<textarea name="conteudo-descricao" id="conteudo-descricao" class="form-control"><?php echo $conteudo->descricao; ?></textarea>
				          			</div>
				          		</div>

					       		<div class="form-group">
				          			<label for="conteudo-titulo" class="col-md-2 control-label">Palavra-chave:</label>
				          			<div class="col-sm-6">
						          		<select name="conteudo-palavras[]" id="conteudo-palavras" multiple class="form-control">
					 						<?php foreach ($palavras_chave as $palavra_chave){ ?>
												<option value="<?php echo $palavra_chave->codigo ?>"><?php echo $palavra_chave->titulo ?></option>
											<?php } ?>
										</select>
				          			</div>
								</div>

								<div class="form-group">
				          			<label for="conteudo-titulo" class="col-md-2 control-label">Privacidade:</label>
				          			<div class="col-sm-6">
						          			<div class="checkbox">
												<label for="conteudo-privacidade-publica"> 
													<input id="conteudo-privacidade-publica" name="conteudo-privacidade" <?php if($conteudo->publico == 1 ) echo "checked" ?> type="radio" value="1"> Pública 
												</label>
												<label for="conteudo-privacidade-privada"> <input id="conteudo-privacidade-privada" <?php if($conteudo->publico == 0 ) echo "checked" ?> name="conteudo-privacidade" type="radio" value="0"> Privada </label>
											</div>
				          			</div>
								</div>
								<input type="hidden" name="conteudo-tipo" id="conteudo-tipo" class="form-control" value="<?php echo $conteudo->tipo ?>">

								<?php if($conteudo->tipo == CTIPO_ARTIGO){ ?>
				          			<div class="col-md-12 collapsed?>" id="form-artigo">
				          			<hr>
				          			<textarea name="artigo-conteudo" class="editor"><?php echo $conteudo->artigo->texto ?></textarea>
				          			<input type="hidden" name="codigo-tipo-artigo" id="codigo-tipo-artigo" value="<?php echo $conteudo->artigo->codigo ?>">
				          			</div>
				          		<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_VIDEO){ ?>
				          			<div class="col-md-12 collapsed" id="form-video">
				          			<hr>
				          			
				          			<div class="form-group">
									  	<label for="video-url" class="col-md-2 control-label">Link:</label>  
									    <div class="col-md-6">
										    <div class="input-group">
									          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
									          <input class="form-control" name="video-url" id="video-url" type="text" placeholder="Link Externo...">
				          						<input type="hidden" name="codigo-tipo-video" id="codigo-tipo-video" value="<?php echo $conteudo->arquivo->codigo ?>">
									        	
									        </div>
									    </div>
									</div>
									
									<div class="col-md-10">
										<center>
											<strong>ou</strong>
										</center>
									</div>
									<div class="clearfix"></div>

				          			<div class="form-group">
									  	<label for="video-file" class="col-md-2 control-label">Carregar:</label>  
									    <div class="col-md-6">
									        <input id="video-file" name="video-file" class="form-control" type="file" >
									    </div>
									</div>
				          			</div>
				          		<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_IMAGEM){ ?>
				          			<div class="col-md-12 collapsed" id="form-imagem">
				          			<hr>
				          			<h2><img src="<?php echo $conteudo->arquivo->caminho ?>" width="200"></h2>
				          			
				          			<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Link:</label>  
									    
									    <div class="col-md-6">
										    <div class="input-group">
									          	<div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
									          	<input class="form-control" name="imagem-url" type="text" placeholder="Link Externo..." value="<?php echo $conteudo->arquivo->caminho ?>">
							          			<input type="hidden" name="codigo-tipo-imagem" id="codigo-tipo-imagem" value="<?php echo $conteudo->arquivo->codigo ?>">
									        	
									        </div>
									    </div>
									</div>
									
									<div class="col-md-10">
										<center>
											<strong>ou</strong>
										</center>
									</div>
									<div class="clearfix"></div>

				          			<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Carregar:</label>  
									    <div class="col-md-6">
									    	<center><img class="img-thumbnail preview-img" src="#"></center>
									        <input class="form-control" type="file" name="imagem-file" onchange="readIMG(this);">
									    </div>
									</div>
				          			</div>
				          		<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_AUDIO){ ?>
				          			<div class="col-md-12 collapsed" id="form-audio">
				          			<hr>
				          			
				          			<div class="form-group">
									  	<label for="audio-url" class="col-md-2 control-label">Link:</label>  
									    <div class="col-md-6">
										    <div class="input-group">
									          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
									          <input id="audio-url" name="audio-url" class="form-control" type="text" placeholder="Link Externo...">
				          					  <input type="hidden" name="codigo-tipo-audio" id="codigo-tipo-audio" value="<?php echo $conteudo->arquivo->codigo ?>">
									        
									        </div>
									    </div>
									</div>
									
									<div class="col-md-10">
										<center>
											<strong>ou</strong>
										</center>
									</div>
									<div class="clearfix"></div>

				          			<div class="form-group">
									  	<label for="audio-file" class="col-md-2 control-label">Carregar:</label>  
									    <div class="col-md-6">
									        <input id="audio-file" name="audio-file" class="form-control" type="file" >
									    </div>
									</div>
				          			</div>
				          		<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_LIVRO){ ?>
				          		    <div class="col-md-12 collapsed" id="form-livro">
				          			<hr>
				          			<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Título:</label>  
									    <div class="col-md-6">
									        <input class="form-control" type="text" disabled="true" value="<?php echo $conteudo->titulo ?>">
				          					<input type="hidden" name="codigo-tipo-livro" id="codigo-tipo-livro" value="<?php echo $conteudo->livro->codigo ?>">

									    </div>
									</div>

				          			<div class="form-group">
									  	<label for="livro-subtitulo" class="col-md-2 control-label">Subtitulo:</label>  
									    <div class="col-md-6">
									        <input id="livro-subtitulo" name="livro-subtitulo" class="form-control" type="text" value="<?php echo $conteudo->livro->subtitulo ?>">
									    	
									    </div>
									</div>

									<div class="form-group">
									  	<label for="livro-autor" class="col-md-2 control-label">Autor:</label>  
									    <div class="col-md-6">
									        <input id="livro-autor" name="livro-autor" class="form-control" type="text" value="<?php echo $conteudo->livro->autor ?>" >
									    </div>
									</div>

									<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Páginas:</label>  
									    <div class="col-md-6">
									        <input id="livro-paginas" name="livro-paginas" class="form-control" type="text" value="<?php echo $conteudo->livro->paginas?>">
									    </div>
									</div>

									<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Edição:</label>  
									    <div class="col-md-6">
									        <input id="livro-edicao" name="livro-edicao"class="form-control" type="text" value="<?php echo $conteudo->livro->edicao ?>">
									    </div>
									</div>

									<div class="form-group">
									  	<label for="livro-editora" class="col-md-2 control-label">Editora:</label>  
									    <div class="col-md-6">
									        <input id="livro-editora" name="livro-editora" class="form-control" type="text" value="<?php echo $conteudo->livro->editora ?>">
									    </div>
									</div>

									<div class="form-group">
									  	<label for="livro-ano" class="col-md-2 control-label">Ano:</label>  
									    <div class="col-md-6">
									        <input id="livro-ano" name="livro-ano" class="form-control" type="text" value="<?php echo $conteudo->livro->ano ?>">
									    </div>
									</div>
									</div>
								<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_PERGUNTA){ ?>
									<div class="col-md-12 collapsed" id="form-pergunta">
				          			<hr>
				          			
				          			<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Pergunta:</label>  
									    <div class="col-md-6">
									    	<textarea id="pergunta-texto" name="pergunta-texto" class="form-control"><?php echo $conteudo->pergunta->texto ?></textarea>
						          			<input type="hidden" name="codigo-tipo-pergunta" id="codigo-tipo-pergunta" value="<?php echo $conteudo->pergunta->codigo ?>">
									    	
									    </div>
									</div>
				          			</div>		          		
				          		<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_LINK){ ?>
				          			<div class="col-md-12 collapsed" id="form-link">
				          			<hr>
				          			
				          			<div class="form-group">
									  	<label for="conteudo-titulo" class="col-md-2 control-label">Link:</label>  
									    <div class="col-md-6">
										    <div class="input-group">
									          <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
									         		<input class="form-control" type="text" id="link-url" name="link-url" placeholder="Link Externo..." value="<?php echo $conteudo->link->url ?>">
						          			 		<input type="hidden" name="codigo-tipo-link" id="codigo-tipo-link" value="<?php echo $conteudo->link->codigo ?>">
									        
									        </div>
									    </div>
									</div>
				          			</div>
				          		<?php } ?>
				          		<?php if($conteudo->tipo == CTIPO_OUTRO){ ?>
				          		  	<div class="col-md-12 collapsed" id="form-outro">
				          			<hr>
				          			
				          			<div class="form-group">
									  	<label for="outro-url" class="col-md-2 control-label">Link:</label>  
									    <div class="col-md-6">
										    <div class="input-group">
									        	<div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
									        	<input id="outro-url" name="outro-url" class="form-control" type="text" placeholder="Link Externo...">
						          				<input type="hidden" name="codigo-tipo-outro" id="codigo-tipo-outro" value="<?php echo $conteudo->outro->codigo ?>">
									        	
									        </div>
									    </div>
									</div>
									
									<div class="col-md-10">
										<center>
											<strong>ou</strong>
										</center>
									</div>
									<div class="clearfix"></div>

				          			<div class="form-group">
									  	<label for="outro-file" class="col-md-2 control-label">Carregar:</label>  
									    <div class="col-md-6">
									        <input id="outro-file" name="outro-file" class="form-control" type="file" >
									    </div>
									</div>	
				          			</div>
				          		<?php } ?>
				          		<footer class="col-md-12">
			          				<hr>
				          			<center>
					          			<a class="btn btn-default" data-toggle="collapse" href="#editar-<?php echo $conteudo->codigo; ?>"><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
					          			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salvar</button>
				          			</center>
				          		</footer>
								<?php if(validation_errors() != "") { ?>
									<div class="col-md-6 col-md-offset-2">
										<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
											<?php echo validation_errors(); ?>
										</div>
									</div>
								<?php } ?>
				          	</form>
			          		</td>
						</tr>
						<?php $i++; 
						}
					} ?>
					</tbody>
				</table>
			</div>
			</div>
			<?php if($n_paginas > 1){ ?>
				<div class="row"  style="width: 100%;margin-left: 0px;">
					<nav class="col-md-12 text-center">
						<ul class="pagination">
							<li><a href="" class="a-prev"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
							<?php for ($i=1; $i <= $n_paginas; $i++) { ?> 
								<li class="p-<?php echo $i ?>"><a href="" class="page"><?php echo $i ?></a></li>
							<?php } ?>
							<li><a href="" class="a-next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
						</ul>
					</nav>
				</div>
			<?php } ?>
		</div>
	</div>
</section>