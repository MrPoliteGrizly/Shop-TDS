<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" )
{
   session_start();
    if($_SESSION['img_capcha'] == strtolower($_POST['reg_capcha']))
    {
        echo 'true';
    } else { echo 'false'; }
}

?>