		<div id="menu-horizontal" class="col-sm-12">
			<ul class="nav nav-pills	">
				<li role="presentation"><a href="<?php echo site_url('administrador/bases'); ?>">Bases</a></li>
				<li role="presentation" class="active" ?><a href="<?php echo site_url('administrador/conteudos'); ?>">Conteúdos</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/usuarios'); ?>">Usuários</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/grupos'); ?>">Grupos</a></li>
				<li role="presentation"><a href="#">Histórico</a></li>
				<li role="presentation"><a href="<?php echo site_url('administrador/palavrasChave'); ?>">Palavras-chave</a></li>
				<li role="presentation"><a href="#">Aparência</a></li>
				<li role="presentation"><a href="#">Configuração</a></li>
			</ul>
		</div>
		<div id="main" class="col-md-10 conteudos">
			<div>
				<h2>
					Conteúdos
					<button id="botao-adicionar" class="btn">
						<span class="glyphicon glyphicon-plus"></span>
						 Adicionar
					</button>
				</h2>
				<div class="row" id="menu-pesquisa">
					<div class="col-sm-3">
						<select class="form-control">
							<option>Selecionar base</option>
							<?php foreach ($bases as $base) { ?>
							<option><?php echo $base->nome; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control">
							<option>Selecionar tipo</option>
							<option>artigo</option>
							<option>video</option>
							<option>imagem</option>
							<option>audio</option>
							<option>livro</option>
							<option>pergunta</option>
							<option>link</option>
							<option>outro</option>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control">
							<option>Selecionar situação</option>
							<option>Privado</option>
							<option>Público</option>
						</select>
					</div>
					<div class="col-sm-3" id="input-pesquisa">
						<form class="bs-example bs-example-form"role="form">
					    	<div class="input-group">
							    <input type="text" class="form-control" placeholder="Pesquisar...">
						      	<span class="input-group-addon"> <span class="glyphicon glyphicon-search"></span> </span>
					    	</div>
						</form>
					</div>
				</div>
				<div class="table-responsive"> 
				<table id="tabela-conteudo" class="table">
					<tr>
						<th></th>
						<th>Título</th>
						<th>Data</th>
						<th>Tipo</th>
						<th>Situação</th>
						<th>Ações</th>
					</tr>
					<?php foreach ($conteudos as $conteudo) { ?>
					<tr>
						<td><input type="checkbox"></td>
						<td><?php echo $conteudo->titulo; ?></td>
						<td><?php echo date("d/m/Y", strtotime($conteudo->data_hora)); ?></td>
						<td>
							<?php switch ($conteudo->tipo) { case CTIPO_ARTIGO: echo "artigo"; break; ?>
							<?php case CTIPO_VIDEO: echo "video"; break; ?>
							<?php case CTIPO_IMAGEM: echo "imagem"; break; ?>
							<?php case CTIPO_AUDIO: echo "audio"; break; ?>
							<?php case CTIPO_LIVRO: echo "livro"; break; ?>
							<?php case CTIPO_PERGUNTA: echo "pergunta"; break; ?>
							<?php case CTIPO_LINK: echo "link"; break; ?>
							<?php } ?>
						</td>
						<td>
							<?php if ($conteudo->publico == 1) echo "público";
							else echo "privado"; ?>
						</td>
						<td>
							<button title="Visualizar" class="btn btn-primary">
								<span class="fa fa-binoculars"></span>
								<text class="hidden-conteudo">Visualizar</text> 
							</button>
							<button title="Editar" class="btn btn-warning">
								<span class="glyphicon glyphicon-pencil"></span>
								<text class="hidden-conteudo">Editar</text> 
							</button>
							<button title="Excluir" class="btn btn-danger">
								<span class="glyphicon glyphicon-trash"></span>	
								<text class="hidden-conteudo">Excluir</text>
							</button>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
			</div>
		</div>
	</div>

</section>