<?php
// Include the file with your database connection details
include 'connect.php';

// Check if Schedule_id is provided in the URL
if(isset($_GET['Schedule_id'])) {
    // Retrieve the Schedule_id from the URL
    $id = $_GET['Schedule_id'];

    // Prepare a DELETE statement
    $sql = "DELETE FROM schedule WHERE Schedule_ID = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement";
        exit;
    }

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the display page after deletion
        header('Location: schdisplay.php');
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
} else {
    echo "Schedule ID not provided.";
}
?>
