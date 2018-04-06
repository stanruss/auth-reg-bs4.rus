$(document).ready(function(){
	 "use strict";
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
                               // $('input[type=submit]').attr('disabled', true);
                                
                            }else{
                                //Иначе, если длина первого пароля больше шести символов, то мы также проверяем, если они  совпадают. 
                                if(password.val() !== confirm_password.val()){
                                    //Выводим сообщение об ошибке
                                    $('#valid_confirm_password_message').text('Пароли не совпадают');
                                    // Дезактивируем кнопку отправки
                                   // $('input[type=submit]').attr('disabled', true);
                                }else{
                                    // Убираем сообщение об ошибке у поля для ввода повторного пароля
                                    $('#valid_confirm_password_message').text('');
                                    //Активируем кнопку отправки
                                   // $('input[type=submit]').attr('disabled', false);
                                }
                                // Убираем сообщение об ошибке у поля для ввода пароля
                                $('#valid_password_message').text('');
                            }
                        }else{
                            $('#valid_password_message').text('Введите пароль');
                        }
                    });

                    confirm_password.blur(function(){
                        //Если пароли не совпадают
                        if(password.val() !== confirm_password.val()){
                            //Выводим сообщение об ошибке
                            $('#valid_confirm_password_message').text('Пароли не совпадают');
                            // Дезактивируем кнопку отправки
                           // $('input[type=submit]').attr('disabled', true);
                        }else{
                            //Иначе, проверяем длину пароля
                            if(password.val().length > 6){
                                // Убираем сообщение об ошибке у поля для ввода пароля
                                $('#valid_password_message').text('');
                                //Активируем кнопку отправки
                                //$('input[type=submit]').attr('disabled', false);
                            }
                            // Убираем сообщение об ошибке у поля для ввода повторного пароля
                            $('#valid_confirm_password_message').text('');
                        }
                    });
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

		//================ Проверка длины пароля ==================
		var password = $('input[name=password]');
		
		password.blur(function(){
			if(password.val() != ''){

				//Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
				if(password.val().length < 6){
					//Выводим сообщение об ошибке
					$('#valid_password_message').text('Минимальная длина пароля 6 символов');

					// Дезактивируем кнопку отправки
					//$('input[type=submit]').attr('disabled', true);
					
				}else{
					// Убираем сообщение об ошибке
					$('#valid_password_message').text('');

					//Активируем кнопку отправки
					//$('input[type=submit]').attr('disabled', false);
				}
			}else{
				$('#valid_password_message').text('Введите пароль');
			}
		});
		"use strict";
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
                    $('input[type=submit]').attr('disabled', false);
                  }else{
                    //Выводим сообщение об ошибке
                    $('#valid_email_message').text('Не правильный Email');
                    // Дезактивируем кнопку отправки
                    $('input[type=submit]').attr('disabled', true);
                  }
                }else{
                	$('#valid_email_message').text('Введите Ваш email');
                }
              });		
	});
