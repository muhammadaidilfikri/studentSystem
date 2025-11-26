<?php
session_start();
include ("dbconnect.php");

$club_id = $_GET['club_id'];
$ssid = $_GET['uid'];

// First, check if student is already registered in ANY club
$check_student_sql = "SELECT * FROM club_registration WHERE stdNo = '$ssid'";
$check_student_result = $mysqli->query($check_student_sql);

if (mysqli_num_rows($check_student_result) > 0) {
    echo "<script>
            alert('Anda sudah mendaftar di kelab lain. Pelajar TIDAK DIBENARKAN untuk mendaftar lebih dari satu kelab.');
            document.location = 'pendaftaranKelab.php';
          </script>";
    exit;
}

// Get current number of registered students for this club
$count_sql = "SELECT COUNT(*) as current_count FROM club_registration WHERE club_id = '$club_id'";
$count_result = $mysqli->query($count_sql);
$count_row = $count_result->fetch_assoc();
$current_count = $count_row['current_count'];

// Get maximum capacity for this club
$max_sql = "SELECT club_max FROM club WHERE club_id = '$club_id'";
$max_result = $mysqli->query($max_sql);
$max_row = $max_result->fetch_assoc();
$club_max = $max_row['club_max'];

// Debug information
error_log("Club ID: $club_id, Current Count: $current_count, Max: $club_max");

if ($current_count >= $club_max) {
    echo "<script>
            alert('Pendaftaran Tidak Berjaya. Permohonan telah penuh.');
            document.location = 'pendaftaranKelab.php';
          </script>";
} else {
    // Register the student - using your actual database structure
    $current_timestamp = date('Y-m-d H:i:s'); // Current date and time
    $sql = "INSERT INTO club_registration (club_id, stdNo, timestamp) VALUES ('$club_id', '$ssid', '$current_timestamp')";
    
    if ($mysqli->query($sql)) {
        echo "<script>
                alert('Pendaftaran Telah Berjaya.');
                document.location = 'pendaftaranKelab.php';
              </script>";
    } else {
        error_log("Database error: " . $mysqli->error);
        echo "<script>
                alert('Pendaftaran Gagal. Sila cuba lagi. Error: " . addslashes($mysqli->error) . "');
                document.location = 'pendaftaranKelab.php';
              </script>";
    }
}
?>