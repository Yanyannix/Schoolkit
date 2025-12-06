<?php
include_once("connections/connection.php");
$con = connection();

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO student_list (first_name, last_name, gender) VALUES ('$fname', '$lname', '$gender')";
    $con->query($sql) or die($con->error);

    echo header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link rel="stylesheet" href="css/styleadd.css">
</head>
<body>
    <header>
        <h1>Add New Student</h1>
        <a href="index.php" class="back-link">← Back to Home</a>
    </header>

    <main>
        <form action="" method="post" class="add-form">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" placeholder="Enter first name" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter last name" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" required>
                    <option value="" disabled selected>Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <button type="submit" name="submit" class="add-btn">Add Student</button>
        </form>
    </main>
</body>
</html>
