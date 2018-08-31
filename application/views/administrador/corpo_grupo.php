		<div id="main" class="col-md-10">
			<div>
				<h2> Grupos <a id="botao-adicionar" class="btn" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-plus"></span> Adicionar </a></h2>

				<?php if(isset($sucesso)) { ?>
					<div id="msg-sucesso" class="col-md-12">
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
		           		<h3>Adicionar Grupo</h3>
		        		<div class="col-md-12">
							<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/grupos/cadastrar/') ?>">
								<div class="form-group">
									<label for="grupo-nome" class="control-label col-md-2">Nome</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="grupo-nome" name="grupo-nome" value="<?php echo $funcao != "editar" ? set_value('grupo-nome') : ""; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="grupo-descricao" class="control-label col-md-2">Descrição</label>
									<div class="col-md-6">
										<textarea class="form-control" id="grupo-descricao" name="grupo-descricao"><?php echo $funcao != "editar" ? set_value('grupo-descricao') : ""; ?></textarea>
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

				<table id="tabela" class="table">
					<thead>
					<tr>
						<th></th>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Ações</th>
					</tr>
					</thead>
					<tbody class="panel">
						<?php foreach ($grupos as $grupo) {?>
							<tr>
								<td><input type="checkbox"></td>
								<td class="text-center"><?php echo $grupo->nome; ?></td>
								<td class="text-center"><?php echo $grupo->descricao; ?></td>
								<td class="text-center">
									<button class="btn btn-primary">
										Visualizar 
										<span class="fa fa-binoculars"></span>
									</button>
									<a href="#editar-<?php echo $grupo->codigo; ?>" class="btn btn-warning" data-toggle="collapse" data-parent="#tabela-grupo" aria-expanded="true" aria-controls="editar-<?php echo $grupo->codigo; ?>">
										Editar
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
									<a href="<?php echo site_url('administrador/grupos/excluir/').'/'.$grupo->codigo; ?>" class="btn btn-danger">
										Excluir 
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>
							<?php if(validation_errors() == "" || $funcao != "editar" || $codigo != $grupo->codigo) { ?>
		       					<tr class="panel-collapse collapse" id="editar-<?php echo $grupo->codigo; ?>">
		        			<?php }else if($funcao == "editar"){ ?>
								<tr class="panel-collapse collapse in" id="editar-<?php echo $grupo->codigo; ?>">
							<?php } ?>
								<td colspan="4">
									<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/grupos/editar/').'/'.$grupo->codigo; ?>">
										<div class="form-group">
											<label for="grupo-nome" class="control-label col-md-2">Nome</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="grupo-nome" name="grupo-nome" value="<?php echo $grupo->nome; ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="grupo-descricao" class="control-label col-md-2">Descrição</label>
											<div class="col-md-6">
												<textarea class="form-control" id="grupo-descricao" name="grupo-descricao"><?php echo $grupo->descricao; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-8">
												<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
											</div>
										</div>
										<?php if(validation_errors() != "" && $codigo == $grupo->codigo) { ?>
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
</section>