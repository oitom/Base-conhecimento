	<section>
		<div class="container">
			<div class="row">
				
				<?php foreach ($bases as$base) { ?>
				<div class="col-md-4 col-sm-6 bases-medias"> 
					<a href="<?php echo site_url('base/index/'.$base->codigo); ?>"> 
						<h3>
							<span class="fa fa-database"></span> 
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