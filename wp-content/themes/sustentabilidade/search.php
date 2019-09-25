<?php get_header(); ?>

<?php 
	if(have_posts()): 
		while(have_posts()):
			the_post();
?>

<div>
	<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php echo wp_trim_words(get_the_content(),100); ?>
</div>


<?php 
		endwhile;
	else:
?>
	<h2>Nenhum resultado encontrado.</h2>
<?php
	endif;
?>

<?php get_footer(); ?>