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
<title>Вход</title>
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
              <a class="navbar-brand" href="#">Библиотека</a>
          </div>
        </div>  
      </div>
    </nav>
    <div class="container col-md-4"></div>
    <div class="container col-md-4">
      <form class="form-signin" method='POST' action="<?=base_url()?>index.php/login">
        <h2 class="form-signin-heading">Вход на сайт</h2>
        <input type="email" name="login" class="form-control" placeholder="Email" required autofocus><br>
        <input type="password" name="password" class="form-control" placeholder="Password" required><br>
        <button class="btn btn-lg btn-primary btn-block" name="enter" type="submit"> Войти</button>
      </form>
      <form class="form-signin" method='POST' action="<?=base_url()?>index.php/registration">
        <button class="btn btn-lg btn-default btn-block" name="reg" type="submit"> Регистрация</button>
      </form>
<?php
      if(isset($error)) { 
?>
        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span><?=$error?></div>
<?php
      } 
?>
    </div>
  </body>

</html>