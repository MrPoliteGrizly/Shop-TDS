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
        $error[] = "����� ������ ���� �� 5 �� 15 ��������!";
    }
    else 
    {
        $result  = mysql_query("SELECT login FROM reg_user WHERE login = '$login'", $link);
        If (mysql_num_rows($result) > 0)
        {
            $error[] = "����� �����!";
            
        }
    }
        
        if (strlen($pass) < 7 or strlen($pass) > 15) $error[] = "������� ������ �� 7 �� 15 ��������";
        if (strlen($surname) < 3 or strlen($surname) > 20) $error[] = "������� ������� �� 3 �� 20 ��������";
        if (strlen($name) < 3 or strlen($name) > 15) $error[] = "������� ��� �� 3 �� 15 ��������";
        if (strlen($patronymic) < 3 or strlen($patronymic) > 25) $error[] = "������� �������� �� 7 �� 15 ��������";
        //email
        if (!$phone) $error[] = "������� ����� ��������!";
        if (!$address) $error[] = "���������� ������� ����� ��������!";
        if (!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/",trim($email))) $error[] = "������� ��������� E-mail";
        if ($_SESSION['img_capcha'] != strtolower($_POST['reg_capcha'])) $error[] = "�������� ��� � ��������";
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