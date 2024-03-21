<?php
// Include the file with your database connection details
include 'connect.php';

// Check if employee_id1 is provided in the URL
if(isset($_GET['employee_id1'])) {
    // Retrieve the employee ID from the URL
    $id = $_GET['employee_id1'];

    // Fetch employee details based on the employee ID
    $sql = "SELECT * FROM Employee WHERE Employee_ID = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Check if the form is submitted
    if(isset($_POST['submit'])){
        $id = mysqli_real_escape_string($conn, $_POST['Employee_ID']);
        $ad_id = mysqli_real_escape_string($conn, $_POST['Admin_ID']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);   
        $position = mysqli_real_escape_string($conn, $_POST['position']);

        // SQL query to update data in the database
        $sql = "UPDATE Employee SET Admin_ID='$ad_id', EName='$name', Position='$position' WHERE Employee_ID=$id";
        
        // Perform the query
        $result = mysqli_query($conn, $sql);
        
        if($result){
            // Redirect to the display page after update
            header('location:empdisplay.php');
        } else {
            echo "Data not updated successfully";
        }
    }
} else {
    echo "Employee ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="Employee">
        <h1>Edit Employee Details</h1>
        <?php if(isset($row)) : ?>
        <form method="post">
            <label for="Employee_ID">Employee_ID:</label>
            <input type="number" id="Employee_ID" name="Employee_ID" value="<?php echo $row['Employee_ID']; ?>"><br><br>
            <label for="Admin_ID">Admin_ID:</label>
            <input type="number" id="Admin_ID" name="Admin_ID" value="<?php echo $row['Admin_ID']; ?>"><br><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['EName']; ?>"><br><br>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="<?php echo $row['Position']; ?>"><br><br>
            <button type="submit" class="btn-primary" name="submit">Update</button>
        </form>
        <?php else : ?>
        <p>No Employee details found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
