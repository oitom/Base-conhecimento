<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">	
	<title>Plataforma - <?php echo $plataforma->nome; ?></title>
	<?php 
		$keywords="";
		for ($i=0; $i < count($plataforma->palavraschave); $i++) 
			$keywords.= $plataforma->palavraschave[$i]->titulo.", ";
		
	?>

	<meta name="keywords" content="<?php echo $keywords ?>">
	<meta name="description" content="<?php echo $plataforma->descricao ?>">
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
						<img src="<?php echo IMG."logo.jpg"; ?>">
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

			<div class="navbar-left hidden-xs">	
				<a href="<?php echo site_url(); ?>">
					<img src="<?php echo IMG."logo.jpg"; ?>">
				</a>
			</div>

			<div class="collapse navbar-collapse navbar-right" id="menu-mobile">
				<ul class="nav navbar-nav">
					<li> <a href="#">Como funciona</a></li>
					<li> <a href="#">Quero participar</a></li>
					<li> <a href="#">Contato</a></li>
					<li> <a href="#">Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<header id="cabecalho">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<h1>Plataforma <strong><?php echo $plataforma->nome; ?></strong></h1>
					<p><?php echo $plataforma->descricao; ?></p>
				</div>

				<form  method="post" action="<?php echo site_url('pesquisa_global/index/'); ?>">
				    <div class="row">
				      	<div class="col-md-12">
				        	<div class="input-group">
				          		<input name="pesquisa-global" id="pesquisa-global" type="text" class="form-control"  placeholder="Pesquisar...">
				          		<span class="input-group-btn">
				            		<button class="btn btn-default" type="submit">Pesquisar</button>
				          		</span>
				        	</div>
				      	</div>
				    </div>
				</form>


			</div>
		</div>
	</header>