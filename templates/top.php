<?php require_once('config/config.php');
if($_SESSION['user_id']){

		

}
?>

<!DOCTYPE html>
<html lang="ru">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="author" content="<?php echo $email ?>">

    <title><?php echo (isset($title))?$title:'нет тайтла' ?></title>
	<link href="vendor/css/half-slider.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 <?php
	 if($_SESSION['user_id']){
		 ?>
		 <script src="vendor/js/logined.js"></script>
		 <?php
		}
	 ?>
  </head>

  <body>

    

   <nav class="bgcolor navbar navbar-expand-lg navbar-light bg-light ">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="<?php echo $logo?>" alt="" title=""/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Главная
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="static.php?url=about">О нас</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="static.php?url=services">Услуги</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="static.php?url=contact">Контакты</a>
            </li>
			  <?php
				
				if(isset($_SESSION['user_id'])){
					echo '<li class="nav-item dropdown open"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">'.$_SESSION["user_name"].'<span class="caret"></span></a><ul class="dropdown-menu "><li class="nav-item"><a class="nav-link"  href="cabinet.php">Профиль</a></li><li class="nav-item"><a href="logout.php" class="nav-link">Выйти</a></li></ul></li>';
				}
				else{
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="login.php">Войти</a>';
					echo '</li>';
				}
				?>
          </ul>
        </div>
      </div>
    </nav>