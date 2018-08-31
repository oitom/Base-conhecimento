<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">	
		<title>Administrador</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>font-awesome-4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>adm.css">
		<script src="<?php echo base_url('js/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
		<script type="text/javascript">
		tinymce.init({
		    selector: "#editor",
		    plugins: [
		        "advlist autolink lists link image charmap print preview anchor"
		    ],
		    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});
		</script>
	</head>
	<body>
		<header>
			<nav id="navbar-desing" class="navbar navbar-inverse" role="navigation">
		      	<div class="container-fluid">
		      		<a id="menu" class="navbar-brand" href="#"><img src="<?php echo IMG."logo.jpg" ?>"></a>

		        	<div class="navbar-header">
		          		<button type="button" class="navbar-toggle collapsed" id="botao-menu" data-toggle="collapse" data-target="#menu-mobile">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
		          		</button>
		        	</div>

			        <div class="collapse navbar-collapse navbar-right" id="menu-mobile">
			        	<?php if ($notificacoes > 0) { ?>
			        	<a class="navbar-brand hidden-xs" id="texto-notificacao" href="<?php echo site_url('administrador/notificacao') ?>">
		          			<span class="fa fa-bell"></span>
		          			Notificações
		          			<span class="badge" id="notificacao"><?php echo $notificacoes['conteudos'] + $notificacoes['usuarios']; ?></span>	
		          		</a>
			        	<?php } ?>
		          		<a class="navbar-brand menu-mobile hidden-sm hidden-md hidden-lg" href="#">
		          			<span class="glyphicon glyphicon-user"></span>
		          			Perfil
		          		</a>
						<a class="navbar-brand menu-mobile hidden-sm hidden-md hidden-lg" href="<?php echo site_url('plataforma/sair') ?>">
							<span class="glyphicon glyphicon-off"></span>
							Sair
						</a>
		          		<div class="pull-right hidden-xs" id="user-area">
							Olá, <?php echo $usuario->nome; ?>
				            <a href="#" id="usuario" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				            	<img class="img-thumbnail" src="<?php echo $usuario->foto; ?>"/>
				            </a>
				            <ul class="dropdown-menu" role="menu">
				                <li><a href="<?php echo site_url('usuario/perfil') ?>">Perfil</a></li>
								<li><a href="<?php echo site_url('plataforma/sair') ?>">Sair</a></li>
							</ul>
						</div>
						<div class="hidden-sm hidden-md hidden-lg pull-right" id="user-area">
				            <img class="img-thumbnail" src="<?php echo $usuario->foto; ?>"/>
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
