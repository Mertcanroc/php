<?php 
try {
    include_once('Fiets.php');
    $db = new PDO("mysql:host=localhost;dbname=fietsenmaker", "root", "");
} catch (PDOException $e) {
    die('Geen database server actief!');
}

if (isset($_POST["submit"])) {
    $query = $db->prepare("DELETE FROM review WHERE id = :id");
    $query->bindparam(":id", $_GET["id"]);
    $query->execute(); 
    header("location:read.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h1>Verwijder rij met nummer
        <?=$_GET['id']?></h1>
        <input type="submit" name="submit" value="delete">
    </form>
    <a href="read.php">terug</a>
</body>
</html>