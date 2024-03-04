<?php
session_start();

$servername = "localhost:3302";
$username = "root";
$password = "";
$dbname = "port2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add data
function addData($tableName, $data) {
    global $conn;

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to update data
function updateData($tableName, $data, $condition) {
    global $conn;

    $setValues = "";
    foreach ($data as $column => $value) {
        $setValues .= "$column = '$value', ";
    }
    $setValues = rtrim($setValues, ', ');

    $sql = "UPDATE $tableName SET $setValues WHERE $condition";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to delete data
function deleteData($tableName, $condition) {
    global $conn;

    $sql = "DELETE FROM $tableName WHERE $condition";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

//Function to fetch data from the database
function fetchData($tableName) {
    global $conn;
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

// Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Data to Home Section
    if (isset($_POST['add_home_data'])) {
        $dataToAdd = array(
            'name' => $_POST['home_name'],
            'role' => $_POST['home_role'],
            'description' => $_POST['home_description'],
        );

        if (addData('home_table', $dataToAdd)) {
            echo "Data added to Home section successfully!";
        } else {
            echo "Error adding data to Home section.";
        }
    }

    // Update Data in Home Section
    if (isset($_POST['update_home_data'])) {
        $dataToUpdate = array(
            'name' => $_POST['home_name'],
            'role' => $_POST['home_role'],
            'description' => $_POST['home_description'],
        );

        $condition = "id = " . $_POST['home_id'];

        if (updateData('home_table', $dataToUpdate, $condition)) {
            echo "Data updated in Home section successfully!";
        } else {
            echo "Error updating data in Home section.";
        }
    }

    // Delete Data in Home Section
    if (isset($_POST['delete_home_data'])) {
        $condition = "id = " . $_POST['home_id'];

        if (deleteData('home_table', $condition)) {
            echo "Data deleted in Home section successfully!";
        } else {
            echo "Error deleting data in Home section.";
        }
    }

    // Similar sections for Services, Projects, Education, and Contact

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <p><a href="admin_logout.php">Logout</a></p>
    <p><a href="table.php">Education Details</a></p>

    <!-- Add Data to Home Section -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Add Data to Home Section</h3>
        <label for="home_name">Name:</label>
        <input type="text" name="home_name" required>

        <label for="home_role">Role:</label>
        <input type="text" name="home_role" required>

        <label for="home_description">Description:</label>
        <textarea name="home_description" required></textarea>

        <button type="submit" name="add_home_data">Add Data</button>
    </form>

    <!-- Update Data in Home Section -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Update Data in Home Section</h3>
        <label for="home_id">ID:</label>
        <input type="text" name="home_id" required>

        <label for="home_name">Name:</label>
        <input type="text" name="home_name" required>

        <label for="home_role">Role:</label>
        <input type="text" name="home_role" required>

        <label for="home_description">Description:</label>
        <textarea name="home_description" required></textarea>

        <button type="submit" name="update_home_data">Update Data</button>
    </form>

    <!-- Delete Data in Home Section -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Delete Data in Home Section</h3>
        <label for="home_id">ID:</label>
        <input type="text" name="home_id" required>

        <button type="submit" name="delete_home_data">Delete Data</button>
    </form>

    <!-- Services Section -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Add Data to Services Section</h3>
    <label for="service_title">Title:</label>
    <input type="text" name="service_title" required>

    <label for="service_description">Description:</label>
    <textarea name="service_description" required></textarea>

    <button type="submit" name="add_service_data">Add Data</button>
</form>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Update Data in Services Section</h3>
    <label for="service_id">ID:</label>
    <input type="text" name="service_id" required>

    <label for="service_title">Title:</label>
    <input type="text" name="service_title" required>

    <label for="service_description">Description:</label>
    <textarea name="service_description" required></textarea>

    <button type="submit" name="update_service_data">Update Data</button>
</form>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Delete Data in Services Section</h3>
    <label for="service_id">ID:</label>
    <input type="text" name="service_id" required>

    <button type="submit" name="delete_service_data">Delete Data</button>
</form>

<?php
// Services Section - Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Data to Services Section
    if (isset($_POST['add_service_data'])) {
        $dataToAdd = array(
            'title' => $_POST['service_title'],
            'description' => $_POST['service_description'],
        );

        if (addData('services_table', $dataToAdd)) {
            echo "Data added to Services section successfully!";
        } else {
            echo "Error adding data to Services section.";
        }
    }

    // Update Data in Services Section
    if (isset($_POST['update_service_data'])) {
        $dataToUpdate = array(
            'title' => $_POST['service_title'],
            'description' => $_POST['service_description'],
        );

        $condition = "id = " . $_POST['service_id'];

        if (updateData('services_table', $dataToUpdate, $condition)) {
            echo "Data updated in Services section successfully!";
        } else {
            echo "Error updating data in Services section.";
        }
    }

    // Delete Data in Services Section
    if (isset($_POST['delete_service_data'])) {
        $condition = "id = " . $_POST['service_id'];

        if (deleteData('services_table', $condition)) {
            echo "Data deleted in Services section successfully!";
        } else {
            echo "Error deleting data in Services section.";
        }
    }
}
?>
<!-- Projects Section -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Add Data to Projects Section</h3>
    <label for="project_title">Title:</label>
    <input type="text" name="project_title" required>

    <label for="project_description">Description:</label>
    <textarea name="project_description" required></textarea>

    <label for="project_image_url">Image URL:</label>
    <input type="text" name="project_image_url" required>

    <label for="project_github_link">GitHub Link:</label>
    <input type="text" name="project_github_link" required>

    <button type="submit" name="add_project_data">Add Data</button>
</form>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Update Data in Projects Section</h3>
    <label for="project_id">ID:</label>
    <input type="text" name="project_id" required>

    <label for="project_title">Title:</label>
    <input type="text" name="project_title" required>

    <label for="project_description">Description:</label>
    <textarea name="project_description" required></textarea>

    <label for="project_image_url">Image URL:</label>
    <input type="text" name="project_image_url" required>

    <label for="project_github_link">GitHub Link:</label>
    <input type="text" name="project_github_link" required>

    <button type="submit" name="update_project_data">Update Data</button>
</form>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Delete Data in Projects Section</h3>
    <label for="project_id">ID:</label>
    <input type="text" name="project_id" required>

    <button type="submit" name="delete_project_data">Delete Data</button>
</form>

<?php
// Projects Section - Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Data to Projects Section
    if (isset($_POST['add_project_data'])) {
        $dataToAdd = array(
            'title' => $_POST['project_title'],
            'description' => $_POST['project_description'],
            'image_url' => $_POST['project_image_url'],
            'github_link' => $_POST['project_github_link'],
        );

        if (addData('projects_table', $dataToAdd)) {
            echo "Data added to Projects section successfully!";
        } else {
            echo "Error adding data to Projects section.";
        }
    }

    // Update Data in Projects Section
    if (isset($_POST['update_project_data'])) {
        $dataToUpdate = array(
            'title' => $_POST['project_title'],
            'description' => $_POST['project_description'],
            'image_url' => $_POST['project_image_url'],
            'github_link' => $_POST['project_github_link'],
        );

        $condition = "id = " . $_POST['project_id'];

        if (updateData('projects_table', $dataToUpdate, $condition)) {
            echo "Data updated in Projects section successfully!";
        } else {
            echo "Error updating data in Projects section.";
        }
    }

    // Delete Data in Projects Section
    if (isset($_POST['delete_project_data'])) {
        $condition = "id = " . $_POST['project_id'];

        if (deleteData('projects_table', $condition)) {
            echo "Data deleted in Projects section successfully!";
        } else {
            echo "Error deleting data in Projects section.";
        }
    }
}
?>
<!-- Education Section -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Add Data to Education Section</h3>
    <label for="education_year">Year:</label>
    <input type="text" name="education_year" required>

    <label for="education_degree">Degree:</label>
    <input type="text" name="education_degree" required>

    <label for="education_description">Description:</label>
    <textarea name="education_description" required></textarea>

    <label for="education_institution">Institution:</label>
    <input type="text" name="education_institution" required>

    <label for="education_institution_link">Institution Link:</label>
    <input type="text" name="education_institution_link" required>

    <button type="submit" name="add_education_data">Add Data</button>
</form>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Update Data in Education Section</h3>
    <label for="education_id">ID:</label>
    <input type="text" name="education_id" required>

    <label for="education_year">Year:</label>
    <input type="text" name="education_year" required>

    <label for="education_degree">Degree:</label>
    <input type="text" name="education_degree" required>

    <label for="education_description">Description:</label>
    <textarea name="education_description" required></textarea>

    <label for="education_institution">Institution:</label>
    <input type="text" name="education_institution" required>

    <label for="education_institution_link">Institution Link:</label>
    <input type="text" name="education_institution_link" required>

    <button type="submit" name="update_education_data">Update Data</button>
</form>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Delete Data in Education Section</h3>
    <label for="education_id">ID:</label>
    <input type="text" name="education_id" required>

    <button type="submit" name="delete_education_data">Delete Data</button>
</form>

<?php
// Education Section - Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Data to Education Section
    if (isset($_POST['add_education_data'])) {
        $dataToAdd = array(
            'year' => $_POST['education_year'],
            'degree' => $_POST['education_degree'],
            'description' => $_POST['education_description'],
            'institution' => $_POST['education_institution'],
            'institution_link' => $_POST['education_institution_link'],
        );

        if (addData('education_table', $dataToAdd)) {
            echo "Data added to Education section successfully!";
        } else {
            echo "Error adding data to Education section.";
        }
    }

    // Update Data in Education Section
    if (isset($_POST['update_education_data'])) {
        $dataToUpdate = array(
            'year' => $_POST['education_year'],
            'degree' => $_POST['education_degree'],
            'description' => $_POST['education_description'],
            'institution' => $_POST['education_institution'],
            'institution_link' => $_POST['education_institution_link'],
        );

        $condition = "id = " . $_POST['education_id'];

        if (updateData('education_table', $dataToUpdate, $condition)) {
            echo "Data updated in Education section successfully!";
        } else {
            echo "Error updating data in Education section.";
        }
    }

    // Delete Data in Education Section
    if (isset($_POST['delete_education_data'])) {
        $condition = "id = " . $_POST['education_id'];

        if (deleteData('education_table', $condition)) {
            echo "Data deleted in Education section successfully!";
        } else {
            echo "Error deleting data in Education section.";
        }
    }
}
?>
<!-- Contact Section -->
<?php
$contactMessages = fetchData('contact_messages');
if (!empty($contactMessages)) {
    echo "<h3>Contact Messages</h3>";
    foreach ($contactMessages as $message) {
        echo "<p><strong>Name:</strong> " . $message['full_name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $message['email'] . "</p>";
        echo "<p><strong>Phone Number:</strong> " . $message['phone_number'] . "</p>";
        echo "<p><strong>Subject:</strong> " . $message['subject'] . "</p>";
        echo "<p><strong>Message:</strong> " . $message['message'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "<p>No contact messages available.</p>";
}
?>
</body>
</html>

<?php
$conn->close();
?>
