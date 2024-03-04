<?php
include 'database.php';

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    // Use parameterized query to prevent SQL injection
    $sql = "DELETE FROM education_table WHERE `year` = ?";
    
    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header('Location: table.php');
            exit();
        } else {
            die("Error: " . mysqli_stmt_error($stmt));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        die("Error in prepared statement: " . mysqli_error($conn));
    }
}
?>
