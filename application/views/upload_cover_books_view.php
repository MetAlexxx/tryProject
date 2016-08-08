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
	      			<a class="navbar-brand" href="a<?=base_url()?>index.php/admin">Библиотека</a>
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
    <p><h3>Загрузка обложки:</h3></p>
    <div class="col-md-4">
      <form method="POST" action="<?=base_url()?>index.php/admin/addCover" enctype="multipart/form-data"/>
        <input type="text" hidden value='<?=$bID?>' name="bID">
        <p>Обложка книги: <?php if(isset($fileUp)){?><span class='glyphicon glyphicon-ok' style='color: green'></span><?php } ?></p>
        <p><input type='file' name='userfile'/></p>
        <div class="col-md-7">
            <button class="btn btn-sm btn-success btn-block" name="enter" type="submit">
              Загрузить <span class="glyphicon glyphicon-arrow-up"></span>
            </button>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <p>Вернуться к изменению книги:</p>
      <div class="col-md-7">
        <form  method="POST" action="<?=base_url()?>index.php/admin/editBooks">
            <input type="text" name="bID" hidden value=<?=$bID?>>
            <button class="btn btn-sm btn-warning btn-block" name='edit' type="submit"><span class='glyphicon glyphicon-arrow-left'></span> Назад</button>
        </form> 
      </div>
    </div>
	</div>
</body>
</html>