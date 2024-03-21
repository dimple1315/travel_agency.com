<?php
// Include the file with your database connection details
include 'connect.php';

// Check if Schedule_id1 is provided in the URL
if(isset($_GET['Schedule_id1'])) {
    // Retrieve the Schedule ID from the URL
    $id = $_GET['Schedule_id1'];

    // Fetch schedule details based on the Schedule ID
    $sql = "SELECT * FROM Schedule WHERE Schedule_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the form is submitted
    if(isset($_POST['submit'])){
        $date = $_POST['SDate'];
        $schedule_id = $_POST['Schedule_ID'];
        $transport_id = $_POST['Transport_ID'];
        $employee_id = $_POST['Employee_ID']; 
        $source_Time = $_POST['source_Time'];
        $destination_Time = $_POST['destination_Time'];

        // SQL query to update data in the database
        $sql = "UPDATE Schedule SET SDate=?, Schedule_ID=?, Transport_ID=?, Employee_ID=?, source_Time=?, destination_Time=? WHERE Schedule_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiissi", $date, $schedule_id, $transport_id, $employee_id, $source_Time, $destination_Time, $id);
        
        // Perform the query
        if($stmt->execute()){
            // Redirect to the display page after update
            header('location:schdisplay.php');
            exit();
        } else {
            echo "Data not updated successfully";
        }
    }
} else {
    echo "Schedule ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="container">
        <h1>Edit Schedule Details</h1>
        
        <?php if(isset($row)) : ?>
        <form method="post">
            <label for="SDate">Date:</label>
            <input type="date" id="SDate" name="SDate" value="<?php echo $row['SDate']; ?>"><br><br>
            <label for="Schedule_ID">Schedule ID:</label>
            <input type="number" id="Schedule_ID" name="Schedule_ID" value="<?php echo $row['Schedule_ID']; ?>"><br><br>
            <label for="Transport_ID">Transport ID:</label>
            <input type="number" id="Transport_ID" name="Transport_ID" value="<?php echo $row['Transport_ID']; ?>"><br><br>
            <label for="Employee_ID">Employee ID:</label>
            <input type="number" id="Employee_ID" name="Employee_ID" value="<?php echo $row['Employee_ID']; ?>"><br><br>
            <label for="source_Time">Arrival Time:</label>
            <input type="time" id="source_Time" name="source_Time" value="<?php echo $row['source_Time']; ?>"><br><br>
            <label for="destination_Time">Departure Time:</label>
            <input type="time" id="destination_Time" name="destination_Time" value="<?php echo $row['destination_Time']; ?>"><br><br>
            <button type="submit" class="btn-primary" name="submit">Update</button>
        </form>
        <?php else : ?>
        <p>No schedule details found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
