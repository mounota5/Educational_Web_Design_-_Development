<?php
$numbers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numbersInput = $_POST['numbers'];
    $numbers = array_map('intval', explode(',', $numbersInput));

    if (empty($numbers)) {
        $error_message = "Please enter at least one number.";
    } else {
        $firstElement = reset($numbers);
        $lastElement = end($numbers);
        $numbers[] = 12; // Add 12 to the end of the array
        $sum = array_sum($numbers);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Array Operations</title>
</head>
<body>
    <h2>Array Operations</h2>
    <form method="post">
        <label for="numbers">Enter an array of integers (comma-separated):</label>
        <input type="text" id="numbers" name="numbers" value="<?php echo implode(',', $numbers); ?>">
        <input type="submit" value="Perform Tasks">
    </form>

    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <h3>Results:</h3>
        <p>i. First element of the array: <?php echo $firstElement; ?></p>
        <p>ii. Last element of the array: <?php echo $lastElement; ?></p>
        <p>iii. Array with 12 added to the end: <?php echo implode(',', $numbers); ?></p>
        <p>iv. Sum of all elements: <?php echo $sum; ?></p>
    <?php endif; ?>
</body>
</html>
