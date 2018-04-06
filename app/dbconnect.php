<?php
    // Указываем кодировку
    header('Content-Type: text/html; charset=utf-8');

    $server = "localhost"; /* имя хоста (уточняется у провайдера), если работаем на локальном сервере, то указываем localhost */
    $username = "u0343395_stanrus"; /* u0343395_stanrus */
    $password = "stan818791"; /* stan818791 */
    $database = "u0343395_u034339"; /* u0343395_u034339 */
 
    // Подключение к базе данных через MySQLi
    $mysqli = new mysqli($server, $username, $password, $database);

    // Проверяем, успешность соединения. 
    if (mysqli_connect_errno()) { 
        echo "<p><strong>Ошибка подключения к БД</strong>. Описание ошибки: ".mysqli_connect_error()."</p>";
        exit(); 
    }

    // Устанавливаем кодировку подключения
    $mysqli->set_charset('utf8');

    //Для удобства, добавим здесь переменную, которая будет содержать название нашего сайта
    $address_site = "http://poecilotheria.ru/app/";

    //Почтовый адрес администратора сайта
    $email_admin = "stan19781@gmail.com";
?>