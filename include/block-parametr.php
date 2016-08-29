<script type="text/javascript">
$(document).ready(function(){
            $('#blocktrackbar').trackbar({
        onMove : function() {
        document.getElementById("start-price").value = this.leftValue;
        document.getElementById("end-price").value = this.rightValue; 
        },
        width : 160,
        leftLimit : 1000,
        leftValue : <?php

    if ((int)$_GET["start_price"] >= 1000 AND (int)$_GET["start_price"] <= 50000)
    {
        echo (int)$_GET["start_price"];
    }else
    {
      echo "1000";
    }





?>,
        rightLimit : 50000,
        rightValue : <?php

    if ((int)$_GET["end_price"] >= 1000 AND (int)$_GET["end_price"] <= 50000)
    {
        echo (int)$_GET["end_price"];
    }else
    {
      echo "30000";
    }





?>,
        roundUp : 1000 
});    
});
</script>




<!-- Сам блок -->
<div id="block-parametr">

<p class="header-title">Поиск по параметрам</p>
<p class="filter-title">Стоимость</p>
<!-- Фильтр -->
<form method="GET" action="search_filter.php">
<div id="block-input-price">
<ul>
<li><p>от</p></li>
<li><input type="text" id="start-price" name="start_price" value="1000" /></li>
<li><p>до</p></li>
<li><input type="text" id="end-price" name="end_price" value="10000" /></li>
<li><p>тг.</p></li>
</ul>
</div>

<div id="blocktrackbar"></div>

<p class="filter-title">Тип товара:</p>


<ul class="checkbox-brand">
<?php

$result = mysql_query("SELECT * FROM category WHERE id_visiable='0' ",$link);
if (mysql_num_rows($result) > 0)
{
   $row = mysql_fetch_array($result);
   
   do
   {
$check_brand = "";
 if ($_GET["brand"])
 {
   if (in_array($row["id"],$_GET["brand"])) 
   {
    $check_brand = "checked";
   }
 }  
    
    
    
    
    echo '
    
<li><input '.$check_brand.' type="checkbox"name="brand[]" value="'.$row["id"].'" id="checkbrand'.$row["id"].'" /><label for="checkbrand'.$row["id"].'">'.$row["brand"].'</label></li>
    
    ';
    
    
} 
        while( $row = mysql_fetch_array($result));  
}



?>






</ul>
<!-- Кнопка -->
<center><input type="submit" name="submit" id="button-parm-search" value="Поиск"/></center>

</form>

</div>