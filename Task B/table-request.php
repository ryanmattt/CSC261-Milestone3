<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tableName = $conn->real_escape_string($_POST['tableName']);

    $sqlColumns = "SHOW COLUMNS FROM $tableName";
    $resultColumns = $conn->query($sqlColumns);

    if ($resultColumns->num_rows > 0) {
        $columns = array();

        while ($rowColumns = $resultColumns->fetch_assoc()) {
            $columns[] = $rowColumns['Field'];
        }

        $sqlData = "SELECT * FROM $tableName";
        $resultData = $conn->query($sqlData);

        if ($resultData->num_rows > 0) {
            echo "<table border='1' id='mainTable'>";
            
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th>" . $column . "</th>";
            }
            echo "</tr>";   

            while ($rowData = $resultData->fetch_assoc()) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . $rowData[$column] . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }
    } else {
        echo "No columns found for table: $tableName";
    }
} else {
    echo '<form method="post" action="">
            <label for="tableName">Enter Table Name:</label>
            <input type="text" name="tableName" required>
            <button type="submit">Submit</button>
          </form>';
}

$conn->close();
?>
