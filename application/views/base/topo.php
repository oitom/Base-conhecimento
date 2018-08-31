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
								
								<?php if (!empty($usuarios['proprietarios'])) { ?>
									<li class="titulo-menu-usuario">Proprietários</li>
									<li class="divider"></li>
									<?php foreach ($usuarios['proprietarios'] as $proprietario) { ?>
										<li>
											<span class="glyphicon glyphicon-user"></span>
											<label><?php echo $proprietario->nome; ?></label>
										</li>
									<?php } ?>
								<?php } ?>	

								<?php if (!empty($usuarios['colaboradores'])) { ?>
									<li class="titulo-menu-usuario">Colaboradores</li>
									<li class="divider"></li>
									<?php foreach ($usuarios['colaboradores'] as $colaborador) { ?>
										<li>
											<span class="glyphicon glyphicon-user"></span>
											<label><?php echo $colaborador->nome; ?></label>
										</li>
									<?php } ?>
								<?php } ?>	
								</ul>
							</div>
						</div>
						<div id="proprietario-xs"class="col-xs-12 icone-usuario hidden-sm hidden-md hidden-lg">
							<?php if (!empty($usuarios['proprietarios'])) { ?>
								<div class="row">
									<div class="col-xs-12">
										<strong>Proprietários: </strong>
										<?php foreach ($usuarios['proprietarios'] as $proprietario) { ?>
												<span class="glyphicon glyphicon-user"></span>
												<label><?php echo $proprietario->nome; ?></label>
										<?php } ?>
									</div>
								</div>
							<?php } ?>	

							<?php if (!empty($usuarios['colaboradores'])) { ?>
								<div class="row">
									<div class="col-xs-12">
										<strong>Colaboradores: </strong>
										<?php foreach ($usuarios['colaboradores'] as $colaborador) { ?>
												<span class="glyphicon glyphicon-user"></span>
												<label><?php echo $colaborador->nome; ?></label>
										<?php } ?>
									</div>
								</div>
							<?php } ?>	
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="caminho-diretorio">
								<?php echo $caminho; ?> 
								<?php if(isset($usuario_logado)){
									if($verifica_favorito == false) {?>
										<a href="<?php echo site_url("base/adicionar_favorito/")."/".$base->codigo ?>"><span class="glyphicon glyphicon-star-empty" id="add-favorito"></span></a>
									<?php } else { ?>
										<a href="<?php echo site_url("base/remover_favorito/")."/".$base->codigo ?>"><span class="glyphicon glyphicon-star" id="favorito"></span></a>
									<?php } 
								}?>
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
