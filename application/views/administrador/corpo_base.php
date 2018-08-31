		<div id="menu-horizontal" class="col-sm-12">
			<ul class="nav nav-pills">
				<li role="presentation" class="active"><a href="<?php echo site_url('administrador/bases'); ?>">Bases</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/conteudos'); ?>">Conteúdos</a></li>
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
				<h2> Base <a id="botao-adicionar" class="btn" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-plus"></span>Adicionar</a> </h2>
				<?php if(isset($sucesso)) { ?>
					<div id="msg-sucesso" class="col-sm-12">
						<div class="alert alert-success alert-dismissible" role="alert">
					    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					      	<p><?php echo $sucesso ?></p>
					    </div>
				    </div>
				<?php } ?>

				<?php if(validation_errors() == "" || $funcao != "cadastrar") { ?>
		       		<div id="formulario" class="col-sm-12 panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <?php }else if($funcao == "cadastrar"){ ?>
		        	<div id="formulario" class="col-sm-12 panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		        <?php } ?>
						<hr>
		           		<h3>Adicionar Base</h3>
		        		<div class="col-md-12">
							<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/bases/cadastrar/') ?>">
								<div class="form-group">
									<label for="membro-nome" class="control-label col-md-2">Nome</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="base-nome" name="base-nome" value="<?php echo $funcao != "editar" ? set_value('base-nome') : ""; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="base-descricao" class="control-label col-md-2">Descrição</label>
									<div class="col-md-6">
										<textarea class="form-control" id="base-descricao" name="base-descricao"><?php echo $funcao != "editar" ? set_value('base-descricao') : ""; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2">Privacidade</label>
									<div class="col-md-6">
										<div class="checkbox">
											
											<label for="base-privacidade-publica"> 
												<input id="base-privacidade-publica" name="base-privacidade" <?php if(set_value('base-privacidade') === 1 && $funcao !="editar") echo "checked" ?> type="radio" value="1"> Pública 
											</label>
											<label for="base-privacidade-privada"> <input id="base-privacidade-privada" <?php if(set_value('base-privacidade') === 0  && $funcao !="editar") echo "checked" ?> name="base-privacidade" type="radio" value="0"> Privada </label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="base-nome" class="control-label col-md-2">Base pai</label>
									<div class="col-md-6">
										<select class="form-control" name="base-pai" id="base-plataforma">
												<option value="0">Selecione...</option>
											<?php foreach ($bases as $base) { ?>
												<option value="<?php echo $base->codigo; ?>" <?php if(set_value('base-pai') == $base->codigo && $funcao !="editar") echo "selected" ?> ><?php echo $base->nome; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-8">
										<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
									</div>
								</div>
								<?php if(validation_errors() != "" && $funcao == "cadastrar") { ?>
									<div class="col-md-6 col-md-offset-2">
										<div class="alert alert-danger alert-dismissible" role="alert">
									      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									      <?php echo validation_errors(); ?>

									    </div>
								    </div>
								<?php } ?>
							</form>
						</div>
		        	</div>				
				<?php 
					$limite = 12; // número de conteúdos por página
					$n_paginas = ceil(count($bases) / $limite); //arredonda para cima
				?>
				<input type="hidden" id="limite" value="<?php echo $limite ?>">
				<input type="hidden" id="npaginas" value="<?php echo $n_paginas ?>">
				
				<div class="table-responsive">
					<table id="tabela" class="table">
						<thead>
							<tr>
								<th></th>
								<th>Nome</th>
								<th>Data</th>
								<th>Proprietário</th>
								<th>Ações</th>
							</tr>
						</thead>
						<tbody class="panel">
						<?php $i = 1; ?>
						<?php foreach ($bases as $base) { 
								if($i <= $limite) {?>
									<tr>
										<td><input type="checkbox"></td>
										<td><?php echo $base->nome; ?></td>
										<td><?php echo date("d/m/Y", strtotime($base->data_hora)); ?></td>
										<td><?php echo $base->usuario->nome; ?></td>
										<td class="text-center">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-<?php echo $base->codigo; ?>">
												<span class="fa fa-binoculars"></span>
												<text class="hidden-conteudo"> Visualizar</text> 
											</button>
											<div class="modal fade bs-example-modal-lg" id="modal-<?php echo $base->codigo; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="modal">
    <div class="modal-content" id="modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $base->nome; ?></h4>
      </div>
      <div class="modal-body" id="corpo-modal">
        <iframe src="<?php echo site_url('base/modal/').'/'.$base->codigo; ?>"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>	
      </div>
    </div>
  </div>
</div>
											<a href="#editar-<?php echo $base->codigo; ?>" class="btn btn-warning" data-toggle="collapse" data-parent="#tabela-base" aria-expanded="true" aria-controls="editar-<?php echo $base->codigo; ?>">
												<text class="hidden-conteudo">Editar</text> 
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
											<a href="<?php echo site_url('administrador/bases/excluir/').'/'.$base->codigo; ?>" class="btn btn-danger">
												<text class="hidden-conteudo">Excluir</text> 
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</td>
									</tr>
									<?php if(validation_errors() == "" || $funcao != "editar" || $codigo != $base->codigo) { ?>
				       					<tr class="panel-collapse collapse" id="editar-<?php echo $base->codigo; ?>">
				        			<?php }else if($funcao == "editar"){ ?>
										<tr class="panel-collapse collapse in" id="editar-<?php echo $base->codigo; ?>">
									<?php } ?>
											<td colspan="5">
												<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/bases/editar/').'/'.$base->codigo; ?>">
													<div class="form-group">
														<label for="membro-nome" class="control-label col-md-2">Nome</label>
														<div class="col-md-6">
															<input type="text" class="form-control" id="base-nome" name="base-nome" value="<?php echo $base->nome; ?>">
														</div>
													</div>
													<div class="form-group">
														<label for="base-descricao" class="control-label col-md-2">Descrição</label>
														<div class="col-md-6">
															<textarea class="form-control" id="base-descricao" name="base-descricao"><?php echo $base->descricao; ?></textarea>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-2">Privacidade</label>
														<div class="col-md-6">
															<div class="checkbox">
																
																<label for="base-privacidade-publica"> 
																	<input id="base-privacidade-publica" name="base-privacidade" <?php if($base->publica == 1) echo "checked" ?> type="radio" value="1"> Pública 
																</label>
																<label for="base-privacidade-privada"> <input id="base-privacidade-privada" <?php if($base->publica == 0) echo "checked" ?> name="base-privacidade" type="radio" value="0"> Privada </label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="base-nome" class="control-label col-md-2">Base pai</label>
														<div class="col-md-6">
															<select class="form-control" name="base-pai" id="base-plataforma">
																	<option value="0">Selecione...</option>
																<?php foreach ($bases as $basepai) { ?>
																	<option value="<?php echo $basepai->codigo; ?>" <?php if($basepai->codigo == $base->codigo_pai) echo "selected" ?> ><?php echo $basepai->nome; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8">
															<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
														</div>
													</div>
													<?php if(validation_errors() != "" && $codigo == $base->codigo) { ?>
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
				<?php if($n_paginas > 1){ ?>
					<div class="row">
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
	</div>
</section>