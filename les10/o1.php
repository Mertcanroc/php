<?php 
session_start();
echo "hoi";
//check of  count var bestaat zo ja +1
if(isset($_SESSION['count'])) {
    $_SESSION['count']++;
} else {
    $_SESSION['count']=1;
}

$count=$_SESSION['count'];
echo "Deze pagina heb je al $count keer bekeken";