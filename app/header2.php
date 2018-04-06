<?php 
    //Запускаем сессию
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">
	<!-- <base href="/"> -->

	<title>OptimizedHTML 4</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Template Basic Images Start -->
	<meta property="og:image" content="path/to/image.jpg">
	<link rel="icon" href="img/favicon/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon-180x180.png">
	<!-- Template Basic Images End -->

	<!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#000">
	<!-- Custom Browsers Color End -->

	<link rel="stylesheet" href="css/main.min.css">

</head>

<body class="text-dark">
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a class="navbar-brand" href="/">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="navbar-nav ml-auto">
					<?php 
        //Проверяем, авторизован ли пользователь
					if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        // если нет, то выводим блок со ссылками на страницу регистрации и авторизации
						?>
						<div class="nav-item">
							<a class="nav-link" href="form_register.php">Регистрация </a>
						</div>
						<div class="nav-item">
							<a class="nav-link" href="form_auth.php">Авторизация</a>
						</div>
						<?php
					}else{
    //Если пользователь авторизован, то выводим ссылку Выход
						?>  
						<div id="link_logout">
							<a href="logout.php">Выход</a>
						</div>
						<?php
					}
					?>
				</div>
			</nav>
		</header>