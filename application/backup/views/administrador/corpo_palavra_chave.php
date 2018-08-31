				<div id="main" class="col-md-10">
					<div>
						
						<h2> Palavra-Chave <a id="botao-adicionar" class="btn" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-plus"></span>Adicionar</a></h2>
						<?php if(isset($sucesso)) { ?>
							<div id="msg-sucesso" class="col-md-12">
								<div class="alert alert-success alert-dismissible" role="alert">
							    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							      	<p><?php echo $sucesso ?></p>
							    </div>
						    </div>
						<?php } ?>

						<hr>

				        <div id="formulario" class="collapse">
				           	<h2>Adicionar Palavra-Chave</h2>
				          	<div class="col-md-12">
					          	<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/palavrasChave/cadastrar/').'/null' ?>">

									<div class="form-group">
					          			<label for="palavra-chave-titulo" class="col-md-2 control-label">Titulo:</label>
					          			<div class="col-md-6">
					          				<input type="text" name="palavra-chave-titulo" id="palavra-chave-titulo" class="form-control">
					          			</div>
					          		</div>

					          		<footer class="col-md-10">
					          			<center>
						          			<a class="btn btn-default" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
						          			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salvar</button>
					          			</center>
					          		</footer>
					          	</form>
				          	</div>
				        </div>

						<div class="table-portable">
							<table class="table" id="tabela-palavra-chave">
								<thead>
									<tr>
										<th></th>
										<th>Título</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody class="panel">
									<?php foreach ($palavras_chave as $palavra_chave) { ?>
									<tr>
										<td><input type="checkbox"></td>
										<td><?php echo $palavra_chave->titulo; ?></td>
										<td class="text-center">
											<button class="btn btn-primary">
												Visualizar 
												<span class="fa fa-binoculars"></span>
											</button>
											<a href="#editar-<?php echo $palavra_chave->codigo; ?>" class="btn btn-warning" data-toggle="collapse" data-parent="#tabela-palavra-chave" aria-expanded="true" aria-controls="editar-<?php echo $palavra_chave->codigo; ?>">
												Editar
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
											<a href="<?php echo site_url('administrador/palavrasChave/excluir/').'/'.$palavra_chave->codigo; ?>" class="btn btn-danger">
												Excluir 
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</td>
									</tr>
									<tr class="panel-collapse collapse" id="editar-<?php echo $palavra_chave->codigo; ?>">
										<td colspan="3">
											<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/palavrasChave/editar/').'/'.$palavra_chave->codigo; ?>">

												<div class="form-group">
								          			<label for="palavra-chave-titulo" class="col-md-1 control-label">Titulo:</label>
								          			<div class="col-md-6">
								          				<input type="text" name="palavra-chave-titulo" id="palavra-chave-titulo" class="form-control" value="<?php echo $palavra_chave->titulo ?>">
								          			</div>
								          			<div class="col-md-5 text-left">
									          			<a class="btn btn-default" data-toggle="collapse" href="#formulario" ><span class="glyphicon glyphicon-floppy-remove"></span> Cancelar</a>
									          			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salvar</button>
									          		</div>
								          		</div>
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