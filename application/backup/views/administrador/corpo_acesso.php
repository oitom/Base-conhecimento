		<div id="main" class="col-md-10">
			<div>
				<h2> Acessos <a id="botao-adicionar" class="btn" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-plus"></span>Adicionar</a> </h2>
				<?php if(isset($sucesso)) { ?>
					<div id="msg-sucesso" class="col-md-12">
						<div class="alert alert-success alert-dismissible" role="alert">
					    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					      	<p><?php echo $sucesso ?></p>
					    </div>
				    </div>
				<?php } ?>

				<!-- Aqui entra o formulário de inserção -->


				<?php if(validation_errors() == "") { ?>
		       		<div id="formulario" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <?php }else{ ?>
		        	<div id="formulario" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		        <?php } ?>
						<hr>
		           		<h3>Adicionar Acesso</h3>
		        		<div class="col-md-12">
							<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/acessos/cadastrar/') ?>">
								<div class="form-group">
									<label for="acesso-usuario" class="control-label col-md-2">Usuario</label>
									<div class="col-md-6">
										<select class="form-control" name="acesso-usuario" id="acesso-usuario">
											<option value="0">Selecione...</option>
											<?php foreach ($usuarios as $usuario) { ?>
												<option value="<?php echo $usuario->codigo; ?>" <?php if($funcao != "editar" && $usuario->codigo == set_value('acesso-usuario')) echo "selected" ?> ><?php echo $usuario->nome; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="acesso-base" class="control-label col-md-2">Base</label>
									<div class="col-md-6">
										<select class="form-control" name="acesso-base" id="acesso-base">
											<option value="0">Selecione...</option>
											<?php foreach ($bases as $base) { ?>
												<option value="<?php echo $base->codigo; ?>" <?php if($funcao != "editar" && $base->codigo == set_value('acesso-base')) echo "selected" ?> ><?php echo $base->nome; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="acesso-grupo" class="control-label col-md-2">Grupo</label>
									<div class="col-md-6">
										<select class="form-control" name="acesso-grupo" id="acesso-grupo">
											<option value="0">Selecione...</option>
											<?php foreach ($grupos as $grupo) { ?>
												<option value="<?php echo $grupo->codigo; ?>" <?php if($funcao != "editar" && $grupo->codigo == set_value('acesso-grupo')) echo "selected" ?> ><?php echo $grupo->nome; ?></option>
											<?php } ?>
										</select>
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



				<?php 
					$limite = 12; // número de acessos por página
					$n_paginas = ceil(count($acessos) / $limite); //arredonda para cima
				?>
				<input type="hidden" id="limite" value="<?php echo $limite ?>">
				<input type="hidden" id="npaginas" value="<?php echo $n_paginas ?>">
				
				<table id="tabela-acesso" class="table">
					<thead>
						<tr>
							<th></th>
							<th>Usuario</th>
							<th>Base</th>
							<th>Grupo</th>
							<th>Data</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody class="panel">
					<?php $i = 1; ?>
					<?php foreach ($acessos as $acesso) { 
						if($i <= $limite) {?>
							<tr>
								<td><input type="checkbox"></td>
								<td><?php echo $acesso->usuario->nome; ?></td>
								<td><?php echo $acesso->base->nome; ?></td>
								<td><?php echo $acesso->grupo->nome; ?></td>
								<td><?php echo date("d/m/Y", strtotime($acesso->data_hora)); ?></td>
								<td class="text-center">
									<button class="btn btn-primary">
										Visualizar 
										<span class="fa fa-binoculars"></span>
									</button>
									<a href="#editar-<?php echo $acesso->codigo; ?>" class="btn btn-warning" data-toggle="collapse" data-parent="#tabela-acesso" aria-expanded="true" aria-controls="editar-<?php echo $acesso->codigo; ?>">
										Editar
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
									<a href="<?php echo site_url('administrador/acessos/excluir/').'/'.$acesso->codigo; ?>" class="btn btn-danger">
										Excluir 
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>
							
							<tr class="panel-collapse collapse" id="editar-<?php echo $acesso->codigo; ?>">
								<td colspan="6">
									<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/acessos/editar/').'/'.$acesso->codigo; ?>">
										<div class="form-group">
											<label for="acesso-usuario" class="control-label col-md-2">Usuário</label>
											<div class="col-md-6">
												<select class="form-control" name="acesso-usuario" id="acesso-usuario">
													<option value="0">Selecione...</option>
													<?php foreach ($usuarios as $usuario) { ?>
														<option value="<?php echo $usuario->codigo; ?>" <?php if($acesso->codigo_usuario == $usuario->codigo) echo "selected" ?> ><?php echo $usuario->nome; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="acesso-base" class="control-label col-md-2">Base</label>
											<div class="col-md-6">
												<select class="form-control" name="acesso-base" id="acesso-base">
													<option value="0">Selecione...</option>
													<?php foreach ($bases as $base) { ?>
														<option value="<?php echo $base->codigo; ?>" <?php if($acesso->codigo_base == $base->codigo) echo "selected" ?> ><?php echo $base->nome; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="acesso-grupo" class="control-label col-md-2">Grupo</label>
											<div class="col-md-6">
												<select class="form-control" name="acesso-grupo" id="acesso-grupo">
													<option value="0">Selecione...</option>
													<?php foreach ($grupos as $grupo) { ?>
														<option value="<?php echo $grupo->codigo; ?>" <?php if($acesso->codigo_grupo == $grupo->codigo) echo "selected" ?> ><?php echo $grupo->nome; ?></option>
													<?php } ?>
												</select>
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

						<?php $i++; 
							} 
						} ?>
					</tbody>
				</table>
				
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