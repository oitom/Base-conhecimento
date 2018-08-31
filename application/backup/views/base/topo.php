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
							<?php 
							for ($i=0; $i < count($favoritos["bases"]); $i++) { 

								if($i< 7){ ?> 
									<li><a href="<?php echo site_url('base/index/'.$favoritos['bases'][$i]->codigo)?>"><span class="fa fa-database"></span> <?php echo $favoritos["bases"][$i]->nome; ?></a></li>
							<?php }
							} ?>
							<li class="divider"></li> 
							<?php 
							for ($i=0; $i < count($favoritos["conteudos"]); $i++) { 

							 
								switch ($favoritos["conteudos"][$i]->tipo) {
									
									case CTIPO_ARTIGO: $icone = "fa fa-file-text-o"; break; 
									case CTIPO_VIDEO: $icone = "glyphicon glyphicon-facetime-video"; break; 
									case CTIPO_IMAGEM: $icone = "glyphicon glyphicon-picture"; break; 
									case CTIPO_AUDIO: $icone = "glyphicon glyphicon-volume-up"; break; 
									case CTIPO_LIVRO: $icone = "glyphicon glyphicon-book"; break; 
									case CTIPO_PERGUNTA: $icone = "glyphicon glyphicon-question-sign"; break; 
									case CTIPO_LINK: $icone = "glyphicon glyphicon-link"; break; 
									case CTIPO_OUTRO: ; $icone = "glyphicon glyphicon-file"; break;
								}
							 

								if($i< 7){ 
								
								$conteudo_titulo = $favoritos["conteudos"][$i]->titulo;

								if (strlen($conteudo_titulo) > 20) {
								   $conteudo_titulo = substr($conteudo_titulo, 0, 20).'...'; 
								}
								?> 

								<li><a href="<?php echo site_url('conteudo/index/'.$favoritos['conteudos'][$i]->codigo)?>"><span class="<?php echo $icone; ?>"></span> <?php echo  $conteudo_titulo; ?></a></li>
							<?php }
							} ?>
							<li class="divider"></li> 
							<li><a href="#">Ver todos</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img class="img-thumbnail" width="51" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2v5n9eC9BRbXJ-zRxeiE6vPKpRoMAlqV7X3pO-1AZx5xIGykl5mSEmV4"/>
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
										<label><?php echo $usuario->nome; ?></label>
									</li>
								</ul>
							</div>
						</div>
						<div id="proprietario-xs"class="col-xs-12 icone-usuario hidden-sm hidden-md hidden-lg">
							<strong>Proprietário: </strong><label><?php echo $usuario->nome; ?></label>
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
