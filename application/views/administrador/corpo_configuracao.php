		<div id="main" class="col-sm-10">
			<div>
				<?php if(isset($sucesso)) { ?>
					<div id="msg-sucesso" class="col-md-12">
						<div class="alert alert-success alert-dismissible" role="alert">
					    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					      	<p><?php echo $sucesso; ?></p>
					    </div>
				    </div>
				<?php } ?>


	       		<div id="formulario" class="col-md-12" role="tabpanel" aria-labelledby="headingOne">
	           		<h1>Configuração</h1>
					<hr>
					<h2>Configuração da Plataforma</h2>
	        		<div class="row">
						
						<form class="form-horizontal" method="post" action="<?php echo site_url('administrador/configuracao') ?>">
							<div class="form-group">
								<label for="plataforma-nome" class="control-label col-md-2">Nome</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="plataforma-nome" name="plataforma-nome" value="<?php echo $plataforma->nome; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="plataforma-descricao" class="control-label col-md-2">Descrição</label>
								<div class="col-md-6">
									<textarea class="form-control" id="plataforma-descricao" name="plataforma-descricao"><?php echo $plataforma->descricao; ?></textarea>
								</div>
							</div>

							<hr>
							<h3>Restrição dos Tipos de Conteúdos</h3>
							<div class="panel panel-default">
  								<div class="panel-body">
								<?php for($i = 1; $i <= 8; $i++) { ?>
  									<div class="col-md-3">
	  									<div class="input-group">
								    		<span class="input-group-addon">
								    			<input id="tipo-restrito-<?php echo $i; ?>" name="tipo-restrito-<?php echo $i; ?>" type="checkbox" value="<?php echo $tipo[$i]['codigo']; ?>" <?php if ($tipo[$i]["bloqueio"] == true) echo "checked"; ?>>
								    		</span>
								    		<label for="tipo-restrito-<?php echo $i; ?>" class="form-control"><?php echo $tipo[$i]['descricao']; ?></label>
							    		</div>
							    	</div>
								<?php } ?>
								</div>
							</div>

							<hr>
							<h3>Restrição das extensões de arquivos</h3>
							<div class="panel panel-default">
  								<div class="panel-body" id="restricao-ext">
								<?php for($i = 0; $i < count($ext); $i++) { ?>
  									<div class="col-md-3">
	  									<div class="input-group" id="itens-restricao">
								    		<span class="input-group-addon">
								    			<input id="ext-restrito-<?php echo $i; ?>" name="ext-restrito[]" type="checkbox" checked value="<?php echo $ext[$i]; ?>">
								    		</span>
								    		<label for="ext-restrito-<?php echo $i; ?>" class="form-control"><?php echo $ext[$i]; ?></label>
							    		</div>
							    	</div>
								<?php } ?>
								</div>
								<div class="form-group">
									<label for="plataforma-nome" class="control-label col-md-3">Entre com uma extensão a ser bloqueada:</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bloqueia-ext" name="bloqueia-ext">
									</div>
									<div class="col-md-3">
										<button class="btn btn-primary" type="button" id="confirma-ext" name="confirma-ext">Adicionar</button>
									</div>
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
			</div>
		</div>
	</div>
</section>