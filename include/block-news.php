<!-- Сам блок -->
<div id="block-news">
<!-- Иконка вверх -->
<center><img id="news-up" src="/immages/icon-up.png" /></center>
<!-- Новости -->
<div id="newsticker">

<ul>  <!-- Начало -->

<?php

    $result = mysql_query("SELECT * FROM news ORDER BY id DESC",$link);
if (mysql_num_rows($result) > 0)
{
   $row = mysql_fetch_array($result);
   
   do
{

    echo '
<li>
<span>'.$row["date"].'</span>
<a href="">'.$row["title"].'</a>
<p>'.$row["text"].'</p>
</li>
';  
   
    
}
 
        while( $row = mysql_fetch_array($result));  
}


?>









</ul>  <!-- Конец -->

</div>

<!-- Иконка вниз -->
<center><img id="news-down" src="/immages/icon-down.png" /></center>


</div>