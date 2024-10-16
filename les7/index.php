<?php
include 'dbconnect.php';
const NAME_REQUIRED = 'Naam invullen';
const REVIEW_REQUIRED = 'Review invullen';
const AGREE_REQUIRED = 'Voorwaarden accepteren';
$errors = [];
$inputs = [];
if (isset($_POST['send'])) {
    // Further code goes here


// sanitize and validate name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $name = trim($name);
    if (empty($name)) {
        $errors['name'] = NAME_REQUIRED;
    } else {
        $inputs['name'] = $name;
    }

// sanitize and validate review
    $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS);
    $review = trim($review);
    if (empty($review)) {
        $errors['review'] = REVIEW_REQUIRED;
    } else {
        $inputs['review'] = $review;
    }

// accept terms
    $agree = filter_input(INPUT_POST, 'agree', FILTER_SANITIZE_SPECIAL_CHARS);
// check against the valid value
    if ($agree === null) {
        $errors['agree'] = AGREE_REQUIRED;
    } else {
        $inputs['agree'] = $agree;
    }

    if (count($errors) === 0) {
        global $db;
        $sth = $db->prepare("INSERT INTO review (name, content) VALUES (:name, :review)");
        $sth->bindParam(':name', $inputs['name']);
        $sth->bindParam(':review', $inputs['review']);
        $result = $sth->execute();
        header("Location: master.php");
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulieren</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h2>Review</h2>
</div>
<form method="post" action="">
    <div class="mb=3">
        <label for="n" class="form-label">Naam</label>
        <input type="text" class="form-control" id="n" name="name"
               value="<?php echo $inputs['name'] ?? ''?>">
                   <div class="form-text text-danger">
                   <?= $errors['name'] ?? '' ?>
                   </div>
    </div>

    <div class="mb-3">
        <label for="b">Review</label>
        <textarea name="review" id="b" class="form-control"><?php echo $inputs['review'] ?? '' ?></textarea>
        <div class="form-text text-danger">
            <?= $errors['review'] ?? '' ?>
        </div>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="a" name="agree" value="agree"
        <?php echo (isset($_POST['agree'])? 'checked="checked"':'') ?>>
        <label class="form-check-label" for="a">accepteer voorwaarden</label>
        <div class="form-text text-danger">
            <?= $errors['agree'] ?? '' ?>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" name="send" value="verzenden">
</form>

