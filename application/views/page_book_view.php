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
		<h1>
			<?=$book['bName'] ?>
			<?php
				$COUNT = 5;
				$pMark = $mark['mark'];
				if (isset($pMark))
					while ($pMark >= 0.5) {
						$COUNT--;
						$pMark -= 1; 
						echo "<span class='glyphicon glyphicon-star'></span>";
					}
				while ($COUNT != 0) {
					$COUNT--;
					echo "<span class='glyphicon glyphicon-star-empty'></span>";
				}
				if (isset($mark['mark'])){
					$mark['mark'] *= 10; 
					$mark['mark'] =  round($mark['mark']);
					$pMark = $mark['mark'] / 10;
					echo "($pMark)";
				}
			?>
		</h1>
		<div class="col-md-4">
			<div class="thumbnail">
				<?php
					$cCount = $mark['cCount'];
					echo "$cCount человек оценили";
				?>
		    	<img src=<?php echo base_url().$book['cover']?>>
	      	</div>
		</div>
	  	<div class="col-md-4">
		    <div class="caption">
		        <h4>Автор: <?php if($book['aFIO']) echo $book['aFIO']; else echo'нет данных';?></h4>
		        <h4>Категория: <?php if($book['catName']) echo $book['catName']; else echo'нет данных';?></h4>
		        <h4>Год: <?php if($book['year']) echo $book['year']; else echo'нет данных';?></h4>
		        <p>
		        	<?php if($book['source']) { ?>
		        		<a class="btn btn-sm btn-info" href="<?=$book['source']?>" >
		        			Перейти на сайт-источник <span class='glyphicon glyphicon-share-alt'></span>
		        		</a>
		        	<?php }else echo'Source: не указан'?>
		        </p>
		        <p>
		        	<?php if($book['file']) { ?>
		        		<a class="btn btn-sm btn-success" href="<?=base_url().$book['file']?>" >
		        			Скачать файл <span class='glyphicon glyphicon-arrow-down'></span>
		        		</a>
		        	<?php }else echo'File: файл отсутствует'?>
		        </p>
		        <br>
	      	</div>
	  	</div>
	  	<br>
	  	<div class="col-md-3">
			<div>
	            <form class="col-md-12" method="POST" action="<?=base_url()?>index.php/admin/editBooks">
			        <input type="text" name="bID" hidden value=<?= $book['bID'] ?>>
			        <button class="btn btn-sm btn-warning btn-block" name='edit' type="submit">Изменить </button>
			    </form>
		        <form class="col-md-12" method="POST" action="<?=base_url()?>index.php/admin/delBooks">
		        	<input type="text" name="bID" hidden value=<?= $book['bID'] ?>>
		        	<button class="btn btn-sm btn-danger btn-block" name='del' type="submit">Удалить </button>
		        </form>
		        <br>
	      	</div>
		</div>
		<br>
		<div class="col-md-8"></div>
		<div class="col-md-8">	    	
		    <div class="caption">
		    	<form method="POST" action="<?=base_url()?>index.php/admin/pageBooks">
		    		Ваша оценка:
		    		<input type="text" name="bID" hidden value=<?=$book['bID'] ?>>
    		 	<?php
		    		$COUNT = 1;
		    		while ($COUNT != 6) {
		    			if($COUNT <= $uMark['mark']){
		    	?>
				        <button class="btn btn-sm btn-primary" name="set_<?=$COUNT ?>" type="submit"><?=$COUNT ?>
				        	<span class='glyphicon glyphicon-star-empty'></span>
				        </button>
				<?php 	
						}else{ 
				?>
				        <button class="btn btn-sm" name="set_<?=$COUNT ?>" type="submit"><?=$COUNT ?>
				        	<span class='glyphicon glyphicon-star-empty'></span>
				        </button>
				<?php
		    			}
		    			$COUNT++; 
		    		} 
		    	?>
		    	</form>
		    	<h3>Оставить комментарий:</h3>
		    	<form method="POST" action="<?=base_url()?>index.php/admin/pageBooks">
			        <input type="text" name="bID" hidden value=<?=$book['bID'] ?>>
			       	<textarea name="cText" cols="105" rows="6" style='resize: none'></textarea>
		        	<button class="btn btn-sm btn-info" name='say' type="submit">
		        		Отправить <span class='glyphicon glyphicon-envelope'></span>
		        	</button>
		    	</form>

		    	<?php if($comments) echo"<h3>Комментарии к книге:</h3>";?>
    		 	<?php
				    foreach ($comments as $comment):
				?>
				    	<div class="col-md-10">
					    	<form method="POST" action="<?=base_url()?>index.php/admin/pageBooks">
				    			<div class="col-md-10 thumbnail">
							        <h4><?=$comment['username'] ?></h4>
							        <?=$comment['cText'] ?>
							        <input type="text" name="cID" hidden value=<?=$comment['cID'] ?>>
							        <input type="text" name="bID" hidden value=<?=$book['bID'] ?>>
						        </div>
						        <div class="col-md-2">
						        	<button class="btn btn-sm btn-danger" name='delCom' type="submit">
						        		<span class='glyphicon glyphicon glyphicon-ban-circle'></span>
						        	</button>
						        </div>
					    	</form>
				    	</div>
				      
				<?php
				    endforeach;
				?>
				<br>
		    </div>
	    </div>
	</div>
</body>
</html>