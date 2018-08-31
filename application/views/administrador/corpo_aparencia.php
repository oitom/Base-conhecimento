	
				<div id="main" class="col-md-10">
					<div>
						<div class="row">
							<div class="col-md-12">
								<!-- <form class="form-horizontal" method="post" action=""> -->
								<?php echo form_open_multipart('administrador/aparencia', 'class="form-horizontal" metod="post"');?>
									<div class="col-md-8">
										<h1>Aparência</h1>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-primary" type="submit">Enviar <span class="glyphicon glyphicon-send"></span> </button>
										<a href="<?php echo site_url("administrador/aparencia/TRUE") ?>" class="btn btn-info" type="button">Resetar <span class="glyphicon glyphicon-refresh"></a>
										<a href="<?php echo site_url("administrador/aparencia") ?>" class="btn btn-default" type="button">Cancelar <span class="fa fa-eraser"></a>
									</div>
									
									<div class="clearfix"></div>

									<div class="row">
										<div class="col-md-11 col-md-offset-1">
											<h3>Geral</h3>
											<div class="form-group">
												<label class="col-md-1 text-left">
													Fundo
													<input id="bg-corpo" name="bg-corpo" type="color" class="form-control" value="<?php echo set_value('bg-corpo') ? set_value('bg-corpo') : $cores['bg_corpo'];  ?>">
												</label>
												<label class="col-md-1 text-left">
													Seleção
													<input id="bg-selected" name="bg-selected" type="color" class="form-control" value="<?php echo set_value('bg-selected') ? set_value('bg-selected') : $cores['bg_selected'];  ?>">
												</label>
											</div>
										</div>
									</div>
									

									<div class="row">
										<div class="col-md-11 col-md-offset-1">
											<h3>Topo/Rodape</h3>
											<div class="form-group">
												<label class="col-xs-12 col-md-2 text-left">
													Logo
													<div class="clearfix visible-xs"></div>
													<label for="logo" class="label-img">
														<img src="<?php echo $plataforma->logo; ?>" id="img-logo" width="100%">
														<input type="file" name="logo" id="logo" class="send-image" onchange="logoIMG(this);">
													</label>
												</label>
												<label class="col-md-1 col-md-offset-1 text-left">
													Fonte
													<input id="font-topo-rodape" name="font-topo-rodape" type="color" class="form-control" value="<?php echo set_value('font-topo-rodape') ? set_value('font-topo-rodape') : $cores['font_topo_rodape'];  ?>">
												</label>
												<label class="col-md-1 text-left">
													Fundo
													<input id="bg-topo-rodape" name="bg-topo-rodape" type="color" class="form-control" value="<?php echo set_value('bg-topo-rodape') ? set_value('bg-topo-rodape') : $cores['bg_topo_rodape'];  ?>">
												</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-11 col-md-offset-1">
											<div class="row">
												<div class="col-md-6">
													<h3>Menu descrição</h3>
													<div class="form-group">
														<label class="col-md-6 text-left">
															Banner
															<label for="banner">
																<img src="<?php echo $banner ?>" id="img-banner" width="100%">
																<input type="file" class="send-image" id="banner" name="banner" onchange="bannerIMG(this);">
															</label>
														</label>
														<label class="col-md-2 text-left">
															Fonte
															<input id="font-cabecario" name="font-cabecario" type="color" class="form-control" value="<?php echo set_value('font-cabecario') ? set_value('font-cabecario') : $cores['font_cabecario'];  ?>">
														</label>
													</div>
												</div>
												<div class="col-md-6">
													<h3>Conteúdo</h3>
													<div class="form-group">
														<label class="col-md-2 text-left">
															Fonte
															<input id="font-corpo" name="font-corpo" type="color" class="form-control" value="<?php echo set_value('font-corpo') ? set_value('name="font-corpo') : $cores['font_corpo'];  ?>">
														</label>
														<label class="col-md-2 text-left">
															Fundo
															<input id="bg-conteudo" name="bg-conteudo" type="color" class="form-control" value="<?php echo set_value('bg-conteudo') ? set_value('bg-conteudo') : $cores['bg_conteudo'];  ?>">
														</label>
													</div>
												</div>												
											</div>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-11 col-md-offset-1">
											<h3>Pré-Visualização</h3>
												<div class="row">
													<div class="col-md-12">
														<div id="preview-tela">
															<div id="pv_topo">
																<img src="<?php echo $plataforma->logo; ?>">
																<p><strong>Contato</strong><strong>Login</strong></p>
															</div>
															<div id="pv_cabecario" style="background-image: url(<?php echo base_url("img/banner.jpg") ?>)">
																<span class="fa fa-database"></span>
																<strong>Base - Nome da base</strong>
																<p>Nome da Plataforma > Nome da Base</p>
																<small>Lorem ipsum dolor sit amet, consectetur nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat</small>
															</div>
															<div id="pv_corpo">
																<div>
																	<strong>Atualizações</strong>
																	<p>
																		<span class="glyphicon glyphicon-link"></span> Link para estudos<br>
																		<span class="glyphicon glyphicon-facetime-video"></span> Vídeo para estudos
																	</p>
																</div>
																<div>
																	<strong>Livros(1)</strong>
																	<div class="selected"><span class="glyphicon glyphicon-book"></span><p>Nome do livro<p></div>
																	<strong>Links(1)</strong>
																	<div><span class="glyphicon glyphicon-link"></span><p>Link Para Estudo<p></div>
																</div>
															</div>
															<div id="pv_rodape">
																<p>2014</p>
															</div>
															<img src="<?php echo base_url('img/pre-visualizar.png'); ?>">
														</div>
													</div>
												</div>											
										</div>
									</div>
								</form>
							</div>
						</div> 
					</div>
				</div>
			</div>
</section>