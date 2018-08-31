<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://localhost/base_conhecimento/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="http://localhost/base_conhecimento/css/estilo.css">
		<title>Perfil</title>
		<style>
			#corpo-perfil
			{
				background-color: white;
			}
			#img-perfil
			{
				width: 100%;
				height: auto;
			}
			#tabela-favoritos
			{
				width: auto;
				border: 1px solid gray;
			}
			#tabela-favoritos tr
			{
				border: 1px solid gray;
			}
			#tabela-favoritos tr th
			{
				background-color: silver;
				border: 1px solid gray;
				text-align: center;
			}
			#tabela-favoritos tr td
			{
				border: 1px solid gray;
				text-align: center;
				vertical-align: middle;
			}
		</style>
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
					<ul class="nav navbar-nav" id="menu-membro">
						<!--<li> <a href="#">Contato</a></li>
						<li> <a href="#">Login</a></li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-star"></span> Favoritos <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">

								<li><a href="#"><span class=""></span> Título</a></li>
								<li class="divider"></li> 
								<li><a href="#">Ver todos</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img class="img-thumbnail" width="51" src="<?php echo $usuario->foto; ?>"/>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Perfil</a></li>
								<li><a href="#">Sair</a></li>
							</ul>
						</li>
						
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
									Base - Otimização Matemática
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
											<label>Felipe</label>
										</li>
									</ul>
								</div>
							</div>
							<div id="proprietario-xs"class="col-xs-12 icone-usuario hidden-sm hidden-md hidden-lg">
								<strong>Proprietário: </strong><label>Felipe</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<p class="caminho-diretorio">
									<p class="caminho-diretorio">
								<a href="http://localhost/base_conhecimento/index.php/plataforma/index/1"> <strong>IFSPCJO</strong></a>
								> Otimização Matemática
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<p class="descricao-base">
									Lorem ipsum dolor sit amet, consectetur nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<section id="corpo-perfil">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2>Perfil</h2>
					</div>
					<div class="col-sm-2">
						<img class="img-thumbnail" id="img-perfil" src="<?php echo $usuario->foto; ?>"/>
					</div>
					<div class="col-sm-10">
						<form>
							<div class="form-group">
								<label>Nome:</label>
								<input type="text" class="form-control" value="<?php echo $usuario->nome; ?>">
							</div>
							<div class="form-group">
								<label>Descrição:</label>
								<textarea class="form-control"><?php echo $usuario->descricao; ?></textarea>
							</div>
						</form>
						<form class="row">
							<div class="col-sm-6 form-group" id="teste">
								<label>Telefone:</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-sm-6 form-group" id="teste">
								<label>Celular:</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-sm-12">
							<button type="submit" class="btn btn-primary pull-right">
								<span class="glyphicon glyphicon-send"></span>
								Enviar
							</button>
							</div>
						</form>
						<h2>Favoritos</h2>
						<table class="table" id="tabela-favoritos">
							<tr>
								<th></th>
								<th>Descrição</th>
								<th>Tipo</th>
								<th>Ações</th>
							</tr>
						 	<tr>
						 		<td><input type="checkbox"></td>
						 		<td>Metodologia Ágil</td>
						 		<td>Artigo</td>
						 		<td>
									<button title="Excluir" class="btn btn-danger">
										<span class="glyphicon glyphicon-remove"></span>	
										<text class="hidden-xs hidden-sm">Remover</text>
									</button>
								</td>
						 	</tr>
						 	<tr>
						 		<td><input type="checkbox"></td>
						 		<td>Metodologia Ágil</td>
						 		<td>Vídeo</td>
						 		<td>
									<button title="Excluir" class="btn btn-danger">
										<span class="glyphicon glyphicon-remove"></span>	
										<text class="hidden-xs hidden-sm">Remover</text>
									</button>
								</td>
						 	</tr>
						 	<tr>
						 		<td><input type="checkbox"></td>
						 		<td>Engenharia de Software</td>
						 		<td>Base</td>
						 		<td>
									<button title="Excluir" class="btn btn-danger">
										<span class="glyphicon glyphicon-remove"></span>	
										<text class="hidden-xs hidden-sm">Remover</text>
									</button>
								</td>
						 	</tr>
						</table>
					</div>
				</div>
			</div>
		</section>