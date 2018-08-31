<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">	
	<title>Conteúdo - <?php echo $conteudo->titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>estilo.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.2.0/css/font-awesome.min.css">
	
</head>
<body>
	<nav id="menu-superior">
		<div class="container">

			<div class="navbar-header">
				<div class="row">
					<div class="col-xs-6 hidden-md hidden-lg hidden-sm">
						<a href="<?php echo site_url(); ?>">
							<img src="<?php echo IMG; ?>logo.jpg">
						</a>
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
				<a href="<?php echo site_url(); ?>">
					<img src="<?php echo IMG; ?>logo.jpg">
				</a>
			</div>
			<div class="col-sm-6">
				<form method="post" action="<?php echo site_url('pesquisa_global/index/'); ?>">
					<div id="pesquisa-superior" class="input-group">
	      				<input type="text" name="pesquisa-global" class="form-control" placeholder="Pesquisa...">
	      				<span class="input-group-btn">
	        				<button class="btn btn-default" type="submit">Pesquisar</button>
			      		</span>
		      		
		    		</div>
		    	</form>
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
					<span class="fa fa-file-text-o"></span>
				</div>
				<div class="col-sm-11">
					<div class="row">
						<div class="col-sm-11">
							<a href="<?php echo site_url('base/index/' . $conteudo->base->codigo); ?>">Voltar para <?php echo $conteudo->base->nome; ?></a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h1><?php echo $conteudo->titulo; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div id="corpo-conteudo" class="container">