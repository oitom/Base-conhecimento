<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
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
			
			<header class="col-sm-4 col-sm-offset-4">
				<h1>Login</h1>
			</header>

			<article class="col-sm-4 col-sm-offset-4">
				<form class="form-horizontal" action="<?php echo site_url('plataforma/login') ?>" method="post" >
					
					<div class="form-group">
						<label for="membro-email" class="col-sm-12">E-mail</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="membro-email" id="membro-email" value="<?php echo set_value('membro-email'); ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="membro-senha" class="col-sm-12">Senha</label>
						<div class="col-sm-12">
							<input type="password" class="form-control" name="membro-senha" id="membro-senha">
						</div>
					</div>
					<div class="col-sm-12">
						<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-log-in"></span></button>
					</div>
				</form>	
					<div class="col-sm-12">
					<?php if(validation_errors() != "") { ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
					      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					      <?php echo validation_errors(); ?>
					    </div>
					<?php } ?>
					</div>
			</article>
		</div>

	</div>
</article>
