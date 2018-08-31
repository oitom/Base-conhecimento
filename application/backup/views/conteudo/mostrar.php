<section>
		<div id="corpo-conteudo" class="container">

						<?php switch ($conteudo->tipo) { case CTIPO_ARTIGO: ?>

							<div class="row">
								<div class="col-md-12">
									<nav class="navbar navbar-default menu-conteudo-opcoes" role="navigation">
									    <div class="container-fluid"> 

									        <div class="navbar-header">
									          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-artigo-superior">
									            	<span class="icon-bar"></span>
									            	<span class="icon-bar"></span>
									            	<span class="icon-bar"></span>
									          	</button>
									        </div>

									        <div class="navbar-collapse collapse menu-opcoes-collapse" id="menu-artigo-superior" >
									          	<ul class="nav navbar-nav">
									            	<li class="item-opcoes">
									            		<a href="#"><span class="glyphicon glyphicon-download"></span> Download</a>
									            	</li>
										            <li class="item-opcoes">
										            	<a href="#"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
										            </li>
										            <li class="item-opcoes">
										            	<a href="#"><span class="glyphicon glyphicon-share"></span> Compartilhar</a>
										            </li>
										            <li class="item-opcoes">
										            	<a href="#"><span class="glyphicon glyphicon-star-empty"></span> Favoritar</a>
										            </li>
										            <li class="item-opcoes">
										            	<a href="#"><span class=" glyphicon glyphicon-font"></span> Gerar referênmcias ABNT</a>
										            </li>
									          	</ul>
									        </div>
									      
									    </div>
									</nav>
								</div>
						    </div>

						    <div class="row">
								<div class="col-md-12">
									<div class="corpo-texto">
										<p><?php echo $conteudo->artigo->texto; ?></p>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<nav class="navbar navbar-default menu-conteudo-opcoes" role="navigation">
									    <div class="container-fluid">
									    	<div class="navbar-header">
									          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-artigo-superior">
									            	<span class="icon-bar"></span>
									            	<span class="icon-bar"></span>
									            	<span class="icon-bar"></span>
									          	</button>
									        </div>
									        <div class="navbar-collapse collapse menu-opcoes-collapse" id="menu-artigo-superior" >
									          	<ul class="nav navbar-nav">
									            	<li class="item-opcoes">
									            		<a href="#"><span class="glyphicon glyphicon-download"></span> Download</a>
									            	</li>
										            <li class="item-opcoes">
										            	<a href="#"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
										            </li>
										            <li class="item-opcoes">
										            	<a href="#"><span class="glyphicon glyphicon-share"></span> Compartilhar</a>
										            </li>
										            <li class="item-opcoes">
										            	<a href="#"><span class="glyphicon glyphicon-star-empty"></span> Favoritar</a>
										            </li>
										            <li class="item-opcoes">
										            	<a href="#"><span class=" glyphicon glyphicon-font"></span> Gerar referênmcias ABNT</a>
										            </li>
									          	</ul>
									        </div>
									    </div>
									</nav>
								</div>
						    </div>
						<?php break; ?>

						<?php case CTIPO_VIDEO: ?>
							<div class="row">
								<div class="col-md-12">
									<div class="corpo-texto">
										<div class="row">
											<div class="col-md-6 col-md-offset-3">
												<div class="embed-responsive embed-responsive-16by9">
													<iframe src="//www.youtube.com/embed/fx0mBsgS4Uw" frameborder="0" allowfullscreen></iframe>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php break; ?>
				
						<?php case CTIPO_LIVRO: ?>
							<div class="row">
								<div class="col-md-12">
									<div class="corpo-texto">
										<h2> <?php echo $conteudo->livro->subtitulo; ?> </h2>
										<p> <strong>Autor: </strong><?php echo $conteudo->livro->autor; ?> </p>
										<p> <strong>Número de páginas: </strong><?php echo $conteudo->livro->paginas; ?> </p>
										<p> <strong>Edição: </strong><?php echo $conteudo->livro->edicao; ?> </p>
										<p> <strong>Editora: </strong><?php echo $conteudo->livro->editora; ?> </p>
										<p> <strong>Ano: </strong><?php echo $conteudo->livro->ano; ?> </p>
									</div>
								</div>
							</div>
						<?php break; ?>
						<
									<!--case CTIPO_PERGUNTA: echo $conteudo->; break;
									case CTIPO_LINK: echo $conteudo->; break;
									case CTIPO_OUTRO: echo $conteudo->; break; -->
						<?php } ?>
		</div>

		<div id="area-comentario" class="container">
    		<div class="row">			
    			<div class="col-md-12">
					<h3>Comentários:</h3>
					<?php foreach ($conteudo->comentarios as $comentario) { ?>
						<div class="container texto-comentario">
							<div class="row">
								<div class="col-md-12">

									<ul class="media-list">
								  		<li class="media">
								    		<a class="pull-left" href="#">
								      			<img class="media-object" src="//lh6.googleusercontent.com/-Qsuw_9AAmIk/AAAAAAAAAAI/AAAAAAAAAH0/QQtDWkmynEM/s120-c/photo.jpg" class="fa-kz Zxa" style="cursor: pointer;">
								    		</a>
								    		<div class="media-body">
								      			<h4 class="media-heading">Professor Domingos</h4>
								      			<p><?php echo $comentario->texto; ?></p>
								    		</div>
								  		</li>
									</ul>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
    		</div>
    	</div>