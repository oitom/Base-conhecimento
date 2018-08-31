<style type="text/css">
	
	body{
		background-color: #1a7fa4;
		background-image: url("../../img/banner.jpg");
		background-size: 100%;
		background-repeat: no-repeat;
	}

	#formulario-membro h1,#formulario-membro label{
		color: white;
	}

	#formulario-membro{
		margin-top: 10px;
	}

	img.logo{
		margin-top: 5px;
	}

</style>

<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<img class="img-rounded logo" src="<?php echo IMG ?>/logo.jpg">
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
				<form class="form-horizontal">
					
					<div class="form-group">
						<label for="membro-email" class="col-sm-12">E-mail</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="membro-email">
						</div>
					</div>

					<div class="form-group">
						<label for="membro-senha" class="col-sm-12">Senha</label>
						<div class="col-sm-12">
							<input type="password" class="form-control" id="membro-senha">
						</div>
					</div>

					<div class="col-sm-12">
						<button class="btn btn-primary pull-right" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
					</div>
				</form>	
			</article>
		</div>

	</div>
</article>
