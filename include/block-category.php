<!-- Сам блок -->
<div id="block-category">
<!-- Категории -->
<p class="header-title">Категории товаров</p>
<!-- Подразделы -->
<ul>
<li><a id="index1"><img src="/immages/fik-icon.png" id="fik-icon"/>Кровля и фасад</a>
<ul class="category-section">
<li><a href="view_cat.php?type=kif"><strong>Все категории</strong></a></li>

<?php

$result = mysql_query("SELECT * FROM category WHERE type='kif' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>

<li><a id="index2"><img src="/immages/door-icon.png" id="fik-icon"/>Двери</a>
<ul class="category-section">
<li><a href="view_cat.php?type=door" ><strong>Все категории</strong></a></li>

<?php

$result = mysql_query("SELECT * FROM category WHERE type='door' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>


</ul>
</li>

<li><a id="index3"><img src="/immages/wp-icon.png" id="fik-icon"/>Обои</a>
<ul class="category-section">
<li><a href="view_cat.php?type=wallpaper"><strong>Все категории</strong></a></li>
<?php

$result = mysql_query("SELECT * FROM category WHERE type='wallpaper' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>

<li><a id="index3"><img src="/immages/np-icon.png" id="fik-icon"/>Напольные покрытия</a>
<ul class="category-section">
<li><a href="view_cat.php?type=np"><strong>Все категории</strong></a></li>
<?php

$result = mysql_query("SELECT * FROM category WHERE type='np' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>

<li><a id="index3"><img src="/immages/st-icon.png" id="fik-icon"/>Сантехника</a>
<ul class="category-section">
<li><a href="view_cat.php?type=st"><strong>Все категории</strong></a></li>
<?php

$result = mysql_query("SELECT * FROM category WHERE type='st' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>

<li><a id="index3"><img src="/immages/instruments-icon.png" id="fik-icon"/>Инструменты</a>
<ul class="category-section">
<li><a href="view_cat.php?type=instruments"><strong>Все категории</strong></a></li>
<?php

$result = mysql_query("SELECT * FROM category WHERE type='instruments' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>

<li><a id="index3"><img src="/immages/electrical-icon.png" id="fik-icon"/>Электротовары</a>
<ul class="category-section">
<li><a href="view_cat.php?type=electrical"><strong>Все категории</strong></a></li>
<?php

$result = mysql_query("SELECT * FROM category WHERE type='electrical' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>

<li><a id="index3"><img src="/immages/paint-icon.png" id="fik-icon"/>Лакокрасочные покрытия</a>
<ul class="category-section">
<li><a href="view_cat.php?type=paint"><strong>Все категории</strong></a></li>
<?php

$result = mysql_query("SELECT * FROM category WHERE type='paint' ",$link);

if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
    echo '
    
    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
    
    
    
    ';
}
while ($row = mysql_fetch_array($result));   
}

?>

</ul>
</li>


</ul>   <!-- Конец -->

</div>