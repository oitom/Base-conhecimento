<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">	
		<title>Administrador</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>font-awesome-4.2.0/css/font-awesome.min.css">
		<style>
			body
			{
				background-color: #32a3cb;
			}
			section
			{
				background-color: #32a3cb;
			}
			h2
			{
				-webkit-margin-before: 0px;
				-webkit-margin-after: 0px;
				padding-bottom: 20px;
			}
			a.perfil-mobile
			{
				color: white;
			}
			a.perfil-mobile:hover
			{
				background-color: white;
				color: #1a7fa4;
			}
			a.menu-mobile
			{
				text-align: left;
				color: white !important;
			}
			a.menu-mobile:hover
			{
				color: #1a7fa4 !important;
				background-color: white !important;
			}
			th
			{
				background-color: #1a7fa4;
				color: white;
			}
			#botao-menu, #botao-menu:focus
			{
				background-color: #1a7fa4;
				color: white;
				border-color: white;
			}
			#texto-notificacao
			{
				color: white;
			}
			#texto-notificacao:hover
			{
				background-color: white;
				color: #1a7fa4;
			}
			#notificacao
			{
				border: 1px solid white;
				border-radius: 20px;
				background-color: red;
				color: white;
			}
			#user-area
			{
				color: white;
				padding-top: 10px;
				margin-left: 50px;
			}
			#user-area img
			{
				padding: 1px;
				width: 35px;
				height: auto;
			}
			#menu-lateral
			{
				padding: 10px;
				position: relative;
				border: none;
			}
			#menu-lateral ul
			{
				background-color: white;
				padding: 10px;
				width: 15%;
			}
			#menu-lateral a:hover div div 
			{
				background-color: #1a7fa4;
				color: white;
			}
			#botao-adicionar
			{
				background-color: #009900;
				border-color: #006600;
				color: white;
			}
			#botao-adicionar:hover
			{
				background-color: #006600;
				border-color: #003300;
			}
			#main
			{
				padding-top: 10px;
				padding-right: 10px;
				padding-bottom: 10px;
			}
			#main div
			{
				background-color: white;
				padding: 10px;
			}
			#tabela-conteudo tr td, tr th
			{
				text-align: center;
				vertical-align: middle;
			}
			#navbar-desing
			{
				background-color: #1a7fa4;
				border: none;
				padding: 10px;
				border-radius: 0;
			}
			#menu
			{
				padding: 0px;
			}
			#img-usuario
			{
				width: 50px;
				height: auto;
			}
			#menu-mobile
			{
				border-color: white;
			}
			#menu-pesquisa
			{
				margin: 0;
			}
			#input-pesquisa
			{
				padding: 0 !important;
			}
			@media (min-width: 768px)
			{
				#main
				{
					padding-left: 0px;
				}
				#navbar-desing
				{
					top: 0;
					position: fixed;
					right: 0;
					left: 0;
					z-index: 1030;
					-webkit-transform: translate3d(0, 0, 0);
					-o-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
				}
				section
				{
					margin-top: 70px;
				}
			}
			@media (max-width: 767px)
			{
				#main
				{
					padding-left: 10px;
				}
				section
				{
					margin-top: -20px;
				}
				#menu-horizontal
				{
					display: none;
				}
				.conteudos
				{
					margin: 0;
				}
			}
			@media (max-width: 1168px)
			{
				.hidden-conteudo
				{
					display: none !important;
				}
			}
			@media (min-width: 768px) and (max-width: 991px)
			{
				.hidden-menu-lateral
				{
					display: none !important;
				}
				.conteudos
				{
					padding-left: 10px !important;
					width: 100%;
					margin-top: 40px;
				}
				#menu-horizontal
				{
					background-color: white;
					position: fixed;
				}
			}
			@media (min-width: 992px)
			{
				#menu-horizontal
				{
					display: none;
				}
			}
			@media (min-width: 768px) and (max-width: 804px)
			{
				#menu-horizontal
				{
					font-size: 12px;
				}
				.conteudos
				{
					margin-top: 37px !important;
				}
			}
		</style>
	</head>
	<body>
		<header>
			<nav id="navbar-desing" class="navbar navbar-inverse" role="navigation">
		      	<div class="container-fluid">
		      		<a id="menu" class="navbar-brand" href="#"><img src="<?php echo IMG; ?>logo.jpg"></a>

		        	<div class="navbar-header">
		          		<button type="button" class="navbar-toggle collapsed" id="botao-menu" data-toggle="collapse" data-target="#menu-mobile">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
		          		</button>
		        	</div>

			        <div class="collapse navbar-collapse navbar-right" id="menu-mobile">
			        	<a class="navbar-brand hidden-xs" id="texto-notificacao" href="#">
		          			<span class="fa fa-bell"></span>
		          			Notificações
		          			<span class="badge" id="notificacao">11</span>	
		          		</a>
		          		<a class="navbar-brand menu-mobile hidden-sm hidden-md hidden-lg" href="#">
		          			<span class="glyphicon glyphicon-user"></span>
		          			Perfil
		          		</a>
						<a class="navbar-brand menu-mobile hidden-sm hidden-md hidden-lg" href="#">
							<span class="glyphicon glyphicon-off"></span>
							Sair
						</a>
		          		<div class="pull-right hidden-xs" id="user-area">
							Olá, Felipe
				            <a href="#" id="usuario" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				            	<img class="img-thumbnail" src="<?php echo IMG; ?>felipe.png"/>
				            </a>
				            <ul class="dropdown-menu" role="menu">
				                <li><a href="#">Perfil</a></li>
				                <li><a href="#">Sair</a></li>
							</ul>
						</div>
						<div class="hidden-sm hidden-md hidden-lg pull-right" id="user-area">
				            <img class="img-thumbnail" src="<?php echo IMG; ?>felipe.png"/>
						</div>
						<div class="row hidden-sm hidden-md hidden-lg">
							<div class="col-xs-12">
								<a class="navbar-brand" id="texto-notificacao" href="#">
				          			<span class="fa fa-bell"></span>
				          			Notificações
				          			<span class="badge" id="notificacao">11</span>	
				          		</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/bases'); ?>">Bases</a>
							</div>
				          	<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/conteudos'); ?>">Conteúdos</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/usuarios'); ?>">Usuários</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/grupos'); ?>">Grupos</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/histórico'); ?>">Histórico</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/palavrasChave'); ?>">Palaras-chave</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/aparencia'); ?>">Aparência</a>
							</div>
							<div class="col-xs-12">
								<a class="navbar-brand menu-mobile" href="<?php echo site_url('administrador/configuracao'); ?>">Configuração</a>
							</div>
				        </div>
					</div>
		      	</div>
		    </nav>
		</header>