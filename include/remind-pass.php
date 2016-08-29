<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
     include('bd-connect.php');
     include('../functions/functions.php');
     
     $email = clear_string($_POST["email"]);
     

     if ($email != "")
     {
       $result = mysql_query("SELECT email FROM reg_user WHERE email = '$email' ",$link);
if (mysql_num_rows($result) > 0)
{
    $newpass = fungenpass();
    
    $pass = md5($newpass);
    $pass = strrev($pass);
    $pass = strtolower("9nm2rv8q".$pass."2yo6z");
    
    $update =  mysql_query("UPDATE reg_user SET pass = '$pass' WHERE email = '$email' ",$link);
    
    
        send_mail ('lbeke@abv.bg',
                        $email,
                        'Новый пароль от сайта ShopTDS.kz',
                        'Ваш пароль: '.$newpass);
        
        
        
        
    
  echo 'yes';     
    
}else
{
    echo 'Данный E-mail не найден!';
}     

}
     

      
}


?>