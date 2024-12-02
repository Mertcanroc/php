<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=fietsenmaker", "root", "");
    
    // Check if form is submitted
    if (isset($_POST['verzenden'])) {
        // Sanitize input data
        $merk = filter_input(INPUT_POST, "merk", FILTER_SANITIZE_STRING);
        $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);
        $prijs = filter_input(INPUT_POST, "prijs", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // Prepare the query
        $query = $db->prepare("INSERT INTO fietsen (merk, type, prijs) VALUES (:merk, :type, :prijs)");
        
        // Bind parameters
        $query->bindParam(":merk", $merk);
        $query->bindParam(":type", $type);
        $query->bindParam(":prijs", $prijs);
        
        // Execute and provide feedback
        if ($query->execute()) {
            echo "De nieuwe gegevens zijn toegevoegd";
        } else {
            echo "Er is een fout opgetreden";
        }
    }

} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masterpagina</title>
</head>
<body>
    <form method="post" action="">
        <label>Merk</label>
        <input type="text" name="merk"><br>

        <label>Type</label>
        <input type="text" name="type"><br>

        <label>Prijs</label>
        <input type="text" name="prijs"><br>
        <input> type="Submit" name="Verzenden" value="Opslaan"
    </form>
</body>
</html>