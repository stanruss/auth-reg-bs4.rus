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
			<a class="navbar-brand" href="/"><img class="mr-4" src="img/Logo.png" alt="">Rusalut</a>
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


		<div class="container">
			<div class="row">
				<div class="col my-2">
					<!-- Блок для вывода сообщений -->
					<div class="block_for_messages">
						<?php
		//Если в сессии существуют сообщения об ошибках, то выводим их
						if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
							echo $_SESSION["error_messages"];

			//Уничтожаем ячейку error_messages, чтобы сообщения об ошибках не появились заново при обновлении страницы
							unset($_SESSION["error_messages"]);
						}

		//Если в сессии существуют радостные сообщения, то выводим их
						if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
							echo $_SESSION["success_messages"];

			//Уничтожаем ячейку success_messages,  чтобы сообщения не появились заново при обновлении страницы
							unset($_SESSION["success_messages"]);
						}
						?>
					</div>

					<?php 
	//Проверяем, если пользователь не авторизован, то выводим форму регистрации, 
	//иначе выводим сообщение о том, что он уже зарегистрирован
					if((!isset($_SESSION["email"]) && !isset($_SESSION["password"]))) {

						if(!isset($_GET["hidden_form"])){
							?>
							<div id="form_register">
								<h2 class="text-center">Форма регистрации</h2>

								<form action="register.php" class="text-center" method="post" name="form_register" >
									<table class="text-dark mx-auto">
										<tr>

											<td>
												<input type="text" placeholder="Имя" name="first_name" required="required"/>
											</td>
										</tr>

										<tr>

											<td>
												<input class="mt-2" placeholder="Фамилия" type="text" name="last_name" required="required" />
											</td>
										</tr>

										<tr>

											<td>
								<!-- 
									maxlength - устанавливает максимальное количество символов. То есть, сколько символов максимально можно ввести. 
								-->
								<input class="mt-2" type="email" name="email" placeholder="Email" maxlength="100" required="required" /><br>
								<!-- <p class="note_text mb-0">Укажите правильный Email, так как на нём будет выслано сообщение для подтверждения почты.</p> -->
								<span id="valid_email_message" class="mesage_error text-secondary"></span>
							</td>
						</tr>

						<tr>
							
							<td class="pb-2">
								<input class="mt-2" type="password" name="password" placeholder="Пароль от 6 символов" required="required" /><br />
								<span id="valid_password_message" class="mesage_error text-secondary"></span>
							</td>
						</tr>
						<tr>
							
							<td class="pb-2">
								<input class="mt-2" type="password" name="confirm_password" placeholder="Повторите пароль" required="required" /><br />
								<span id="valid_confirm_password_message" class="mesage_error text-secondary"></span>
							</td>
						</tr>
						<tr>
							
							<td>
								<p class="mb-2">
									<img src="captcha.php" alt="Капча" /> <br />
									<input class="mt-2" type="text" name="captcha" placeholder="Проверочный код" required="required" />
								</p>
								
							</td>
						</tr>
						<tr>
							<td colspan="2" class="text-center">
								<input type="submit" name="btn_submit_register" value="Зарегистрироваться!" />
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
			<h2>Вы уже зарегистрированы</h2>
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

<!-- Код JavaScript -->


