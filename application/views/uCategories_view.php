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
              <a class="navbar-brand" href="../user">Библиотека</a>
          </div>
          <div class="col-md-5">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" method="POST" action="<?=base_url()?>index.php/user/SearchBooks">
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
      <li><a href="<?=base_url()?>index.php/user">Главная</a></li>
    </ul>
    <hr>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?=base_url()?>index.php/user/books">Книги</a></li>    
    </ul>
    <hr>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?=base_url()?>index.php/user/authors">Авторы</a></li>       
    </ul>
    <hr>
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a href="<?=base_url()?>index.php/user/categories">Категории</a></li>       
    </ul>
    <hr>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?=base_url()?>index.php/logout">Выход</a></li>
    </ul>
  </div>
  <div class="container-fluid">
<?php
    foreach ($categories as $cat):
?>
      <div class="col-sm-3 col-md-2">
        <div class="thumbnail">
          <div class="caption">
            <p><?=$cat['catName']?></p>
            <table>
              <tr>
                <td>
              </td>
              <td>
                  <form method="POST" action="<?=base_url()?>index.php/user/SearchBooksC">
                    <input type="text" name="cID" hidden value=<?=$cat['catID'] ?>>
                    <button class="btn btn-sm btn-info btn-block" name="categoryS" type="submit">
                      <span class="glyphicon glyphicon-search"></span> Найти книги
                    </button>
                  </form>
                </td>
              </tr>
            </table> 
          </div>
        </div>
      </div>
      
<?php
    endforeach;
?>
  </div>
  <ul class="pager">
    <?php echo $this->pagination->create_links();?>
  </ul>
</body>
</html>