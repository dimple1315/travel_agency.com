<?php
// Include the file with your database connection details
include 'connect.php';

// Check if the Employee_id is provided in the URL
if(isset($_GET['employee_id'])) {
    // Sanitize the input to prevent SQL injection
    $employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);

    // Prepare and bind the SQL statement
    $sql = "DELETE FROM Employee WHERE Employee_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employee_id);

    // Execute the statement
    if($stmt->execute()){
        // Check if any rows were affected
        if($stmt->affected_rows > 0) {
            // Redirect to empdisplay.php if deletion was successful
            header('location:empdisplay.php');
            exit(); // Ensure no further code execution after redirect
        } else {
            echo "No employee with the provided ID exists.";
        }
    } else {
        echo "Deletion failed: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No Employee ID provided";
}

// Close the connection
$conn->close();
?>
