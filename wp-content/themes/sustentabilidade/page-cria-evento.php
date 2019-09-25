<?php get_header(); ?>
<?php do_action('do_cria_evento'); ?>

<h1>Criar Evento</h1>
<?php if(isset($_POST['success_message']) && isset($_POST['success_infos'])): ?>
	<div class="alert alert-success" role="alert">
		<?php  echo $_POST['success_message']; ?><br> 
		<b><?php echo $_POST['success_infos']['title']; ?></b><br>
		<a href="<?php echo $_POST['success_infos']['permalink']; ?>	"><?php echo $_POST['success_infos']['permalink']; ?></a>
	</div>
<?php endif; ?>
<form action="" method="POST" enctype="multipart/form-data" >
	<div class="form-group">
		<label>Nome</label>
		<input class="form-control" required type="text" name="nome">
	</div>

	<div class="form-group">
		<label>Descrição</label>
		<textarea class="form-control" required  name="descricao"></textarea>
	</div>

	<div class="form-group">
		<label>Data</label>
		<input class="form-control" required type="date" name="dia">
	</div>

	<div class="form-group">
		<label>Categoria</label>
		<select multiple class="form-control" name="categoria[]">
			<?php foreach (get_categories(['exclude' => '1','hide_empty' => false]) as $key => $cat): ?>
				<option value="<?php echo $cat->term_id ?>"><?php echo $cat->name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label>Imagem</label>
		<input class="form-control" required type="file" name="imagem">
	</div>

		<button type="submit" class="btn btn-default">Criar Evento</button> 
</form>

<?php get_footer(); ?>