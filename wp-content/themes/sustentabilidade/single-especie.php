<?php get_header(); ?>
<h1>SINGLE</h1>
<?php 
	if(have_posts()):
		while (have_posts()):
			the_post();
?>


<?php the_title(); ?>
<?php the_content(); ?>
<img src="<?php echo get_field('imagem')['sizes']['medium']; ?>">
<div class="box">
    <div class="doacao-box">
        <a href="<?php print get_post_type_archive_link(get_post_type()) ?>">Voltar para especies</a>
        <div>Já foram doados <div id="total_doado">R$ <?php the_field('total_doado'); ?></div> para <div class="nome-especie"><?php the_title(); ?></div> até agora</div>


        <button id="doacao" class="btn btn-success btn-block">FAZER DOACAO</button>
        <form   id="form_doacao">
            <label for="valor_doacao">Valor</label>
            <input id="inpt_doacao" type="number" step="0.01" name="doacao">
            <input type="hidden" name="especie_id" value="<?php echo get_the_ID(); ?>">

            <button type="submit" class="btn btn-success btn-block">DOAR</button>
        </form>
    </div>
</div>
<?php 
		endwhile;
	endif;
?>
<?php get_footer(); ?>