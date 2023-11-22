<?php
include 'config.php';

function getCategories() {
    global $conn;
    $sql = "SELECT DISTINCT Category FROM Item_Category";
    $result = $conn->query($sql);

    $categories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['Category'];
        }
    }

    return $categories;
}

function getItemsByCategory($category) {
    global $conn;
    $sql = "SELECT Item_Name FROM Item_Category WHERE Category = '$category'";
    $result = $conn->query($sql);

    $items = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row['Item_Name'];
        }
    }

    return $items;
}

function insertSale($id, $item, $size, $quantity) {
    global $conn;
    $sql = "INSERT INTO Sales (ID, Item_Name, Size, Quantity) VALUES ('$id', '$item', '$size', '$quantity')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sale recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $category = $_POST["merch_category"];
    $item = $_POST["merch_item"];
    $size = $_POST["size"];
    $quantity = $_POST["quantity"];

    insertSale($id, $item, $size, $quantity);
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
    <iframe id="navbarContainer" src="navbar.html" frameborder="0" width="100%" height="50px"></iframe>
    <div class="container">
        <h1>Sale Form</h1>
         <form method="post" action="sale.php">
            
            <label for="merch_category">Merch Category:</label>
            <select name="merch_category" required>
                <?php
                $categories = getCategories();
                foreach ($categories as $category) {
                    echo "<option value='$category'>$category</option>";
                }

                $selectedCategory = $_POST["merch_category"];
               
            echo "</select><br><br>

            <label for=\"item\">Item Name:</label>
                <select name=\"item\" required>";
                
                    $items = getItemsByCategory($selectedCategory);
                    foreach ($items as $itemOption) {
                        echo "<option value='$itemOption'>$itemOption</option>";
                    }
                    echo "<option value='test'>test</option>";
                echo "</select><br><br>";x
                    ?>



            <label for="size">Size:</label>
            <select name="size" required>
                <option value="">N/A</option>
                <option value="XSmall">XSmall</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="XLarge">XLarge</option>
            </select><br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" required><br><br>

            <button type="submit">Check-in Attendee</button>
    </form>

    <h2><?php echo $message; ?></h2>
    </div>
</body>
</html>

<?php
$conn->close();
?>
