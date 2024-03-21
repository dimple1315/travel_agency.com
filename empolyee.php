<?php
// Include the file with your database connection details
include 'connect.php';

// Check if the form is submitted
if(isset($_POST['submit'])){
    $id = $_POST['Employee_ID'];
    $ad_id = $_POST['Admin_ID'];  // Corrected field name
    $name = $_POST['name'];
    $position = $_POST['position'];

      // Check if the Transport_ID exists in the Transport table
      $check_sql = "SELECT * FROM `Admin` WHERE Admin_ID = ?";
      $check_stmt = $conn->prepare($check_sql);
      $check_stmt->bind_param("i", $ad_id);
      $check_stmt->execute();
      $result = $check_stmt->get_result();
      if($result->num_rows === 0) {
          echo "Admin_ID does not exist. Please provide a valid Admin_ID.";
          exit;
      }

    // SQL query to insert data into the database
    $sql = "INSERT INTO Employee (Employee_ID, Admin_ID, EName, Position) VALUES ('$id', '$ad_id', '$name', '$position')";

    // Perform the query
    $result = mysqli_query($conn, $sql);
    if($result){
        //echo "Data inserted successfully";
        header('location:empdisplay.php');
    } else {
        // echo mysqli_error($conn);
        echo "Data not inserted successfully";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="Employee">
        <h1>Add Employee Details</h1>
        <form  method="post">
            <label for="Employee_ID">Employee_ID:</label>
            <input type="number" id="Employee_ID" name="Employee_ID" ><br><br>
            <label for="Admin_ID">Admin_ID:</label>
            <input type="number" id="Admin_ID" name="Admin_ID" ><br><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" ><br><br>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position"><br><br>
            <button type="submit" class="btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
