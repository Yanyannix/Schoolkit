<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['UserLogin'])) {
    $welcomeMessage = "Welcome, " . $_SESSION['UserLogin'];
} else {
    $welcomeMessage = "Welcome, Guest!";
}

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM student_list ORDER BY id DESC";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/styleindex.css?v=1">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Student Management System</h1>
            <p class="welcome-message"><?php echo $welcomeMessage; ?></p>
        </div>
    </header>

    <div class="nav-bar">
        <?php if (isset($_SESSION['UserLogin'])) { ?>
            <a href="logout.php" class="nav-link">Logout</a>
        <?php } else { ?>
            <a href="login.php" class="nav-link">Login</a>
        <?php } ?>
        <a href="add.php" class="nav-link">Add New</a>
    </div>

    <form action="result.php" method="get" class="search-form">
        <input type="text" name="search" id="search" placeholder="Search students...">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Last Name</th>
                <th>First Name</th>
            </tr>
        </thead>
        <tbody>
            <?php do { ?>
                <tr>
                    <td><a href="details.php?ID=<?php echo $row['id']; ?>">View</a></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                </tr>
            <?php } while ($row = $students->fetch_assoc()); ?>
        </tbody>
    </table>
</body>
</html>
