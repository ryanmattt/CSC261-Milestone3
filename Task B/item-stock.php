<?php
include 'config.php';

function getItems() {
    global $conn;
    $sql = "SELECT DISTINCT Item_Name FROM Item_Category";
    $result = $conn->query($sql);

    $categories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['Item_Name'];
        }
    }

    return $categories;
}

$item_name = "";
$size = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $size = $conn->real_escape_string($_POST['size']);

    if (!empty($item_name)) {
        if(!empty($size))
        {
            $sql = "SELECT Quantity FROM Stock WHERE (Item_Name='$item_name' AND Size='$size')";
        }
        else {
            $sql = "SELECT Quantity FROM Stock WHERE (Item_Name='$item_name')";
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $message = "Quantity: " . $row['Quantity'];
        } else {
            $message = "No stock found for the selected item and size.";
        }
    } else {
        $message = "Please select both item and size.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <iframe id="navbarContainer" src="navbar.html" frameborder="0" width="100%" height="100px"></iframe>
    <div class="container" style="text-align: center;">
        <h1>Check Stock</h1>
         <form action="" method="post">
            
            <label for="item_name">Item:</label>
            <select name="item_name" required>
                <?php
                $items = getItems();
                foreach ($items as $item) {
                    $selected = ($item == $item_name) ? "selected" : "";
                    echo "<option value='$item' $selected>$item</option>";
                }
                ?>
            </select><br><br>


            <label for="size">Size:</label>
            <select name="size">
                <option value="" <?= empty($size) ? "selected" : "" ?>>N/A</option>
                <option value="XSmall" <?= $size == "XSmall" ? "selected" : "" ?>>XSmall</option>
                <option value="Small" <?= $size == "Small" ? "selected" : "" ?>>Small</option>
                <option value="Medium" <?= $size == "Medium" ? "selected" : "" ?>>Medium</option>
                <option value="Large" <?= $size == "Large" ? "selected" : "" ?>>Large</option>
                <option value="XLarge" <?= $size == "XLarge" ? "selected" : "" ?>>XLarge</option>
            </select><br><br>


            <button type="submit">Check Stock</button>
    </form>

    <h2><?php echo $message; ?></h2>

    </div>
</body>
</html>

<?php
$conn->close();
?>
