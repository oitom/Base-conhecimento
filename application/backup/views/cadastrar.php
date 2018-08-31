<style type="text/css">
	
	body{
		background-color: #1a7fa4;
		background-image: url("../../img/banner.jpg");
		background-size: 100%;
		background-repeat: no-repeat;
	}

	#formulario-membro h1, #formulario-membro label{
		color: white;
	}

	#formulario-membro label{
		text-align: right;
	}

	img.logo{
		margin-top: 5px;
	}
</style>

<header>
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-4">
				<img class="img-rounded logo" src="<?php echo IMG ?>/logo.jpg">
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
					<form class="form-horizontal">
					
						<div class="form-group">
							<label for="membro-nome" class="col-md-3" >Nome</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="membro-nome">
							</div>
						</div>

						<div class="form-group">
							<label for="membro-email" class="col-md-3" >E-mail</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="membro-email">
							</div>
						</div>

						<div class="form-group">
							<label for="membro-senha" class="col-md-3" >Senha</label>
							<div class="col-md-4">
								<input type="password" class="form-control" id="membro-senha">
							</div>
						</div>

						<?php foreach ($campos as $campo){ ?>
							<?php switch ($campo->tipo) {
									case 'texto': $tipo = "text";  break;
									case 'numerico': $tipo = "number";  break;
									default: $tipo = "number"; break;
							} ?>
							<div class="form-group">
								<label for="membro-<?php echo $campo->nome ?>" class="col-md-3" ><?php echo $campo->nome ?></label>
								<div class="col-md-6">
									<input type="<?php echo $tipo ?>" class="form-control" id="membro-<?php echo $campo->nome ?>">
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
