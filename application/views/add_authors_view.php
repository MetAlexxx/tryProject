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
              <a class="navbar-brand" href="../admin">Библиотека</a>
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
                Вы вошли как <?=$_SESSION['username']?>
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
      <li class="active"><a href="<?=base_url()?>index.php/admin/add_authors">Добавить</a></li>
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
    <h3>Добавление автора в список:</h3>
    <form method="POST" action="<?=base_url()?>index.php/admin/add_authors">
      <div class="col-md-3" style="position: absolute; left: 20%">
        <p><input type="text" placeholder="ФИО автора" name="name"?></p>
        <button class="btn btn-lg btn-success btn-block"name='enter' type="submit">Добавить</button>
<?php
        if(isset($error)){ 
         if($error =='Автор успешно добавлен!') {
?>        
          <p><div class='alert alert-success'><span class="glyphicon glyphicon-warning-sign"></span><?=$error?></div></p>
<?php 
          } else {
?>        
          <p><div class='alert alert-danger'><span class="glyphicon glyphicon-warning-sign"></span><?=$error?></div></p>
<?php     }
        } 
?>   
      </div>
    </form>
  </div>
</body>
</html>



