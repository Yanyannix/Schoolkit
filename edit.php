<?php

include_once("connections/connection.php");
$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM student_list WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

if (isset($_POST['submit'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    $sql = "UPDATE student_list SET last_name='$lname', first_name='$fname', gender='$gender' WHERE id='$id'";
    $con->query($sql) or die($con->error);

    echo header("Location: details.php?ID=" . $id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <link rel="stylesheet" href="css/styleedit.css">
</head>
<body>
    <header>
        <h1>Edit Student Details</h1>
        <a href="index.php" class="back-link">← Back to Home</a>
    </header>

    <main>
        <form action="" method="post" class="edit-form">
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $row['last_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $row['first_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" required>
                    <option value="Male" <?php echo ($row['gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($row['gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>

            <button type="submit" name="submit" class="update-btn">Update</button>
        </form>
    </main>
</body>
</html>
