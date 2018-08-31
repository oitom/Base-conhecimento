<section id="corpo-administrador" class="container-fluid">
	<div class="row">
		<div id="menu-lateral" class="col-sm-2 hidden-xs <?php if ($opcao == 'bases' || $opcao == 'conteudos') echo 'hidden-menu-lateral'?>">
			<ul class="nav nav-pills nav-stacked affix" role="tablist">
			 	<li role="presentation" <?php echo $opcao == "bases" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/bases'); ?>">Bases</a></li>
	        	<li role="presentation" <?php echo $opcao == "conteudos" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/conteudos'); ?>">Conteúdos</a></li>
	        	<li role="presentation" <?php echo $opcao == "usuarios" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/usuarios'); ?>">Usuários</a></li>
	        	<li role="presentation" <?php echo $opcao == "grupos" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/grupos'); ?>">Grupos</a></li>
	        	<li role="presentation" <?php echo $opcao == "acessos" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/acessos'); ?>">Acessos</a></li>
	        	<li role="presentation" <?php echo $opcao == "historico" ? 'class="active"' : "" ?>><a href="#">Histórico</a></li>
	        	<li role="presentation" <?php echo $opcao == "palavras-chave" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/palavrasChave'); ?>">Palavras-chave</a></li>
	        	<li role="presentation" <?php echo $opcao == "aparencia" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/aparencia'); ?>">Aparência</a></li>
	        	<li role="presentation" <?php echo $opcao == "configuracao" ? 'class="active"' : "" ?>><a href="<?php echo site_url('administrador/configuracao'); ?>">Configuração</a></li>
	    	</ul>
		</div>