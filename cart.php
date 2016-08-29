<?php
    include("include/bd-connect.php");
    include("functions/functions.php");
    session_start();
    include("include/auth_cookie.php");
    
    //unset($_SESSION['auth']);
    //setcookie('rememberme','',0,'/');
    $id = clear_string($_GET["id"]);
    $action = clear_string($_GET["action"]);
    
    switch ($action)
    {
        case 'clear':
        $clear = mysql_query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' ",$link);
        break;
        
        case 'delete':
        $delete = mysql_query("DELETE FROM cart WHERE cart_id = '$id'  AND cart_ip = '{$_SERVER['REMOTE_ADDR']}' ",$link);
        break;
    }

?>
<!DOCTYPE html>
<html>

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
    <script type="text/javascript" src="/js/jquery.textchange.js"></script>
    <title>������� �������</title>
</head>

<body >

<div id="block-body" >

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

<?php
    $action = clear_string($_GET["action"]);
    switch($action)
    {
    case 'oneclick':
    echo 
    '
    <div id="block-step">
    <div id="name-step">
    
    <ul>
    <li><a class="active">1. ������� �������</a></li>
    <li><span>&rarr;</span></li>
    <li><a>2. ���������� ����������</a></li>
    <li><span>&rarr;</span></li>
    <li><a>3. ����������</a></li>
    </ul>
    
    </div>
    <p>��� 1 �� 3</p>
    <a href="cart.php?action=clear">��������</a>
    
    </div>
    ';
    
 
    $result = mysql_query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products",$link);
if (mysql_num_rows($result) > 0)
{
   $row = mysql_fetch_array($result);
   echo 
    '
    <div id="header-list-cart">
    
    <div id="head-1">�����������</div>
    <div id="head-2">������������ ������</div>
    <div id="head-3">���-��</div>
    <div id="head-4">����</div>
    
    </div>

    '; 
    
     do
     {
     $int = $row["cart_price"] * $row["cart_count"];
     $all_price = $all_price + $int;
     
    if (strlen($row["image"]) > 0 && file_exists("./uploads_immages/".$row["image"]))
    {
    $img_path = './uploads_immages/'.$row["image"];
    $max_width = 100;
    $max_height = 100;
     list($width,$height) = getimagesize($img_path);
    $ratioh = $max_height/$height;
    $ratiow = $max_width/$width;
    $ratio = min($ratioh, $ratiow); 
    $width = intval($ratio * $width);    
    $height = intval($ratio * $height);      
    }else
    {
    $img_path = "/immages/no-image.png"; 
    $width = 100;
    $height =  100; 
    } 
     
    echo
    '
    <div class="block-list-cart">
    
    <div class="img-cart">
    <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></p>
    </div>
    
    <div class="title-cart">
    <p><a href="">'.$row["title"].'</a></p>
    <p class="cart-mini_features">'.$row["mini_features"].'</p>
    </div>
    
    <div class="count-cart">
    <ul class="input-count-style">
    
    <li>
    <p align="center" class="count-minus">-</p>
    </li>
    
    <li>
    <p align="center" ><input class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
    </li>
    
     <li>
    <p align="center" class="count-plus">+</p>
    </li>
    
    </ul>
    </div>
    
    <div class="price-product"><h5><span class="span-count">1<span> x <span>'.$row["cart_price"].'</span></h5><p>'.$int.'</p></div>
    <div class="delete-cart"><a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="immages/delete-icon.png"/></a></div>
    
    <div class="bottom-cart-line"></div>
    </div>
    
    ';
     }
     
     while( $row = mysql_fetch_array($result));
     
     echo 
     '
     <h2 class="itog-price" align="right">�����: <strong>'.$all_price.'</strong>��.</h2>
     <p align="right" class="button-next"><a href="cart.php?action=confirm">�����</a></p>
     ';
     }else
     {
        echo
        '
        <h3 id="clear-cart" align="center">������� �����</h3>
        ';
     }

    break;
    
    case 'confirm':
    echo 
    '
    <div id="block-step">
    <div id="name-step">
    
    <ul>
    <li><a >1. ������� �������</a></li>
    <li><span>&rarr;</span></li>
    <li><a class="active">2. ���������� ����������</a></li>
    <li><span>&rarr;</span></li>
    <li><a>3. ����������</a></li>
    </ul>
    
    </div>
    <p>��� 2 �� 3</p>
    <a href="cart.php?action=clear">��������</a>
    
    </div>
    ';
    
    if ($_SESSION['order_delivery'] == "�� �����")  $chck1 = "checked";
    if ($_SESSION['order_delivery'] == "��������")  $chck2 = "checked";
    if ($_SESSION['order_delivery'] == "���������")  $chck3 = "checked";
    
    echo '
    
    <h3 class="h3-title">������� ��������:</h3>
    <form method="post" id="form-reg" action="/reg/handler_reg.php">
    <p id="reg_message"></p>
    <ul id="info-radio">
    
    <li>
    <input type="radio" class="order_delivery" id="order_delivery1" name="order_delivery" value="�� �����" '.$chck1.'/>
    <label class="l_delivery" for="order_delivery1">�� �����</label>
    </li>
    
    <li>
    <input type="radio" class="order_delivery" id="order_delivery2" name="order_delivery" value="��������" '.$chck2.'/>
    <label class="l_delivery" for="order_delivery2">��������</label>
    </li>
    
    <li>
    <input type="radio" class="order_delivery" id="order_delivery3" name="order_delivery" value="���������" '.$chck3.'/>
    <label class="l_delivery" for="order_delivery3">���������</label>
    </li>
    
    </ul>
    <h3 class="title-h3">���������� ��� ��������:<h3>
    <ul id="info-order">
    ';
     if ($_SESSION['auth'] != 'yes_auth')
     {
      echo '
    <li><label for="order-fio"><span>*</span>���</label><input type="text" name="order-fio" id="order-fio" value="'.$_SESSION["order-fio"].'" /><span class="order_span_style">������: ���� ������ ��������</span></li>  
    <li><label for="order-email"><span>*</span>E-mail</label><input type="text" name="order-email" id="order-email" value="'.$_SESSION["order-email"].'" /><span class="order_span_style">������: ivanov@mail.ru</span></li> 
    <li><label for="order-phone"><span>*</span>�������</label><input type="text" name="order-phone" id="order-phone" value="'.$_SESSION["order-phone"].'" /><span class="order_span_style">������: +77478055429</span></li> 
    <li><label class="order-l-style" for="order-address"><span>*</span>�����</br>��������</label><input type="text" name="order-address" id="order-address" value="'.$_SESSION["order-address"].'" /><span class="order_span_style">������: �.��������,��.���������� 34, ��. 48</span></li> 
    
    '; 
     }
     echo 
     '
     <li><label class="order-l-style" for="order-note">����������</label><textarea name="order-note">'.$_SESSION["order-note"].'</textarea><span>������: �������� ���������� � ������.</span></li>  
    </ul> 
    <p align="right"><input type="submit" name="submitdata" id="confirm-button-next" value="�����"/></p>
    
    </form>
     ';

    break;
    
    case 'completion':
    echo 
    '
    <div id="block-step">
    <div id="name-step">
    
    <ul>
    <li><a >1. ������� �������</a></li>
    <li><span>&rarr;</span></li>
    <li><a>2. ���������� ����������</a></li>
    <li><span>&rarr;</span></li>
    <li><a class="active">3. ����������</a></li>
    </ul>
    
    </div>
    <p>��� 3 �� 3</p>
    <a href="cart.php?action=clear">��������</a>
    
    </div>
    ';
    break;
    
    default:
    echo 
    '
    <div id="block-step">
    <div id="name-step">
    
    <ul>
    <li><a class="active">1. ������� �������</a></li>
    <li><span>&rarr;</span></li>
    <li><a>2. ���������� ����������</a></li>
    <li><span>&rarr;</span></li>
    <li><a>3. ����������</a></li>
    </ul>
    
    </div>
    <p>��� 1 �� 3</p>
    <a href="cart.php?action=clear">��������</a>
    
    </div>
    ';
    
 
    $result = mysql_query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products",$link);
if (mysql_num_rows($result) > 0)
{
   $row = mysql_fetch_array($result);
   echo 
    '
    <div id="header-list-cart">
    
    <div id="head-1">�����������</div>
    <div id="head-2">������������ ������</div>
    <div id="head-3">���-��</div>
    <div id="head-4">����</div>
    
    </div>

    '; 
    
     do
     {
     $int = $row["cart_price"] * $row["cart_count"];
     $all_price = $all_price + $int;
     
    if (strlen($row["image"]) > 0 && file_exists("./uploads_immages/".$row["image"]))
    {
    $img_path = './uploads_immages/'.$row["image"];
    $max_width = 100;
    $max_height = 100;
     list($width,$height) = getimagesize($img_path);
    $ratioh = $max_height/$height;
    $ratiow = $max_width/$width;
    $ratio = min($ratioh, $ratiow); 
    $width = intval($ratio * $width);    
    $height = intval($ratio * $height);      
    }else
    {
    $img_path = "/immages/no-image.png"; 
    $width = 100;
    $height =  100; 
    } 
     
    echo
    '
    <div class="block-list-cart">
    
    <div class="img-cart">
    <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></p>
    </div>
    
    <div class="title-cart">
    <p><a href="">'.$row["title"].'</a></p>
    <p class="cart-mini_features">'.$row["mini_features"].'</p>
    </div>
    
    <div class="count-cart">
    <ul class="input-count-style">
    
    <li>
    <p align="center" class="count-minus">-</p>
    </li>
    
    <li>
    <p align="center" ><input class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
    </li>
    
     <li>
    <p align="center" class="count-plus">+</p>
    </li>
    
    </ul>
    </div>
    
    <div class="price-product"><h5><span class="span-count">1<span> x <span>'.$row["cart_price"].'</span></h5><p>'.$int.'</p></div>
    <div class="delete-cart"><a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="immages/delete-icon.png"/></a></div>
    
    <div class="bottom-cart-line"></div>
    </div>
    
    ';
     }
     
     while( $row = mysql_fetch_array($result));
     
     echo 
     '
     <h2 class="itog-price" align="right">�����: <strong>'.$all_price.'</strong>��.</h2>
     <p align="right" class="button-next"><a href="cart.php?action=confirm">�����</a></p>
     ';
     }else
     {
        echo
        '
        <h3 id="clear-cart" align="center">������� �����</h3>
        ';
     }
    break;
 
    }


?>

</div>

<?php

    include("include/block-footer.php");
?>

</div>

</body>
</html>