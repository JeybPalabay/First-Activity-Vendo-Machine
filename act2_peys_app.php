<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
</head>
<body>
    <h3>Peys App</h3>
    <form method="POST" action="">
        <label for="sizeRange">Select Photo Size: </label>
        <input type="range" id="sizeRange" name="sizeRange" min="100" max="200" value="<?php echo isset($_POST['reset']) ? '160' : (isset($_POST['sizeRange']) ? $_POST['sizeRange'] : '160'); ?>" step="10">
        <br><br>

        <label for="slcBorderColor">Select Border Color:</label>
        <input type="color" id="slcBorderColor" name="slcBorderColor" value="<?php echo isset($_POST['reset']) ? '#000000' : (isset($_POST['slcBorderColor']) ? $_POST['slcBorderColor'] : '#000000'); ?>">
        <br><br>

        <button type="submit" name="process">Process</button>
        <input type="hidden" name="reset" value="1">
    </form>

    <br>

    <?php
        // Set values for size and border color, using submitted values or defaults
        $sizeRange = isset($_POST['sizeRange']) ? intval($_POST['sizeRange']) : 160;
        $borderColor = isset($_POST['slcBorderColor']) ? htmlspecialchars($_POST['slcBorderColor']) : '#000000';

        // Reset form values to defaults after applying changes
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['process'])) {
            $_POST['sizeRange'] = 160;
            $_POST['slcBorderColor'] = '#000000';
        }
    ?>

    <!-- Image Preview with inline styles -->
    <img id="preview" src="Profile_pic.jpg" alt="Image Preview" 
         style="display: block; margin-top: 20px; margin-left: 20px; width: <?php echo $sizeRange; ?>px; border: 5px solid <?php echo $borderColor; ?>;">
</body>
</html>
