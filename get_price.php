<?php
// Assuming you have established a database connection using mysqli and $conn is available in this file
include("includes/db_connect.php"); // Include the file with the database connection

// Check if the 'gift' parameter is set in the GET request
if (isset($_GET['gift'])) {
    $selectedProduct = $_GET['gift'];

    try {
        // Perform a database query to fetch the price from the "toys" table based on the selected product label
        $sql = "SELECT GiftPrice FROM iybigiftinventory WHERE GiftId = ?";
        $stmt = $conn->prepare($sql);
        //echo "<br>$sql<br>";
        if ($stmt === false) {
            throw new Exception('Error preparing the SQL query.');
        }

        $stmt->bind_param("i", $selectedProduct); // Bind the parameter to the statement
        $stmt->execute();

        // Fetch the price from the query result
        $stmt->bind_result($price);
        $stmt->fetch();

        // Return the price as the response to the AJAX request
        echo $price;
    } catch (Exception $e) {
        // Handle the exception (display an error message, log, etc.)
        echo 'Error: ' . $e->getMessage();
    }
}
?>
