<?php get_header(); ?>

<?php 
	if(have_posts()):
		the_post();
?>

<h1><?php the_title(); ?></h1>

<?php 
	if(!empty(get_the_category())): 
		foreach (get_the_category() as $key => $category):
?>
	<span><?php echo $category->name; ?></span>
<?php 
		endforeach;
	endif; 
?>
<div>
	<?php the_content(); ?>
</div>


<?php 
	$registrados = get_field('registrados'); 
	if(!empty($registrados)):
		$registrado_key = array_search(get_current_user_ID(), array_column($registrados, 'ID'));
		//retorna a chave do usuario no array ou false
		foreach ($registrados as $key => $registrado_arr):
			if(!($registrado_key === false)):
?>
				<h3>Você já se registrou nesse evento</h3>
			<?php else: ?>
				<?php if(is_user_logged_in()): ?>
				<button class="registrar-evento"  data-user="<?php echo get_current_user_ID(); ?>" data-evento="<?php echo get_the_ID(); ?>" >Registrar</button>
				<?php endif; ?>
			<?php endif ?>
	<span><?php echo $registrado_arr['user_email']; ?></span><br>

<?php 
		endforeach;
	else:
?>
<h3>Ninguem se registrou ainda nesse evento</h3>
<?php if(is_user_logged_in()): ?>
<button class="registrar-evento"  data-user="<?php echo get_current_user_ID(); ?>" data-evento="<?php echo get_the_ID(); ?>" >Registrar</button>
<?php endif; ?>
<?php
	endif;
?>

<?php 
	endif;
?>

<?php get_footer(); ?>