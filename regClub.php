<?php
session_start();
include ("dbconnect.php");

$club_id = $_GET['club_id'];
$ssid= $_GET['uid'];


$sql_events = mysqli_query($connection, "select count(club_registration.club_id) as c_id, club_max from club_registration,club where club.club_id=club_registration.club_id and  club_registration.club_id='$club_id' ") or die (mysqli_error());

while ($row = mysqli_fetch_array($sql_events)) {

	$club_max = $row["club_max"];
	$c_id = $row["c_id"];

}

if ($c_id > $club_max)
{

	echo "<script>
				alert('Pendaftaran Tidak Berjaya. Permohonan telah penuh. ');
				document.location = 'pendaftaranKelab.php';
				 </script>";
}
else {

	$sql = "insert into club_registration (club_id,stdNo) values ('$club_id','$ssid')";
	$mysqli->query($sql);

	echo "<script>
				alert('Pendaftaran Telah Berjaya.');
				document.location = 'pendaftaranKelab.php';
				 </script>";
}


?>
