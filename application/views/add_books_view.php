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
	      			<a class="navbar-brand" href="adminMain.php">Библиотека</a>
	    		</div>
	    		<div class="col-md-5">
		    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      			<form class="navbar-form navbar-left" method="POST" action="SearchBooks">
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
		    				Вы вошли как <?= $_SESSION['username'] ?>
		    			</div>
	    			</div>
	    		</div>
	    	</div>	
  		</div>
	</nav>
	  <div class="col-md-2">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="<?=base_url()?>index.php/admin">Главная</a></li>
      </ul>
      <hr>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="<?=base_url()?>index.php/admin/books">Книги</a></li>
        <li class="active"><a href="<?=base_url()?>index.php/admin/add_books">Добавить</a></li>
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
		<h3>Добавление книги на сайт:</h3>
		<div class="col-md-4">
        <form method="POST" action="<?=base_url()?>index.php/admin/add_books">
          <p><h4>Общая информация:</h4></p>
    			<p>Название:<br><input class="form-control" type="text" name="bName" required autofocus></p>
                <p>Категория:<br>
            		<select class="form-control" name="catID">
                        <option  value='0'>Не указана</option>
  <?php 					foreach ($categories as $cat): ?>
  					<option  value=<?= $cat['catID'] ?>><?= $cat['catName'] ?></option>
  <?php  					endforeach; ?>
            		</select>
                </p>
  	        <p>Автор:<br>
          		<select class="form-control" name="aID">
                        <option value='0'>Не указан</option>
  <?php 						foreach ($authors as $author): ?>
  						<option value=<?= $author['aID'] ?>><?= $author['aFIO'] ?></option>
  <?php  						endforeach; ?>
         			</select>
                </p>
                <p>Год издания:<br><input type="number" class="form-control" max='<?=date('Y')?>' min="1500" value='<?=date('Y')?>' name="year"></p>
                <p>Ресурс:<br><input class="form-control" type="text" placeholder="Ссылка на сторонний сайт" name="source"></p>
                <p><button class="btn btn-lg btn-success btn-block" name="enter" type="submit">Добавить</button></p>
  <?php
        if(isset($error)){ 
  ?>        
          <p><div class='alert alert-danger'><span class="glyphicon glyphicon-warning-sign"></span><?=$error?></div></p>
          Загрузка файла и обложки осуществляется со страницы изменения после регистрации книги в системе.
  <?php     
        } 
  ?>
      </form>  
    </div>
  </div>
</body>
</html>