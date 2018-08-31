
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-4">
				<a href="<?php echo site_url(); ?>">
					<img class="img-rounded logo" src="<?php echo IMG ?>/logo.jpg">
				</a>
			</div>
		</div>
	</div>
</header>

<article id="formulario-membro">
	
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-offset-2">
				<div class="col-md-9 col-md-offset-3">
					<h1>Cadastrar-se</h1>
				</div>
				<div class="col-md-12">
					<form class="form-horizontal" method="post" action="<?php echo site_url('plataforma/cadastrar'); ?>">
					
						<div class="form-group">
							<label for="membro-nome" class="control-label col-md-3" >Nome</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="membro-nome" name="membro-nome" value="<?php echo set_value('membro-nome'); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="membro-email" class="control-label col-md-3" >E-mail</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="membro-email" name="membro-email" value="<?php echo set_value('membro-email'); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="membro-senha" class="control-label col-md-3" >Senha</label>
							<div class="col-md-4">
								<input type="password" class="form-control" id="membro-senha" name="membro-senha" value="<?php echo set_value('membro-senha'); ?>">
							</div>
						</div>

						<?php foreach ($campos as $campo){ ?>
							<?php switch ($campo->tipo) {
									case 'texto': $tipo = "text";  break;
									case 'numerico': $tipo = "number";  break;
									default: $tipo = "number"; break;
							} ?>
							<div class="form-group">
								<label for="membro-<?php echo $campo->nome ?>" class="control-label col-md-3" ><?php echo $campo->nome ?></label>
								<div class="col-md-6">
									<input type="<?php echo $tipo ?>" class="form-control" id="membro-<?php echo $campo->nome ?>" name="membro-<?php echo $campo->nome ?>" value="<?php echo set_value('membro-'.$campo->nome.''); ?>">
								</div>
							</div>
						<?php } ?>
						
						<?php if(validation_errors() != "") { ?>
							<div class="col-md-6 col-md-offset-3">
								<div class="alert alert-danger alert-dismissible" role="alert">
							      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							      <?php echo validation_errors(); ?>
							    </div>
						    </div>
						<?php } ?>

						<div class="form-group">
							<div class="col-md-9">
								<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>

</article>
