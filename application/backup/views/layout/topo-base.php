<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">	
	<title><?php echo $titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>estilo.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>font-awesome-4.2.0/css/font-awesome.min.css">
</head>
<body>
	<nav id="menu-superior">
		<div class="container">

			<div class="navbar-header">
				<div class="row">
					<div class="col-xs-6 hidden-md hidden-lg hidden-sm">
						<img src="<?php echo IMG; ?>logo.jpg">
					</div>
					<div class="col-xs-6">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-mobile">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
				</div>
			</div>

			<div id="logo-area" class="col-sm-3 navbar-left hidden-xs">
				<img src="<?php echo IMG; ?>logo.jpg">
			</div>
			<div class="col-sm-6">
				<div id="pesquisa-superior" class="input-group">
      				<input type="text" class="form-control" placeholder="Pesquisa...">
      				<span class="input-group-btn">
        				<button class="btn btn-default" type="button">Pesquisar</button>
		      		</span>
		    	</div>
			</div>
			<div class="col-sm-3 collapse navbar-collapse navbar-right" id="menu-mobile">
				<ul class="nav navbar-nav">
					<li> <a href="#">Contato</a></li>
					<li> <a href="#">Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<header id="cabecalho-base">
		<div class="container">
			<div class="row">
				<div class="col-sm-1 bases-grandes hidden-xs">
					<span class="fa fa-database"></span>
				</div>
				<div class="col-sm-11">
					<div class="row">
						<div class="col-sm-11">
							<h1>
								<button class="btn btn-default" type="button">Inscreva-se</button>
								<?php echo $titulo ?>
							</h1>
						</div>
						<div class="col-sm-1 icone-usuario hidden-xs">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-user"></span>
								</button>
								<ul id="menu-usuario"class="dropdown-menu dropdown-menu-right" role="menu">
									<li class="titulo-menu-usuario">Proprietário</li>
									<li class="divider"></li>
									<li>
										<span class="glyphicon glyphicon-user"></span>
										<label>João da Silva</label>
									</li>
								</ul>
							</div>
						</div>
						<div id="proprietario-xs"class="col-xs-12 icone-usuario hidden-sm hidden-md hidden-lg">
							<strong>Proprietário: </strong><label>João da Silva</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="caminho-diretorio">
								<?php echo $caminho; ?>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="descricao-base">
							<?php echo $base->descricao; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
