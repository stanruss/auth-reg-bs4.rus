<?php
require_once("header.php");
?> 


<div class="container">
	<div class="row">
		<div class="col my-2">
			<!-- Блок для вывода сообщений -->
			<div class="block_for_messages text-secondary">
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
<?php

	//Подключение подвала
require_once("footer.php");
?>

<!-- Код JavaScript -->
<script type="text/javascript">
	$(document).ready(function(){
		"use strict";
		//================ Проверка email ==================

		//регулярное выражение для проверки email
		var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
		var mail = $('input[name=email]');
		
		mail.blur(function(){
			if(mail.val() != ''){

				// Проверяем, если email соответствует регулярному выражению
				if(mail.val().search(pattern) == 0){
					// Убираем сообщение об ошибке
					$('#valid_email_message').text('');

					//Активируем кнопку отправки
					//$('input[type=submit]').attr('disabled', false);
				}else{
					//Выводим сообщение об ошибке
					$('#valid_email_message').text('Не правильный Email');

					// Дезактивируем кнопку отправки
					//$('input[type=submit]').attr('disabled', true);
				}
			}else{
				$('#valid_email_message').text('Введите Ваш email');
			}
		});

		//================ Прооверка паролей ==================
		var password = $('input[name=password]');
		var confirm_password = $('input[name=confirm_password]');
		
		password.blur(function(){
			if(password.val() != ''){

				//Если длина введённого пароля меньше шести символов, то выводим сообщение об ошибке
				if(password.val().length < 6){
					//Выводим сообщение об ошибке
					$('#valid_password_message').text('Минимальная длина пароля 6 символов');

					//проверяем, если пароли не совпадают, то выводим сообщение об ошибке
					if(password.val() !== confirm_password.val()){
						//Выводим сообщение об ошибке
						$('#valid_confirm_password_message').text('Пароли не совпадают');
					}

					// Дезактивируем кнопку отправки
					//$('input[type=submit]').attr('disabled', true);
					
				}else{
					//Иначе, если длина первого пароля больше шести символов, то мы также проверяем, если они  совпадают. 
					if(password.val() !== confirm_password.val()){
						//Выводим сообщение об ошибке
						$('#valid_confirm_password_message').text('Пароли не совпадают');

						// Дезактивируем кнопку отправки
						//$('input[type=submit]').attr('disabled', true);
					}else{
						// Убираем сообщение об ошибке у поля для ввода повторного пароля
						$('#valid_confirm_password_message').text('');

						//Активируем кнопку отправки
						//$('input[type=submit]').attr('disabled', false);
					}

					// Убираем сообщение об ошибке у поля для ввода пароля
					$('#valid_password_message').text('');
				}

			}else{
				$('#valid_password_message').text('Введите пароль');
			}
		});

		//(1) — Место для следующего куска кода

		confirm_password.blur(function(){
			//Если пароли не совпадают
			if(password.val() !== confirm_password.val()){
				//Выводим сообщение об ошибке
				$('#valid_confirm_password_message').text('Пароли не совпадают');

				// Дезактивируем кнопку отправки
				//$('input[type=submit]').attr('disabled', true);
			}else{
				//Иначе, проверяем длину пароля
				if(password.val().length > 6){

					// Убираем сообщение об ошибке у поля для ввода пароля
					$('#valid_password_message').text('');

					//Активируем кнопку отправки
				   // $('input[type=submit]').attr('disabled', false);
				 }

				// Убираем сообщение об ошибке у поля для ввода повторного пароля
				$('#valid_confirm_password_message').text('');
			}

		});
	});
</script>

