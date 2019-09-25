<?php get_header(); ?>

<div class="btn-right-margin">
	<a href="<?php echo home_url('cria-evento'); ?>" class="alert-link">
		<div class="alert alert-info" role="alert">Criar evento</div>
	</a>
</div>

<select id="eventos-select" class="form-control">
	<option data-cat_id='-1'>Todos</option>
	<?php foreach (get_terms(['exclude' => '1']) as $key => $cat): ?>
	<option <?php if(isset($_GET['cat']) && $_GET['cat'] == $cat->term_id ): echo 'selected'; endif; ?>  data-cat_id="<?php echo $cat->term_id; ?>" ><?php echo $cat->name; ?></option>
	<?php endforeach; ?>
</select>

<?php 
	if(have_posts()):
	echo '<div class="row">';
		while(have_posts()):
			the_post();
?>

<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo get_field('imagem')['sizes']['medium'] ?>">
      <div class="caption">
        <h3><?php the_title(); ?></h3>
        <h4>
        	<?php $registrados_count = count(get_field('registrados')); ?>
        	<?php the_field("data_evento") ?> - <?php echo $registrados_count; ?> usuário<?php if($registrados_count != 1): echo "s"; endif?> registrado<?php if($registrados_count != 1): echo "s"; endif?> até agora.
       	</h4>
        <p><?php echo wp_trim_words(get_the_content(), 55, '...'); ?></p>
        <?php if(!empty(get_the_category())): ?>
	        <div class="card">
	          <ul class="list-group list-group-flush">
	          	<?php foreach (get_the_category() as $key => $value): ?>
	            	<li class="list-group-item"><?php echo $value->cat_name; ?></li>
	        	<?php endforeach; ?>
	          </ul>
	        </div>
    	<?php endif; ?>
        <p>
        	<a href="<?php the_permalink(); ?>" class="btn btn-info btn-lg btn-block" role="button">Detalhes</a> 
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

<?php get_footer(); ?>