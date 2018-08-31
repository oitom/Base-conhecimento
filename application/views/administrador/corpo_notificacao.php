				<div id="main" class="col-md-10">
					<div>
						
						<h2> Notificação </h2>
						<hr>
						<div class="table-portable panel">
							<ul class="nav nav-tabs" role="tablist">
								<li class="active">
									<a href="#tabela-notificacao-conteudo" role="tab" data-toggle="tab">
										Conteúdos (<?php echo $notificacoes['conteudos']; ?>)
									</a>
								</li>
								<li>
									<a href="#tabela-notificacao-usuario" role="tab" data-toggle="tab">
										Usuários (<?php echo $notificacoes['usuarios']; ?>)
									</a>
								</li>
							</ul>
							<br />
							<div class="tab-content" id="tabela-notificacoes">
								<div class="tab-pane active" id="tabela-notificacao-conteudo">
									<table class="table">
										<thead>
											<tr>
												<th>Título</th>
												<th>Data</th>
												<th>Tipo</th>
												<th>Situação</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody class="panel">
											<?php   foreach ($conteudos as $conteudo) { ?>
													
											<tr>
												<td><?php echo $conteudo->titulo; ?></td>
												<td><?php echo $conteudo->data_hora; ?></td>
												<td><?php echo $conteudo->tipo; ?></td>
												<td><?php echo $conteudo->situacao; ?></td>
												<td>
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
													<a href="<?php echo site_url('administrador/notificacao/aprovar/').'/'.$conteudo->codigo; ?>" class="btn btn-primary">
														<text class="hidden-conteudo">Aprovar</text> 
														<span class="glyphicon glyphicon-ok"></span>
													</a>
													<a href="<?php echo site_url('administrador/notificacao/revisar/').'/'.$conteudo->codigo; ?>" class="btn btn-warning">
														<text class="hidden-conteudo">Revisar</text> 
														<span class="glyphicon glyphicon-pencil"></span>
													</a>
													<a href="<?php echo site_url('administrador/notificacao/recusar/').'/'.$conteudo->codigo; ?>" class="btn btn-danger">
														<text class="hidden-conteudo">Recusar</text> 
														<span class="glyphicon glyphicon-trash"></span>
													</a>
												</td>
											</tr>

										<?php	} ?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tabela-notificacao-usuario">
									<table class="table">
										<thead>
											<tr>
												<th>Foto</th>
												<th>Nome</th>
												<th>Email</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody class="panel">
											<?php   foreach ($usuarios as $usuario) { ?>
													
											<tr>
												<td><img id="img-usuario" class="img-thumbnail" src="<?php echo $usuario->foto; ?>"/></td>
												<td><?php echo $usuario->nome; ?></td>
												<td><?php echo $usuario->email; ?></td>
												<td>
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
													<a href="<?php echo site_url('administrador/notificacao/aceitar/').'/'.$usuario->codigo; ?>" class="btn btn-primary">
														<text class="hidden-conteudo">Aprovar</text> 
														<span class="glyphicon glyphicon-ok"></span>
													</a>
													<a href="<?php echo site_url('administrador/notificacao/bloquear/').'/'.$usuario->codigo; ?>" class="btn btn-danger">
														<text class="hidden-conteudo">Recusar</text> 
														<span class="glyphicon glyphicon-trash"></span>
													</a>
												</td>
											</tr>

										<?php	} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</section>