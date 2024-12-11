<?php
try {
   $db = new PDO("mysql:host=localhost;dbname=fietsenmaker", "root", "");
} catch (PDOException $e) {
   die('Geen database server actief');
}
if (isset($_POST['verzenden'])) {
   $merk = filter_input(INPUT_POST, 'merk', FILTER_SANITIZE_SPECIAL_CHARS);
   $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
   $prijs = filter_input(INPUT_POST, 'prijs', FILTER_VALIDATE_FLOAT);
   $query = $db->prepare("UPDATE review SET merk=:merk, type=:type, prijs=:prijs WHERE id=:id");
   $query->bindParam(':merk', $merk);
   $query->bindParam(':type', $type);
   $query->bindParam(':prijs', $prijs);
   $query->bindParam(':id', $_GET['id']);
   $query->execute();
   header('location:read.php');
} else {
   $query = $db->prepare("SELECT * FROM review WHERE id=:id");
   $query->bindValue(':id', $_GET['id']);
   $query->execute();
   $result = $query->fetch(PDO::FETCH_ASSOC);
   $merk = $result['merk'];
   $type = $result['type'];
   $prijs = $result['prijs'];
}
?>
<!doctype html>
<html lang="en">
<head>
<title>Document</title>
</head>
<body>
<form method="post">
<label>merk</label>
<input type="text" name="merk" value="<?= $merk ?? '' ?>"><br>
<label>type</label>
<input type="text" name="type" value="<?= $type ?? '' ?>"><br>
<label>prijs</label>
<input type="text" name="prijs" value="<?= $prijs ?? '' ?>"><br>
<input type="submit" name="verzenden" value="opslaan">
</form>
</body>
</html>