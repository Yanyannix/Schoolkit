<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator") {
    $welcomeMessage = "Welcome, " . $_SESSION['UserLogin'];
} else {
    echo header("Location: index.php");
}

include_once("connections/connection.php");

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM student_list WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="css/styledetails.css">
</head>

<body>
    <div class="container">
        <div class="welcome-message">
            <h1><?php echo $welcomeMessage; ?></h1>
            <p>You're logged in as an administrator. Manage student details below.</p>
        </div>

        <div class="header">
            <a href="index.php" class="back-btn">← Back</a>
            <div class="actions">
                <a href="edit.php?ID=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                <form action="delete.php" method="post" class="delete-form">
                    <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete" class="delete-btn">Delete</button>
                </form>
            </div>
        </div>

        <div class="details">
            <h2><?php echo $row['last_name']; ?> <?php echo $row['first_name']; ?></h2>
            <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
        </div>
    </div>
</body>

</html>
