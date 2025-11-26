<?php
session_start(); // Always start session at the top
require('dbconnect.php');

if (isset($_POST['stdNo'], $_POST['noic'])) {

    $userID = $_POST['stdNo'];
    $password = $_POST['noic'];

    // Prepare statement
    $stmt = $connection->prepare("SELECT stdNo, noic FROM student WHERE stdNo = ? AND noic = ?");
    $stmt->bind_param("ss", $userID, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if login is successful
    if ($result->num_rows === 1) {
        $_SESSION['username'] = $userID;
        $_SESSION["loggedin"] = true;

        echo "<script>document.location = 'main.php';</script>";
        exit;

    } else {
        echo "<script>
                alert('Invalid Login. Please Try Again');
                document.location = 'index.php';
              </script>";
        exit;
    }
}
?>
