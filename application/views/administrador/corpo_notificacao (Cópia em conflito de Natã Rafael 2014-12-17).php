				<div id="main" class="col-md-10">
					<div>
						
						<h2> Notificação </h2>
						<hr>

						<div class="table-portable">
							<table class="table" id="tabela-palavra-chave">
								<thead>
									<tr>
										<th>Título</th>
										<th>Data</th>
										<th>Tipo</th>
										<th>Situação</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody class="panel">
									<?php   foreach ($conteudos as $conteudo) { ?>
											
									<tr>
										<td><?php echo $conteudo->titulo; ?></td>
										<td><?php echo $conteudo->data_hora; ?></td>
										<td><?php echo $conteudo->tipo; ?></td>
										<td><?php echo $conteudo->situacao; ?></td>
										<td>Ações</td>
									</tr>

								<?php	} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
</section>