<?php
// Define constants for error messages and product prices/discounts
const QUANTITY_REQUIRED = 'Quantity invullen';
const QUANTITY_INVALID = 'Please enter a valid number';
const PRODUCT_REQUIRED = 'Selecteer een product';
// Product prices and discounts
$products = [
    1 => ['name' => 'Handdoek', 'price' => 22, 'discount' => 0.20],
    2 => ['name' => 'Broek', 'price' => 17, 'discount' => 0.30],
    3 => ['name' => 'Shirt', 'price' => 10, 'discount' => 0.50]
];
$errors = [];
$inputs = [];
$totalPrice = 0;
$selectedProductName = '';
$quantity = 0;
// Check if the form is submitted
if (isset($_POST['send'])) {
    // Validate product selection
    $product = filter_input(INPUT_POST, 'product', FILTER_SANITIZE_NUMBER_INT);
    if (empty($product) || !isset($products[$product])) {
        $errors['product'] = PRODUCT_REQUIRED;
    } else {
        $selectedProductName = $products[$product]['name'];
        $price = $products[$product]['price'];
        $discount = $products[$product]['discount'];
    }
    // Validate quantity
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $quantity = trim($quantity);
    if (empty($quantity)) {
        $errors['quantity'] = QUANTITY_REQUIRED;
    } elseif (!is_numeric($quantity) || $quantity <= 0) {
        $errors['quantity'] = QUANTITY_INVALID;
    }
    // If there are no errors, calculate total price after discount
    if (count($errors) === 0) {
        $discountedPrice = $price - ($price * $discount);  // Calculate price after discount
        $totalPrice = $quantity * $discountedPrice;        // Multiply by quantity
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stappelkorting Calculator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h2>Stappelkorting Calculator</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="n" class="form-label">Welke product wordt er verkocht?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="product" id="product1" value="1" <?php if (isset($_POST['product']) && $_POST['product'] == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="product1">Handdoek (€22 met 20% korting)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="product" id="product2" value="2" <?php if (isset($_POST['product']) && $_POST['product'] == 2) echo 'checked'; ?>>
                <label class="form-check-label" for="product2">Broek (€17 met 30% korting)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="product" id="product3" value="3" <?php if (isset($_POST['product']) && $_POST['product'] == 3) echo 'checked'; ?>>
                <label class="form-check-label" for="product3">Shirt (€10 met 50% korting)</label>
            </div>
            <div class="form-text text-danger">
                <?php echo $errors['product'] ?? ''; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="b">Quantity</label>
            <textarea name="quantity" id="b" class="form-control"><?php echo htmlspecialchars($_POST['quantity'] ?? ''); ?></textarea>
            <div class="form-text text-danger">
                <?php echo $errors['quantity'] ?? ''; ?>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="send" value="verzenden">
    </form>
    <?php if (count($errors) === 0 && isset($_POST['send'])): ?>
        <div class="mt-4">
            <h3>Resultaat</h3>
            <p>Product: <?php echo htmlspecialchars($selectedProductName); ?></p>
            <p>Aantal: <?php echo htmlspecialchars($quantity); ?></p>
            <p>Totaal te betalen prijs: €<?php echo number_format($totalPrice, 2); ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>