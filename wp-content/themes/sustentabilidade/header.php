<!DOCTYPE html>
<html lang="pt">
<head>
  	<title>Sustentabilidade</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
  	<link href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" rel="stylesheet" type="text/css"> 
  	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/style.css" />
  	
	  <?php wp_head(); ?>
</head>
<body>
  <div id="page-header">

    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <a id="itens-header" class="navbar-brand" href="<?php echo home_url(); ?>"> Sustentabilidade</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-around" id="myNavbar">
        <ul class="nav navbar-nav  mr-auto">
          <li class="nav-item active"><a id="itens-header" href="<?php echo home_url(); ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link" id="itens-header" href="<?php echo get_post_type_archive_link('especie'); ?>">Espécies</a></li>
          <li class="nav-item"><a class="nav-link" id="itens-header" href="<?php echo get_post_type_archive_link('evento'); ?>">Eventos</a></li>
          <!-- <li class="nav-item "><a class="nav-link" id="itens-header" href="#">About</a></li> -->
        <li>
        	<?php //get_search_form(); ?>
        	<form class="navbar-form" role="search" method="get" id="searchform" class="searchform" action="http://sustentabilidade.local/">
				<div class="form-group">
					<input id="itens-header" style="height:100%" type="text" class="form-control" placeholder="Search" value="" name="s" id="s" />
				</div>
					<button id="itens-header"  type="submit" class="btn btn-default">Submit</button>
					<!-- <input type="submit" id="searchsubmit" value="Pesquisar" /> -->
			</form>
          </li>
          <?php if(!is_user_logged_in()): ?>
          <li>
            <a id="itens-header"  href="<?php echo home_url('cadastro'); ?>"><span class="glyphicon glyphicon-user"></span> Cadastrar</a>
          </li>
          <li>
            <a id="itens-header"  href="<?php echo home_url('login'); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          </li>
          <?php else: ?>
          	<li>
          		<a id="itens-header"  href="<?php echo home_url('logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
          	</li>
          <?php endif; ?>
        </ul>
      </div>

    </nav>

  </div>