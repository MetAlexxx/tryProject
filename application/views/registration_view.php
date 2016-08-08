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
<title>Регистрация</title>
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
              <a class="navbar-brand">Библиотека</a>
          </div>
          <div class="row">
              <div style="position: absolute; right: 10%">
                <a href=<?=base_url()?>>Вход на сайт</a>
              </div>
          </div>
        </div>  
      </div>
    </nav>
    <div class="container col-md-4"></div>
    <div class="container col-md-4">
      <form class="form-signin" method='POST' action="<?=base_url()?>index.php/registration">
        <h2 class="form-signin-heading">Рагистрация на сайте</h2>
        <input type="email" name="login" class="form-control" placeholder="Email" required autofocus><br>
        <input type="password" name="password1" class="form-control" placeholder="Password" required><br>
        <input type="password" name="password2" class="form-control" placeholder="Password(repiat)" required><br>
        <button class="btn btn-lg btn-primary btn-block" name="enter" type="submit">Зарегистрироваться</button>
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