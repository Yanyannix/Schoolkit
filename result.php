<?php

if (!isset($_SESSION)) {
    session_start();
}

$welcomeMessage = isset($_SESSION['UserLogin']) 
    ? "Welcome " . $_SESSION['UserLogin'] 
    : "Welcome Guest";

include_once("connections/connection.php");

$con = connection();
$search = $_GET['search'];
$sql = "SELECT * FROM student_list WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' 
ORDER BY id DESC";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/styleresult.css">
</head>
<body>
    <header>
        <h1>Student Management System</h1>
        <p><?php echo $welcomeMessage; ?></p>
        <nav>
            <?php if (isset($_SESSION['UserLogin'])) { ?>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php } else { ?>
                <a href="login.php" class="nav-link">Login</a>
            <?php } ?>
            <a href="add.php" class="nav-link">Add New</a>
            <a href="index.php" class="nav-link">Home</a>
        </nav>
    </header>

    <main>
        <form action="result.php" method="get" class="search-form">
            <input type="text" name="search" id="search" placeholder="Search students..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="search-btn">Search</button>
        </form>

        <?php if ($row) { ?>
            <table class="results-table">
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
                            <td><a href="details.php?ID=<?php echo $row['id']; ?>" class="view-link">View</a></td>
                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        </tr>
                    <?php } while ($row = $students->fetch_assoc()); ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-results">No results found for "<strong><?php echo htmlspecialchars($search); ?></strong>".</p>
        <?php } ?>
    </main>
</body>
</html>
