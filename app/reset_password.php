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




		<?php 
	//Проверяем, если пользователь не авторизован, то выводим форму регистрации, 
	//иначе выводим сообщение о том, что он уже зарегистрирован
		if((!isset($_SESSION["email"]) && !isset($_SESSION["password"]))) {
			if(!isset($_GET["hidden_form"])){
				?>
				<div class="container">
					<div class="row">
						<div class="col my-2">

							<!-- Блок для вывода сообщений -->
							<div class="block_for_messages">
								<?php
								if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
									echo $_SESSION["error_messages"];
			 //Уничтожаем ячейку error_messages, чтобы сообщения об ошибках не появились заново при обновлении страницы
									unset($_SESSION["error_messages"]);
								}
								if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
									echo $_SESSION["success_messages"];
									
			//Уничтожаем ячейку success_messages,  чтобы сообщения не появились заново при обновлении страницы
									unset($_SESSION["success_messages"]);
								}
								?>
							</div>
							<div class="text-center">
								<h2>Восстановление пароля</h2>
								
								<!-- Абзац -->
								
								<form action="send_link_reset_password.php" method="post" name="form_request_email" >
									<table class="mx-auto">
										<tr>
											
											<td>
												<input type="email" name="email" placeholder="Email" >
												<p class="text-center mesage_error text-secondary mb-0" id="valid_email_message"></p>
											</td>
										</tr>
										<tr>
											
											<td>
												<p>
													<img class="my-2" src="captcha.php" alt="Капча" /> <br />
													<input type="text" name="captcha" placeholder="Проверочный код" />
												</p>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<input type="submit" name="send" value="Восстановить">
											</td>
										</tr>
									</table>
								</form>
							</div>

							<?php 
		}//закрываем условие hidden_form
	}else{
		?>
		<div id="authorized">
			<h2>Вы уже авторизованы</h2>
		</div>
		<?php
	}
	
	?>
</div>
</div>
</div>
<script src="js/scripts.min.js"></script>

</body>
</html>