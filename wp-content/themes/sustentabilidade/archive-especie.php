<?php get_header(); ?>
<body>
	<div class="site-container">

	
<?php 
	if(have_posts()):
		echo '<div class="row">';
		while (have_posts()):
			the_post();
?>

			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img style="width: 458px; height: 343px" src="<?php echo get_field('imagem')['sizes']['large']; ?>">
					<div class="caption">
						<h3><?php the_title(); ?></h3>
						<p><?php echo wp_trim_words(get_the_content(), 55, '...'); ?></p>
				    	<p>
				    		<!-- <a href="#" class="btn btn-primary" role="button">Button</a>  -->
				    		<a href="<?php the_permalink(); ?>" class="btn btn-default" role="button">Saiba Mais...</a>
				    	</p>
			   		</div>
				</div>
			</div>

<?php 
		if(($wp_query->current_post+1%3) == 0):
			echo '</div>';
			echo '<div class="row">';
		endif;
		endwhile;
		echo '</div>';
	endif;
?>

	</div>
</body>
<?php get_footer(); ?>