<?php
include 'connect.php';

if(isset($_GET['transport_id'])){
    $id = $_GET['transport_id'];
    
    // Validate $id (e.g., check if it is numeric) before proceeding with deletion
    if(!is_numeric($id)) {
        die("Invalid transport ID");
    }

    // Prepare and bind the SQL statement
    $sql = "DELETE FROM Transport WHERE Transport_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if($stmt->execute()){
      //  echo "Deleted successfully";
      header('location:transdisplay.php');

    } else {
        die("Deletion failed: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No transport ID provided";
}

// Close the connection
$conn->close();
?>
