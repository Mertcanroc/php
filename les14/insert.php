<?php
try {
   include_once('Fiets.php');
   $db = new PDO("mysql:host=localhost;dbname=fietsenmaker", "root", "");
} catch (PDOException $e) {
   die('Geen database server actief!');
}
// Debugging (optional)
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
$errorMerk = "";
$errorType = "";
$errorPrijs = "";
if (isset($_POST["send"])) {
   $merk = filter_input(INPUT_POST, "merk", FILTER_SANITIZE_SPECIAL_CHARS);
   $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
   $prijs = filter_input(INPUT_POST, "prijs", FILTER_VALIDATE_FLOAT);
   if (empty($merk)) {
       $errorMerk = "Merk invullen!";
   }
   if (empty($type)) {
       $errorType = "Type invullen!";
   }
   if ($prijs === false) {
       $errorPrijs = "Prijs invullen!";
   }
   if ($errorMerk == "" && $errorType == "" && $errorPrijs == "") {
       $query = $db->prepare('INSERT INTO review (merk, type, prijs) VALUES (:merk, :type, :prijs)');
       $query->bindParam(':merk', $merk);
       $query->bindParam(':type', $type);
       $query->bindParam(':prijs', $prijs);
       $query->execute();
       header("location:read.php");
   }
}
?>

<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Insert Bike</title>
</head>
<body>
<div class="container">
    <h1>Voeg een Fiets Toe</h1>

    <!-- Form for inserting data -->
    <form method="post">
        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" value="<?= htmlspecialchars($merk ?? '') ?>" required>
            <?php if ($errorMerk): ?>
                <div class="text-danger"><?= $errorMerk ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="<?= htmlspecialchars($type ?? '') ?>" required>
            <?php if ($errorType): ?>
                <div class="text-danger"><?= $errorType ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="prijs" class="form-label">Prijs</label>
            <input type="number" class="form-control" id="prijs" name="prijs" value="<?= htmlspecialchars($prijs ?? '') ?>" step="0.01" required>
            <?php if ($errorPrijs): ?>
                <div class="text-danger"><?= $errorPrijs ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" name="send" class="btn btn-primary">Voeg Fiets Toe</button>
    </form>

    <br>
    <a href="read.php" class="btn btn-secondary">Terug naar Lijst</a>
</div>
</body>
</html>