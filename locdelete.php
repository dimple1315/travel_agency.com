<?php

include 'connect.php';

if(isset($_GET['vehicle_ID'])) {

    $vehicle_id = $_GET['vehicle_ID'];
    $sql = "DELETE FROM `location` WHERE vehicle_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vehicle_id);

    if($stmt->execute()){
        header('location:locdisplay.php');

        exit();
    } else {
        echo "Error deleting location: " . $stmt->error;
        
    }
} else {
    echo "Location ID not provided.";
}

$conn->close();
?>
