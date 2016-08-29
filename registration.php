<?php
    include("include/bd-connect.php");
    include("functions/functions.php");
    session_start();
    include("include/auth_cookie.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jCarouselLite.js"></script>
    <script type="text/javascript" src="/js/shop-script.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/trackbar/trackbar.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.js"></script>
    <script type="text/javascript" src="/js/jquery.textchange.js"></script>
     <script type="text/javascript">
$(document).ready(function (){
    $('#form-reg').validate(
    {
        rules:{
            "reg_login":{
                required: true,
                minlength:5,
                maxlength:15,
                remote: {
                    type:"post",
                    url:"/reg/check_login.php"
                    }
            },
              "reg_pass":{
                required: true,
                minlength:7,
                maxlength:15
               
            },
              "reg_surname":{
                required: true,
                minlength:3,
                maxlength:15
               
            },
                "reg_name":{
                required: true,
                minlength:3,
                maxlength:15
               
            },
                "reg_patronymic":{
                required: true,
                minlength:3,
                maxlength:25
               
            },
                "reg_email":{
                required: true,
                email: true
            },
                "reg_phone":{
                required: true
            },
                "reg_address":{
                required: true
            },
                "reg_capcha":{
                required: true,
                remote: {
                    type:"post",
                    url:"/reg/check_capcha.php"
                    }
            }
        },
    
    messages:{
        "reg_login":{
                required: "������� �����",
                minlength:"�� 5 �� 15 ��������",
                maxlength:"�� 5 �� 15 ��������",
                remote: "����� �����!"
            },
              "reg_pass":{
                required: "������� ������",
                minlength:"�� 7 �� 15 ��������",
                maxlength:"�� 7 �� 15 ��������"
               
            },
              "reg_surname":{
                required: "������� ���� �������",
                minlength:"�� 3 �� 15 ��������",
                maxlength:"�� 3 �� 15 ��������"
               
            },
                "reg_name":{
                required: "������� ���� ���",
                minlength:"�� 3 �� 15 ��������",
                maxlength:"�� 3 �� 15 ��������"
               
            },
                "reg_patronymic":{
                required: "������� ���� ��������",
                minlength:"�� 3 �� 25 ��������",
                maxlength:"�� 3 �� 25 ��������"
               
            },
                "reg_email":{
                required: "������� ���� E-mail",
                email: "�� ���������� E-mail"
            },
                "reg_phone":{
                required: "������� ����� ��������"
            },
                "reg_address":{
                required:"���������� ������� ����� ��������"
            },
                "reg_capcha":{
                required: "������� ��� � ��������",
                remote: "�������� ��� ��������"
            }
        
        },
    
    submitHandler: function(form){
        $(form).ajaxSubmit({
            success: function(data){
            if (data == "true")
            {
                $("#block-form-registration").fadeOut(300,function(){
                    
                 $("#reg_message").addClass("reg_message_good").fadeIn(400).html("�� ������� ������������������!");
                 $("#form_submit").hide();
                    
                    
                    
                });
            }
            else
            {
                $("#reg_message").addClass("reg_message_error").fadeIn(400).html(data);
            }
                
                }
                 });
                }
                 });
                });  
        </script>
    <title>�����������</title>
</head>

<body>

<div id="block-body">

<?php

    include("include/block-header.php");
?>

<div id="block-right">
<?php

    include("include/block-category.php");
    include("include/block-parametr.php");
    include("include/block-news.php");
?>

</div>

<div id="block-content">
<h2 class="h2-title">�����������</h2>
<form method="post" id="form-reg" action="/reg/handler_reg.php">
<p id="reg_message"></p>

<div id="block-form-registration">
<ul id="form-registration">

<li>
<label>�����:</label>
<span class="star">*</span>
<input type="text" name="reg_login" id="reg_login"/>
</li>

<li>
<label>������:</label>
<span class="star">*</span>
<input type="text" name="reg_pass" id="reg_pass"/>
<span id="gen-pass">�������������</span>
</li>

<li>
<label>�������:</label>
<span class="star">*</span>
<input type="text" name="reg_surname" id="reg_surname"/>
</li>

<li>
<label>���:</label>
<span class="star">*</span>
<input type="text" name="reg_name" id="reg_name"/>
</li>

<li>
<label>��������:</label>
<span class="star">*</span>
<input type="text" name="reg_patronymic" id="reg_patronymic"/>
</li>

<li>
<label>���:</label>
<span class="star">*</span>
<select id="sex" name="sex">
    <option id="sex-m">�������</option>
    <option id="sex-f">�������</option>
</select>
</li>

<li>
<label>E-mail:</label>
<span class="star">*</span>
<input type="text" name="reg_email" id="reg_email"/>
</li>

<li>
<label>��������� �������:</label>
<span class="star">*</span>
<input type="text" name="reg_phone" id="reg_phone"/>
</li>

<li>
<label>����� ��������:</label>
<span class="star">*</span>
<input type="text" name="reg_address" id="reg_address"/>
</li>

<li>
<div id="block-capcha">
<img  src="/reg/reg_capcha.php"/>
<input type="text" name="reg_capcha" id="reg_capcha"/>
<p id="reloadcapcha">��������</p>
</div>
</li>


</ul>


</div>

<p align="right" ><input type="submit" name="reg-submint" id="form_submit" value="�����������" /></p>

</form>
</div>

<?php

    include("include/block-footer.php");
?>

</div>

</body>
</html>