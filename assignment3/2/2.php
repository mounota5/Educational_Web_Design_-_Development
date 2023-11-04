<?php
function sumOfEvenNumbers($numbers) {
    $sum = 0;
    foreach ($numbers as $number) {
        if ($number % 2 === 0) {
            $sum += $number;
        }
    }
    return $sum;
}

// Check if the form is submitted
if (isset($_POST['numbers'])) {
    $inputNumbers = $_POST['numbers'];

    // Split the input string into an array of integers
    $integers = explode(",", $inputNumbers);

    // Remove any leading/trailing whitespaces and filter out non-integer values
    $integers = array_filter(array_map('trim', $integers), 'is_numeric');

    $evenSum = sumOfEvenNumbers($integers);
} else {
    $inputNumbers = '';
    $evenSum = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sum of Even Numbers</title>
</head>
<body>
    <h2>Calculate Sum of Even Numbers</h2>
    <form method="post">
        <label for="numbers">Enter a list of integers (comma-separated):</label>
        <input type="text" id="numbers" name="numbers" value="<?php echo $inputNumbers; ?>" required>
        <input type="submit" value="Calculate">
    </form>

    <?php if ($evenSum > 0) : ?>
    <p>Sum of even numbers in the list is: <?php echo $evenSum; ?></p>
    <?php endif; ?>
</body>
</html>
