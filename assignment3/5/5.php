<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    $sum = $num1 + $num2;
    $difference = $num1 - $num2;
    $product = $num1 * $num2;

    if ($num2 != 0) {
        $quotient = $num1 / $num2;
    } else {
        $quotient = "Undefined (division by zero)";
    }
} else {
    $num1 = '';
    $num2 = '';
    $sum = '';
    $difference = '';
    $product = '';
    $quotient = '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h2>Calculator</h2>
    <form method="post">
        <label for="num1">Enter the first number:</label>
        <input type="number" id="num1" name="num1" value="<?php echo $num1; ?>" required><br>

        <label for="num2">Enter the second number:</label>
        <input type="number" id="num2" name="num2" value="<?php echo $num2; ?>" required><br>

        <input type="submit" value="Calculate">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
    <h3>Results:</h3>
    <p>Sum: <?php echo $sum; ?></p>
    <p>Difference: <?php echo $difference; ?></p>
    <p>Product: <?php echo $product; ?></p>
    <p>Quotient: <?php echo $quotient; ?></p>
    <?php endif; ?>
</body>
</html>
