<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Formulieren</title>
</head>
<body>
<h2>Review</h2>

<div>
<form method="post" action=""
class="mb-3">
    <label for="b" >Bedrag excl btw</label>
    <input type="text" class="form-control" id="n" name="naam">
</div>

<div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
    <label class="form-check-label" for="flexRadioDefault1">
        laag 9%
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
    <label class="form-check-label" for="flexRadioDefault2">
        Hoog 21%
    </label>
</div>


<input type="submit" class="btn btn-primary" name="verzenden" value="verzenden"> </form>

</form>
</body>
</html>

<?php
if (isset($_POST['verzenden'])) {
    // Sanitize the input
    $name = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_SPECIAL_CHARS);
    $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
    $btwPercentage = filter_input(INPUT_POST, 'btw', FILTER_VALIDATE_INT);
    // Calculate VAT
    if ($amount && $btwPercentage) {
        $btwAmount = $amount * ($btwPercentage / 100);
        $total = $amount + $btwAmount;
        echo "Het formulier is verzonden!<br>";
        echo "Naam: " . $name . "<br>";
        echo "Bedrag excl. btw: €" . number_format($amount, 2, ',', '.') . "<br>";
        echo "BTW (" . $btwPercentage . "%): €" . number_format($btwAmount, 2, ',', '.') . "<br>";
        echo "Totaal: €" . number_format($total, 2, ',', '.') . "<br>";
    } else {
        echo "Ongeldige invoer.";
    }
}
?>
