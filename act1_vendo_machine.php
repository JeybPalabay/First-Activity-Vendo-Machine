<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vendo Machine</title>
</head>
<body>
<h3>Vendo Machine</h3>

	<div style="width: 550px; text-align: left;">
	    <form method="post">
	        <fieldset>
	            <legend>Products:</legend>
	            
	            <label>
	                <input type="checkbox" name="product[]" value="Coke"> Coke - ₱15
	            </label><br>

	            <label>
	                <input type="checkbox" name="product[]" value="Sprite"> Sprite - ₱20
	            </label><br>

	            <label>
	                <input type="checkbox" name="product[]" value="Royal"> Royal - ₱20
	            </label><br>

	            <label>
	                <input type="checkbox" name="product[]" value="Pepsi"> Pepsi - ₱15
	            </label><br>

	            <label>
	                <input type="checkbox" name="product[]" value="Mountain Dew"> Mountain Dew - ₱20
	            </label>

	        </fieldset>

	        <fieldset>
	            <legend>Options:</legend>
	        
	            <label for="size">Size:</label>
	            <select id="size" name="size">
	                <option value="regular">Regular</option>
	                <option value="up-size">Up-Size (add ₱5)</option>
	                <option value="jumbo">Jumbo (add ₱10)</option>
	            </select>
	            
	            <label for="quantity">Quantity:</label>
	            <input type="number" id="quantity" name="quantity" min="0" value="0">
	            <button type="submit" name="btnCheckOut">Check Out</button>

	        </fieldset>

	    </form>
	</div>

<?php
	if (isset($_POST['btnCheckOut'])):

	    $prices = [
	        'Coke' => 15,
	        'Sprite' => 20,
	        'Royal' => 20,
	        'Pepsi' => 15,
	        'Mountain Dew' => 20,
	    ];

	    // Get selected products
	    $selectedProducts = $_POST['product'] ?? [];
	    $size = $_POST['size'];
	    $quantity = (int) $_POST['quantity'];

	    // Check if no products selected and quantity is 0
	    if (empty($selectedProducts) && $quantity === 0) {
	        echo "<hr style='border: 1px solid black;'>";
	        echo "<p>No Selected Item, Try Again.</p>"; 
	    } elseif ($quantity === 0) {
	        echo "<hr style='border: 1px solid black;'>";
	        echo "<p>Please select quantity.</p>"; 
	    } else {
	        $sizeAdjustment = 0;
	        if ($size === 'up-size') {
	            $sizeAdjustment = 5;
	        } elseif ($size === 'jumbo') {
	            $sizeAdjustment = 10;
	        }

	        $totalItems = 0;
	        $totalPrice = 0;
	        
	        echo "<hr>"; 
	        echo "<h4>Purchase Summary:</h4>";
	        echo "<ul>";
	        
	        foreach ($selectedProducts as $product): 
	            $productPrice = $prices[$product];
	            $itemTotal = ($productPrice + $sizeAdjustment) * $quantity;
	            $totalPrice += $itemTotal;
	            $totalItems += $quantity;

	            $quantityText = ($quantity > 1) ? "$quantity pieces of" : "1 piece of";
	            
	            $sizeText = ucfirst($size); 
	            echo "<li>$quantityText $sizeText $product amounting to ₱$itemTotal</li>";
	        endforeach; 

	        echo "</ul>";
	        echo "<p><strong>Total Number of Items:</strong> $totalItems</p>";
	        echo "<p><strong>Total Price:</strong> ₱$totalPrice</p>";
    }
endif; 
?>



</body>
</html>