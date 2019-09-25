<?php get_header(); ?>

<div class="body">
	<div class="site-container">
		
		<div class="section-a">
			<a>
		    	<img class="img-post center-block" src="http://www.pinhais.pr.gov.br/meioambiente/defesaanimal/dbimages/39728_img.png">
		    </a>
		    <div class="sa-content">
				<p>
					O termo sustentabilidade consiste em possuir a característica de ser sustentável, que se pode conservar, ou seja, é quando existe a possibilidade de se beneficiar dos atributos de algo e mesmo assim mantê-lo.

					Por sua vez, o termo sustentabilidade ambiental define o modo como o homem age na utilização dos bens naturais e providencia soluções para as necessidades de si próprio e dos outros, de forma que não agrida o meio natural e garanta a utilização do mesmo em gerações futuras.


					A sustentabilidade ambiental está muito ligada ao termo desenvolvimento sustentável, que visa à utilização dos produtos do meio ambiente sem destruí-los ou extingui-los, garantindo, simultaneamente, o desenvolvimento financeiro, tecnológico, industrial, etc.
				</p>
			</div>	
			<!-- <div class="sa-content-2">
				<a>
			    	<img class="sa-img-2 center-block" src="https://observatorio3setor.org.br/wp-content/uploads/2018/02/preserva%C3%A7%C3%A3o1.jpg">
			    </a>
			</div> -->

			<div class="sa-content-3">

				<div class="card">
				  <div class="card-body">
				    <p>A sustentabilidade ambiental está muito ligada ao termo desenvolvimento sustentável, que visa à utilização dos produtos do meio ambiente sem destruí-los ou extingui-los, garantindo, simultaneamente, o desenvolvimento financeiro, tecnológico, industrial, etc. Você pode nos ajudar de diversas formas, seja contribuindo para causa regularmente com doações ou se informando e passando adiante essas informação. Saiba como clicando no botão abaixo.</p>
				  </div>
				</div>				
			</div>

			<button type="button" class="btn btn-success">Saiba Mais</button>

			<!-- <div class="sa-content-4 row">
				<div class="col-sm">								
					<div class="card" style="width: 100%;">
					  <img class="card-img-top" src="https://pixel.nymag.com/imgs/fashion/daily/2019/06/18/18-puppy-dog-eyes.w700.h700.jpg" alt="Imagem de capa do card">
					  <div class="card-body">
					    <h5 class="card-title">Título do card</h5>
					    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
					    <a href="#" class="btn btn-primary">Visitar</a>
					  </div>
					</div>
				</div>	
				<div class="col-sm">	
					<div class="card" style="width: 100%">
					  <img class="card-img-top" src="https://cdn-prod.medicalnewstoday.com/content/images/articles/322/322868/golden-retriever-puppy.jpg" alt="Imagem de capa do card">
					  <div class="card-body">
					    <h5 class="card-title">Título do card</h5>
					    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
					    <a href="#" class="btn btn-primary">Visitar</a>
					  </div>
					</div>
				</div>
				<div class="col-sm">								
					<div class="card" style="width: 100%;">
					  <img class="card-img-top" src="https://www.petmd.com/sites/default/files/Acute-Dog-Diarrhea-47066074.jpg" alt="Imagem de capa do card">
					  <div class="card-body">
					    <h5 class="card-title">Título do card</h5>
					    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
					    <a href="#" class="btn btn-primary">Visitar</a>
					  </div>
					</div>
				</div>
			</div> -->

		</div>
		
		<div class="sa-content-5">	
			<h3>Nosso Blog</h3>
			<?php 
				if(have_posts()):
				echo '<div class="row">';
					while(have_posts()):
						the_post();
			?>
	    	<div class="col-md-4">
		    	<div class="sa-blog">
				    <div class="heading-wrapper">
				    	<img class="sa-img-5" src="https://abrilexame.files.wordpress.com/2019/04/greenpeace-israel.jpg">
				      	<h1 class="blog-headline"><?php the_title(); ?></h1>
				      	<div class="byline-wrapper">
				        	<div class="byline-text">October 6, 2015</div>
				        	<div class="byline-text">IN</div>
				        	<?php if(!empty(get_the_category())): ?>
				        		<?php foreach (get_the_category() as $key => $value): ?>
				        			<a class="byline-link" href="#"><?php echo $value->cat_name; ?></a>
				        		<?php endforeach; ?>	
				        	<?php endif; ?>	
				    	</div>
				    </div>
				    <p class="blog-content">
				    	<?php echo wp_trim_words(get_the_content(), 40, '...'); ?>
				  	</p>
			  		<div class="middle">
			    		<div class="text">John Doe</div>
			  		</div>  
			  	</div>  
			</div>  	 	  		  	
			<?php   	
			  	endwhile;
			  	echo '</div>';
			endif;
			?>  
		</div>	
	  </div>
	</div>

  	
</div>
<?php get_footer(); ?>