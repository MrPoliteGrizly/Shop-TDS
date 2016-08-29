<?php
    include("include/bd-connect.php");
    include("functions/functions.php");
    session_start();
    include("include/auth_cookie.php");


$cat = clear_string($_GET["cat"]);
$type = clear_string($_GET["type"]);


$sorting = $_GET["sort"];

switch($sorting)
{
   case 'price-asc';
   $sorting = 'price ASC';
   $sort_name = 'От дешевых к дорогим';
   break;
  
   case 'price-desc';
   $sorting = 'price DESC';
   $sort_name = 'От дорогих к дешевым';
   break;  
   
   case 'popular';
   $sorting = 'price DESC';
   $sort_name = 'Популярное';
   break; 

   case 'news';
   $sorting = 'datetime DESC';
   $sort_name = 'Новинки';
   break; 

   case 'brand';
   $sorting = 'brand';
   $sort_name = 'От А до Я';
   break; 

    default:
    $sorting = 'products_id DESC';
    $sort_name = 'Нет сортировки';
    break;
}   




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
    <script type="text/javascript" src="/js/jquery.textchange.js"></script>
    <title>Интернет-магазин стройматериалов</title>
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



<?php

    if (!empty($cat) && !empty($type))
    {
       $querycat = "AND brand = '$cat' AND type_tovara = '$type'";
       $catlink = "cat= $cat & ";
        
    }else
    {
        if(!empty($type))
        {
          $querycat = "AND type_tovara = '$type' ";
             
        }else
        {
          $querycat = ""; 
        }
        
        if(!empty($cat))
        {
          $catlink = "cat= $cat & ";
             
        }else
        {
          $catlink = ""; 
        }
    
    
    }

$num = 8; // !!!
    $page = (int)$_GET['page'];
    
    $count = mysql_query("SELECT COUNT(*) FROM table_products WHERE visible='1' $querycat", $link);
    $temp = mysql_fetch_array($count);
    
    If ($temp[0] > 0)
    {
       $tempcount =  $temp[0];
       
       $total = (($tempcount - 1) / $num) + 1;
       $total = intval($total);
       
       $page = intval($page);
       
       if (empty($page) or $page < 0) $page = 1;
        if ($page > $total) $page = $total;
        
       
    $start = $page * $num - $num;
    $query_start_num = "LIMIT $start, $num";
    } 


    $result = mysql_query("SELECT * FROM table_products WHERE visible='1'  $querycat ORDER BY $sorting $query_start_num",$link);
if (mysql_num_rows($result) > 0)
{
   $row = mysql_fetch_array($result);
   echo '
   
   <div id="block-sorting">
<p id="nav-breadcrumbs"><a href="index.php">Главная страница</a> / <span>Все товары</span></p>
<ul id="option-list">
<li>Вид: </li>
<li><img id="style-grid" src="/immages/grid-red.png" /></li>
<li><img id="style-list" src="/immages/list.png" /></li>

<li>Сортировать</li>
<li><a id="select-sort"> '.$sort_name.' </a>
<ul id="sorting-list">
<li><a href="view_cat.php?'.$catlink.'type='.$type.' &sort=price-asc">От дешевых к дорогим</a></li>
<li><a href="view_cat.php?'.$catlink.'type='.$type.' &sort=price-desc">От дорогих к дешевым</a></li>
<li><a href="view_cat.php?'.$catlink.'type='.$type.' &sort=popular">Популярное</a></li>
<li><a href="view_cat.php?'.$catlink.'type='.$type.' &sort=news">Новинки</a></li>
<li><a href="view_cat.php?'.$catlink.'type='.$type.' &sort=brand">От А до Я</a></li>
</ul>
</li>
</ul>
</div>
   
<ul id="block-tovar-grid">
   
   
   ';
   do
   {
    
if ($row["image"] != "" && file_exists("./uploads_immages/".$row["image"]))
{
$img_path = './uploads_immages/'.$row["image"];
$max_width = 110;
$max_height = 110;
 list($width,$height) = getimagesize($img_path);
$ratioh = $max_height/$height;
$ratiow = $max_width/$width;
$ratio = min($ratioh, $ratiow); 
$width = intval($ratio * $width);    
$height = intval($ratio * $height);      
} else
{
$img_path = "/immages/no-image.png"; 
$width = 200;
$height =  200;   
}    
    
    echo'
    
    <li>
    <div class="block-immages-grid">
    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/>
    </div>
    <p class="style-title-grid" ><a href="">'.$row["title"].'</a></p>
    <ul class="revies-and-counts-grid">
    <li><img src="/immages/eye-icon.png"/><p>0</p></li>
    <li><img src="/immages/comment-icon.png"/><p>0</p></li>
    </ul>
    <a class="add-cart-style-grid"></a>
    <p class="style-price-grid" ><strong>'.$row["price"].'</strong> тнг. </p>
    <div class="mini-fetures">
    '.$row["mini_features"].'
    </div>
    </li>
    
    ';
   } 
        while( $row = mysql_fetch_array($result));  





?>
</ul>

<ul id="block-tovar-list">
<?php
    $result = mysql_query("SELECT * FROM table_products WHERE visible='1' $querycat ORDER BY $sorting $query_start_num ",$link);
if (mysql_num_rows($result) > 0)
{
   $row = mysql_fetch_array($result);
   
   do
   {
    
if ($row["image"] != "" && file_exists("./uploads_immages/".$row["image"]))
{
$img_path = './uploads_immages/'.$row["image"];
$max_width = 150;
$max_height = 150;
 list($width,$height) = getimagesize($img_path);
$ratioh = $max_height/$height;
$ratiow = $max_width/$width;
$ratio = min($ratioh, $ratiow); 
$width = intval($ratio * $width);    
$height = intval($ratio * $height);      
} else
{
$img_path = "/immages/no-image-list.png"; 
$width = 80;
$height =  70;   
}    
    
    echo'
    
    <li>
    <div class="block-immages-list">
    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/>
    </div>

    <ul class="revies-and-counts-list">
    <li><img src="/immages/eye-icon.png"/><p>0</p></li>
    <li><img src="/immages/comment-icon.png"/><p>0</p></li>
    </ul>
    
    <p class="style-title-list" ><a href="">'.$row["title"].'</a></p>
    
    <a class="add-cart-style-list"></a>
    <p class="style-price-list" ><strong>'.$row["price"].'</strong> тнг. </p>
    <div class="style-text-list">
    '.$row["mini_description"].'
    </div>
    </li>
    
    ';
   } 
        while( $row = mysql_fetch_array($result));  
}
}else
{
    echo '<h3>Категория не доступна или не создана!</3>';
}

echo '</ul>';


if ($page != 1) { $pstr_prev = '<li><a class="pstr_prev" href="view_cat.php?page='.($page - 1).'">&lt;</a></li>';}
if ($page != $total)  $pstr_next = '<li><a class="pstr_next" href="view_cat.php?page='.($page + 1).'">&gt;</a></li>';

if ($page - 5 > 0)  $page5left = '<li><a  href="view_cat.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
if ($page - 4 > 0)  $page4left = '<li><a  href="view_cat.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
if ($page - 3 > 0)  $page3left = '<li><a  href="view_cat.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
if ($page - 2 > 0)  $page2left = '<li><a  href="view_cat.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
if ($page - 1 > 0)  $page1left = '<li><a  href="view_cat.php?page='.($page - 1).'">'.($page - 1).'</a></li>';


if ($page + 5 <= $total)  $page5right = '<li><a  href="view_cat.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
if ($page + 4 <= $total)  $page4right = '<li><a  href="view_cat.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
if ($page + 3 <= $total)  $page3right = '<li><a  href="view_cat.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
if ($page + 2 <= $total)  $page2right = '<li><a  href="view_cat.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
if ($page + 1 <= $total)  $page1right = '<li><a  href="view_cat.php?page='.($page + 1).'">'.($page + 1).'</a></li>';

 if ($page + 5 < $total )
 {
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="view_cat.php?page='.$total.'">'.$total.'</a></li>';
 }else
 {
    $strtotal = "";
 }
 
 if ($total > 1)
 {
    echo '
    <div class="pstrnav">
    <ul>
    ';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='view_cat.php?page=".$page."' >".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$pstr_next;
    echo'
    </ul>
    </div>
    ';
    
    
 }


?>




</div>

<?php

    include("include/block-footer.php");
?>

</div>

</body>
</html>