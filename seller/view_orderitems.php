

<?php
    include "connection.php"; // Include your database connection file

    // Get the order ID from the AJAX request
    $orderID = $_GET['orderID'];

    // Query to retrieve the items in the specified order
    $sql = "SELECT * FROM orderitem WHERE orderID = $orderID";
    $result = $conn->query($sql);

    // Check if there are any items
    if ($result->num_rows > 0) {
        $items = array();

        // Fetch items and store them in an array
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        // Return the items as a JSON response
        echo json_encode($items);
    } else {
        // No items found for the specified order
        echo json_encode(array('message' => 'No items found for the order.'));
    }
    
    // Close the database connection
    $conn->close();
?>
