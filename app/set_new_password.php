<?php 
//Добавляем файл подключения к БД
require_once("dbconnect.php");

//Проверяем, если существует переменная token в глобальном массиве GET
if(isset($_GET['token']) && !empty($_GET['token'])){
    $token = $_GET['token'];
}else{
    exit("<p class='text-secondary text-center'><strong>Ошибка!</strong>&nbsp; Отсутствует проверочный код.</p>");
}

//Проверяем, если существует переменная email в глобальном массиве GET
if(isset($_GET['email']) && !empty($_GET['email'])){
    $email = $_GET['email'];
}else{
    exit("<p class='text-secondary text-center'><strong>Ошибка!</strong>&nbsp; Отсутствует адрес электронной почты.</p>");
}

//Делаем запрос на выборке токена из таблицы confirm_users
$query_select_user = $mysqli->query("SELECT reset_password_token FROM `users` WHERE `email` = '".$email."'");
//Если ошибок в запросе нет
if(($row = $query_select_user->fetch_assoc()) != false){

    //Если такой пользователь существует
    if($query_select_user->num_rows == 1){
        //Проверяем совпадает ли token
        if($token == $row['reset_password_token']){

            //(1) Место для вывода формы установки нового пароля
            //Подключение шапки
            require_once("header2.php");
            ?>
            
            <div class="container">
             <div class="row">
                 <div class="col">

                    <div class="text-center">

                        <h2>Установка нового пароля</h2>

                        <!-- Форма установки нового пароля -->
                        <form action="update_password.php" method="post">
                            <table class="mx-auto">
                                <tr>
                                    
                                    <td>
                                        <input type="password" name="password" placeholder="Новый пароль" required="required" /><br />
                                        <span id="valid_password_message" class="mesage_error text-secondary"></span>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        <input class="my-2" type="password" name="confirm_password" placeholder="Повторите пароль" required="required" /><br />
                                        <span id="valid_confirm_password_message" class="mesage_error text-secondary"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" name="token" value="<?=$token?>">
                                        <input type="hidden" name="email" value="<?=$email?>">
                                        <input type="submit" name="set_new_password" value="Изменить пароль" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
            //Подключение подвала
        require_once("footer2.php");

    }else{
        exit("<p class='text-secondary text-center'><strong>Ошибка!</strong>&nbsp; Неправильный проверочный код.</p>");
    }
}else{
    exit("<p class='text-secondary text-center'><strong>Ошибка!</strong>&nbsp; Такой пользователь не зарегистрирован </p>");
}
}else{
    //Иначе, если есть ошибки в запросе к БД
    exit("<p class='text-secondary text-center'><strong>Ошибка!</strong>&nbsp; Сбой при выборе пользователя из БД. </p>");
}
// Завершение запроса выбора пользователя из таблицы users
$query_select_user->close();
//Закрываем подключение к БД
$mysqli->close();
?>