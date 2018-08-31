		<div id="main" class="col-md-10">
			<div>
				<h2> Usuários <a id="botao-adicionar" class="btn" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-plus"></span> Adicionar </a></h2>

				<?php if(isset($sucesso)) { ?>
					<div id="msg-sucesso" class="col-md-12">
						<div class="alert alert-success alert-dismissible" role="alert">
					    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					      	<p><?php echo $sucesso ?></p>
					    </div>
				    </div>
				<?php } ?>

				<?php if(validation_errors() == "") { ?>
		       		<div id="formulario" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <?php }else{ ?>
		        	<div id="formulario" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		        <?php } ?>
		        		<hr>
		           		<h3>Adicionar Usuário</h3>
		        		<div class="col-md-12">
							<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/usuarios/cadastrar/') ?>">
								<div class="form-group">
									<label for="usuario-nome" class="control-label col-md-2">Nome</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="usuario-nome" name="usuario-nome" value="<?php echo $funcao != "editar" ? set_value('usuario-nome') : ""; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="usuario-email" class="control-label col-md-2">E-mail</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="usuario-email" name="usuario-email" value="<?php echo $funcao != "editar" ? set_value('usuario-email') : ""; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="usuario-senha" class="control-label col-md-2">Senha</label>
									<div class="col-md-6">
										<input type="password" class="form-control" id="usuario-senha" name="usuario-senha" value="">
									</div>
								</div>
								<div class="form-group">
									<label for="usuario-descricao" class="control-label col-md-2">Descrição</label>
									<div class="col-md-6">
										<textarea class="form-control" id="usuario-descricao" name="usuario-descricao"><?php echo $funcao != "editar" ? set_value('usuario-descricao') : ""; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="usuario-foto" class="control-label col-md-2">Foto</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="usuario-foto" name="usuario-foto" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-8">
										<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
									</div>
								</div>
								<?php if(validation_errors() != "") { ?>
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

				<div class="table-responsive">
					<table id="tabela-usuario" class="table">
						<thead>
							<tr>
								<th></th>
								<th>Foto</th>
								<th>Nome</th>
								<th>E-mail</th>
								<th>Ações</th>
							</tr>
						</thead>
						<tbody class="panel">
							<?php foreach ($usuarios as $usuario) { ?>
							<tr>
								<td><input type="checkbox"></td>
								<td><img id="img-usuario" class="img-thumbnail" src="<?php echo $usuario->foto; ?>"/></td>
								<td><?php echo $usuario->nome; ?></td>
								<td><?php echo $usuario->email; ?></td>
								<td class="text-center">
									<button class="btn btn-primary">
										Visualizar 
										<span class="fa fa-binoculars"></span>
									</button>
									<a href="#editar-<?php echo $usuario->codigo; ?>" class="btn btn-warning" data-toggle="collapse" data-parent="#tabela-usuario" aria-expanded="true" aria-controls="editar-<?php echo $usuario->codigo; ?>">
										Editar
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
									<a href="<?php echo site_url('administrador/usuarios/excluir/').'/'.$usuario->codigo; ?>" class="btn btn-danger">
										Excluir 
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>
							<tr class="panel-collapse collapse" id="editar-<?php echo $usuario->codigo; ?>">
								<td colspan="5">
									<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/usuarios/editar/').'/'.$usuario->codigo; ?>">
										<div class="form-group">
											<label for="usuario-nome" class="control-label col-md-2">Nome</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="usuario-nome" name="usuario-nome" value="<?php echo $usuario->nome; ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="usuario-email" class="control-label col-md-2">E-mail</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="usuario-email" name="usuario-email" value="<?php echo $usuario->email ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="usuario-senha" class="control-label col-md-2">Senha</label>
											<div class="col-md-6">
												<input type="password" class="form-control" id="usuario-senha" name="usuario-senha" value="">
											</div>
										</div>
										<div class="form-group">
											<label for="usuario-descricao" class="control-label col-md-2">Descrição</label>
											<div class="col-md-6">
												<textarea class="form-control" id="usuario-descricao" name="usuario-descricao"><?php echo $usuario->descricao ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="usuario-foto" class="control-label col-md-2">Foto</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="usuario-foto" name="usuario-foto" value="<?php echo $usuario->foto ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-8">
												<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
											</div>
										</div>
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


							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>