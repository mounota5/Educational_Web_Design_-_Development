<?php
function countVowels($str) {
    $str = strtolower($str); // Convert the input string to lowercase for case-insensitive matching
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $count = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        if (in_array($str[$i], $vowels)) {
            $count++;
        }
    }

    return $count;
}

if (isset($_POST['input_string'])) {
    $inputString = $_POST['input_string'];
    $vowelCount = countVowels($inputString);
} else {
    $inputString = '';
    $vowelCount = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Count Vowels in a String</title>
</head>
<body>
    <h2>Count Vowels in a String</h2>
    <form method="post">
        <label for="input_string">Enter a string:</label>
        <input type="text" id="input_string" name="input_string" value="<?php echo $inputString; ?>" required>
        <input type="submit" value="Count Vowels">
    </form>

    <?php if ($vowelCount > 0) : ?>
    <p>Number of vowels in the string: <?php echo $vowelCount; ?></p>
    <?php endif; ?>
</body>
</html>
