	<section>
		<div class="container">
			<div class="row">
				
				<?php foreach ($bases as$base) { ?>
				<div class="col-md-4 col-sm-6 bases-medias"> 
					<a href="<?php echo site_url('base/index/'.$base->codigo); ?>"> 
						<h3>
							<!-- <span class="fa fa-database"></span> -->
							<?php if(isset($base->acesso) || $base->restricao == "publica"){ ?>
								<span class="fa fa-database">
									<span class="fa-stack fa-lg">
										<i class="fa fa-circle fa-stack-1x icone-total-fafa"></i>
										<i class="fa fa-check fa-stack-1x fa-inverse icone-dentro-total-plataforma"></i>
									</span>
								</span>
							<?php }
							else{ 
								if($base->restricao == "parcial") { ?>
									<span class="fa fa-database">
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-1x icone-parcial-fafa"></i>
											<i class="fa fa-exclamation fa-stack-1x text-danger icone-dentro-parcial-plataforma"></i>
										</span>
									</span>
								<?php }
								else if($base->restricao == "restrita"){?>
									<span class="fa fa-database">
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-1x icone-restrito-fafa"></i>
											<i class="fa fa-remove fa-stack-1x text-danger icone-dentro-restrito-plataforma"></i>
										</span>
									</span>
								<?php }
							} ?>
							<?php echo $base->nome; ?>
						</h3> 
						<p>
							<?php
								if (strlen($base->descricao) > 200)
								   $descricao = substr($base->descricao, 0, 200) . '...'; 
							
								echo $descricao; 
							?>
						</p> 
					</a> 
				</div>
				<?php } ?>
				
			
			</div> 
		</div> 
	</section>