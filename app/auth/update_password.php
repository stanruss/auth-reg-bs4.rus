<?php
	
	//Запускаем сессию
	session_start();
	
	//Добавляем файл подключения к БД
	require_once("dbconnect.php");

	if(isset($_POST["set_new_password"]) && !empty($_POST["set_new_password"])){

		//(1) Место для следующего куска кода
		
		//Проверяем, если существует переменная token в глобальном массиве POST
		if(isset($_POST['token']) && !empty($_POST['token'])){
		    $token = $_POST['token'];

		}else{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION["error_messages"] = "<p class='mesage_error text-secondary' ><strong>Ошибка!</strong>&nbsp; Отсутствует проверочный код ( Передаётся скрытно ).</p>";
			
			//Возвращаем пользователя на страницу установки нового пароля
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
			//Останавливаем  скрипт
			exit();
		}

		//Проверяем, если существует переменная email в глобальном массиве POST
		if(isset($_POST['email']) && !empty($_POST['email'])){
		    $email = $_POST['email'];

		}else{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION["error_messages"] = " <p class='mesage_error text-secondary' ><strong>Ошибка!</strong>&nbsp; Отсутствует адрес электронной почты ( Передаётся скрытно ).</p>";
			
			//Возвращаем пользователя на страницу установки нового пароля
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
			//Останавливаем  скрипт
			exit();
		}

		if(isset($_POST["password"])){
		    //Обрезаем пробелы с начала и с конца строки
		    $password = trim($_POST["password"]);
		    //Проверяем, совпадают ли пароли
		    if(isset($_POST["confirm_password"])){
		        //Обрезаем пробелы с начала и с конца строки
		        $confirm_password = trim($_POST["confirm_password"]);
		        if($confirm_password != $password){
		            // Сохраняем в сессию сообщение об ошибке. 
		            $_SESSION["error_messages"] = " <p class='mesage_error text-secondary' >Пароли не совпадают</p>";
		            
		            //Возвращаем пользователя на страницу установки нового пароля
		            header("HTTP/1.1 301 Moved Permanently");
		            header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
		            //Останавливаем  скрипт
		            exit();
		        }
		    }else{
		        // Сохраняем в сессию сообщение об ошибке. 
		        $_SESSION["error_messages"] = " <p class='mesage_error text-secondary' >Отсутствует поле для повторения пароля</p>";
		        
		        //Возвращаем пользователя на страницу установки нового пароля
		        header("HTTP/1.1 301 Moved Permanently");
		        header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
		        //Останавливаем  скрипт
		        exit();
		    }
		    if(!empty($password)){
		        $password = htmlspecialchars($password, ENT_QUOTES);
		        //Шифруем папроль
		        $password = md5($password."top_secret"); 
		    }else{
		        // Сохраняем в сессию сообщение об ошибке. 
		        $_SESSION["error_messages"] = " <p class='mesage_error text-secondary' >Пароль не может быть пустым</p>";
		        
		        //Возвращаем пользователя на страницу установки нового пароля
		        header("HTTP/1.1 301 Moved Permanently");
		        header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
		        //Останавливаем  скрипт
		        exit();
		    }
		}else{
		    // Сохраняем в сессию сообщение об ошибке. 
		    $_SESSION["error_messages"] = " <p class='mesage_error text-secondary' >Отсутствует поле для ввода пароля</p>";
		    
		    //Возвращаем пользователя на страницу установки нового пароля
		    header("HTTP/1.1 301 Moved Permanently");
		    header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
		    //Останавливаем  скрипт
		    exit();
		}


		//(2) Место для следующего куска кода
		$query_update_password = $mysqli->query("UPDATE users SET password='$password' WHERE email='$email'");

		if(!$query_update_password){

		    // Сохраняем в сессию сообщение об ошибке. 
		    $_SESSION["error_messages"] = " <p class='mesage_error text-secondary' >Возникла ошибка при изменении пароля.</p><p><strong>Описание ошибки</strong>: ".$mysqli->error."</p>";
		    
		    //Возвращаем пользователя на страницу установки нового пароля
		    header("HTTP/1.1 301 Moved Permanently");
		    header("Location: ".$address_site."auth/set_new_password.php?email=$email&token=$token");
		    
		    //Останавливаем  скрипт
		    exit();

		}else{
			//Подключение шапки
			require_once("header2.php");

			//Выводим сообщение о том, что пароль установлен успешно.
			echo '<h1 class="success_messages mt-4 text-success text-center">Пароль успешно изменён!</h1>';
			echo '<p class="text-center">Теперь Вы можете войти в свой аккаунт.</p>';

			//Подключение подвала
            require_once("footer2.php");
		}

	}else{
		exit("<p class='mesage_error text-secondary'><strong>Ошибка!</strong>&nbsp; Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
	}
?>