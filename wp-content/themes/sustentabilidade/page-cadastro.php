<?php do_action('do_cadastro'); ?>
<?php get_header(); ?>
<div class="box">
	<h2 class="form-head">Cadastrar</h2>
	<form class="form" method="post" action="<?php ?>">
		<label class="center-text-login" for="login">Login</label>
		<input class="form-control" type="text" name="login">

		<label class="center-text-login" for="senha">Senha</label>
		<input class="form-control" type="password" name="senha">

		<input type="hidden" name="action" value="do_cadastro">

		<button class="btn btn-lg btn-dark btn-block" type="submit">Cadastrar</button>   
	</form>
</div>

<?php get_footer(); ?>