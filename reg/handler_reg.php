<?php

session_start();

 include("../include/bd-connect.php");
 include("../functions/functions.php");
  
 //$sex  = iconv("UTF-8", "cp1251", clear_string($_POST['sex'])) ;          
            $error = array();
                $login  = iconv("UTF-8", "cp1251", strtolower(clear_string($_POST['reg_login'])) );
                $pass  = iconv("UTF-8", "cp1251", strtolower(clear_string($_POST['reg_pass'])) );
                $surname  = iconv("UTF-8", "cp1251", clear_string($_POST['reg_surname'])) ;
                
                $name  = iconv("UTF-8", "cp1251", clear_string($_POST['reg_name'])) ;
                $patronymic  = iconv("UTF-8", "cp1251", clear_string($_POST['reg_patronymic'])) ;
                $email  = iconv("UTF-8", "cp1251", clear_string($_POST['reg_email'])) ;
                
                $phone  = iconv("UTF-8", "cp1251", clear_string($_POST['reg_phone'])) ;
                $address  = iconv("UTF-8", "cp1251", clear_string($_POST['reg_address'])) ;
                $sex  = iconv("UTF-8", "cp1251", clear_string($_POST['sex'])) ;

    if (strlen($login) < 5 or strlen($login) > 15 )
    {
        $error[] = "Логин должен быть от 5 до 15 символов!";
    }
    else 
    {
        $result  = mysql_query("SELECT login FROM reg_user WHERE login = '$login'", $link);
        If (mysql_num_rows($result) > 0)
        {
            $error[] = "Логин занят!";
            
        }
    }
        
        if (strlen($pass) < 7 or strlen($pass) > 15) $error[] = "Укажите пароль от 7 до 15 символов";
        if (strlen($surname) < 3 or strlen($surname) > 20) $error[] = "Укажите Фамилию от 3 до 20 символов";
        if (strlen($name) < 3 or strlen($name) > 15) $error[] = "Укажите Имя от 3 до 15 символов";
        if (strlen($patronymic) < 3 or strlen($patronymic) > 25) $error[] = "Укажите Отчество от 7 до 15 символов";
        //email
        if (!$phone) $error[] = "Укажите номер телефона!";
        if (!$address) $error[] = "Необходимо указать адрес доставки!";
        if (!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/",trim($email))) $error[] = "Укажите коректный E-mail";
        if ($_SESSION['img_capcha'] != strtolower($_POST['reg_capcha'])) $error[] = "Неверный код с картинки";
        unset($_SESSION['img_capcha']);
        
        if (count($error))
        {
           echo implode('<br />', $error);
        }else
        {
            $pass = md5($pass);
            $pass = strrev($pass);
            $pass = "9nm2rv8q".$pass."2yo6z";
            
            $ip = $_SERVER["REMOTE_ADDR"];
            
            mysql_query("INSERT INTO reg_user(login,pass,surname,name,patronymic,email,phone,address,sex,datetime, ip)
                            VALUES(
                            
                            '".$login."',
                            '".$pass."',
                            '".$surname."',
                            '".$name."',
                            '".$patronymic."',
                            '".$email."',
                            '".$phone."',
                            '".$address."',
                            '".$sex."',
                            NOW(),
                            '".$ip."'
                            )", $link);
            
        echo 'true';
        }
     
?>