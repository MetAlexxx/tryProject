<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<meta charset='utf-8'/>
	<link type='text/css' rel='stylesheet' href='<?=base_url()?>bootstrap/css/bootstrap.css' />
	<link type='text/css' rel='stylesheet' href='<?=base_url()?>bootstrap/css/bootstrap.min.css' />
	<link type='text/css' rel='stylesheet' href='<?=base_url()?>bootstrap/css/bbootstrap-theme.css' />
	<link type='text/css' rel='stylesheet' href='<?=base_url()?>bootstrap/css/bootstrap-theme.min.css' />
	<title>Библиотека</title>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
  		<div class="container-fluid">
  			<div class="row">
	   			<div class="navbar-header col-md-4">
	     			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			            <span class="sr-only"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
	          		</button>
	      			<a class="navbar-brand" href="admin">Библиотека</a>
	    		</div>
	    		<div class="col-md-5">
		    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      			<form class="navbar-form navbar-left" method="POST" action="admin/SearchBooks">
			        		<div class="form-group">
			          			<input type="text" class="form-control" name="str" placeholder="Поиск книги">
			        		</div>
			        		<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		     			 </form>
		    		</div>
		    	</div>
	    		<div class="col-md-3">
	    			<div class="row">
		    			<div>
		    				Вы вошли как <?=$_SESSION['username'] ?>
		    			</div>
	    			</div>
	    		</div>
	    	</div>	
  		</div>
	</nav>
	<div class="col-md-2">
	    <ul class="nav nav-pills nav-stacked">
	      <li class="active"><a href="<?=base_url()?>index.php/admin">Главная</a></li>
	    </ul>
	    <hr>
	    <ul class="nav nav-pills nav-stacked">
	      <li><a href="<?=base_url()?>index.php/admin/books">Книги</a></li>
	      <li><a href="<?=base_url()?>index.php/admin/add_books">Добавить</a></li>
	    </ul>
	    <hr>
	    <ul class="nav nav-pills nav-stacked">
	      <li><a href="<?=base_url()?>index.php/admin/authors">Авторы</a></li>
	      <li><a href="<?=base_url()?>index.php/admin/add_authors">Добавить</a></li>
	    </ul>
	    <hr>
	    <ul class="nav nav-pills nav-stacked">
	      <li><a href="<?=base_url()?>index.php/admin/categories">Категории</a></li>
	      <li><a href="<?=base_url()?>index.php/admin/add_categories">Добавить</a></li>
	    </ul>
	    <hr>
	    <ul class="nav nav-pills nav-stacked">
	      <li><a href="<?=base_url()?>index.php/logout">Выход</a></li>
	    </ul>
    </div>
	<div class="container-fluid">
		<div>
			<h3>3 последние книги</h3>
		</div>
<?php
		foreach ($books as $book):
?>
		  <div class="col-sm-4 col-md-3">
		    <div class="thumbnail">
		      <img src=<?php echo base_url().$book['cover']?>>
		      <div class="caption">
		      	<h3><?=$book['bName']?></h3>
		        <p>
		        	Автор: <?=$book['aFIO']?>
	        		<?php if(!isset($book['aFIO'])) echo"не указан"?>
	        	</p>
		        <p>
		        	Категория: <?=$book['catName']?>
	        		<?php if(!isset($book['catName'])) echo"нет категории"?>
	        	</p>
		      	<form method="POST" action="<?=base_url()?>index.php/admin/pageBooks">
			        <input type='text' name='bID' hidden value='<?=$book['bID']?>'>
			        <button class="btn btn-lg btn-success btn-block" name="ENTER" type="submit">Показать</button>
		        </form>
		      </div>
		    </div>
		  </div>
<?php
		endforeach;
?>
	</div>
</body>
</html>