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
							<h1>
							<?php echo $conteudo->titulo; ?>
							<?php if(isset($usuario_logado)){
								if($verifica_favorito == false) {?>
									<a href="<?php echo site_url("conteudo/adicionar_favorito/")."/".$conteudo->codigo ?>"><span class="glyphicon glyphicon-star-empty" id="add-favorito"></span></a>
								<?php } else { ?>
									<a href="<?php echo site_url("conteudo/remover_favorito/")."/".$conteudo->codigo ?>"><span class="glyphicon glyphicon-star" id="favorito"></span></a>
								<?php }
							} ?>
							</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div id="corpo-conteudo" class="container">