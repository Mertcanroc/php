<?php
$db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
"root", "");
include_once  "Fiets.php";
$query = $db->prepare('SELECT * FROM review');
$query->execute();
$fietsen = $query->fetchAll(PDO::FETCH_CLASS, 'Fiets');

?>
<!doctype html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<title>Document</title>
</head>
<body>
<div class="container">
<h1>Fietsen CRUD</h1>
<table class="table">
<tr>
<th>merk</th>
<th>type</th>
<th class="text-center">details</th>
<th class="text-center">update</th>
<th class="text-center">delete</th>
</tr>
<?php foreach ($fietsen as $fiets): ?>
<tr>
<td><?= $fiets->merk ?></td>
<td><?= $fiets->type ?></td>
<td class="text-center"><a href="details.php?id=<?= $fiets->id ?>">details</a></td>
<td class="text-center"><a href="update.php?id=<?= $fiets->id ?>">update</a></td>
<td class="text-center"><a href="delete.php?id=<?= $fiets->id ?>">delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<a href="insert.php">insert</a>
</div>
</body>
</html>