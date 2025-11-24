<?php
session_start();
include ("dbconnect.php");
include("iqfunction.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$ssid = $_SESSION["username"];

?>

<html>
<head>
  <title>Pusat Asasi UiTM - Slip Aktiviti Pelajar (<?php echo $ssid ?>)</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<style>
body {
  font-family: "Roboto", sans-serif;
}
table, tr, td {
  border: 1px solid gray;
  border-collapse: collapse;

}
tr:nth-child(even) {background-color: #f2f2f2;}
</style>
</head>
<body>
<h2>PUSAT ASASI UiTM : LAPORAN AKTIVITI PELAJAR<h2>

  <div class="m-portlet__body">

    <?php

    $sql_events1 = mysqli_query($connection, "select * from student where stdNo='$ssid' ") or die (mysqli_error());
    while ($row = mysqli_fetch_array($sql_events1)) {


      $stdNo = $row['stdNo'];
      $stdName = $row['stdName'];
      $progCode = $row['progCode'];
      $progName = $row['progName'];
      $noIc = $row['noIc'];
      $noPhone = $row['noPhone'];
      $email = $row['email'];
    }

      ?>
      <table class="table">

          <tr>
            <td><b> Nama :</b> <?php echo $stdName ?></td>
          </tr>
          <tr>
            <td><b> No Pelajar : </b> <?php echo $stdNo ?></td>
          </tr>
          <tr>
            <td><b> Program : </b> <?php echo $progCode ?> : <?php echo $progName?> </td>
          </tr>

      </table>

<h4>1) Aktiviti Kelab Persatuan</h4>

<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>No Pelajar</th>
      <th>Nama Aktiviti</th>
      <th>Tarikh</th>
      <th>Jenis Penyertaan</th>
      <th>Markah</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $sql_events = mysqli_query($connection, "select * from student,club,club_activities,actreg where student.stdNo=actreg.stdNo and club.club_id=club_activities.club_id and club_activities.act_id=actreg.act_id and student.stdNo='$ssid'") or die (mysqli_error());
    $z =1;
    $totact  = 0;

    while ($row = mysqli_fetch_array($sql_events)) {
      $stdNo = $row["stdNo"];
      $actreg_id = $row["actreg_id"];
      $stdName = $row["stdName"];
      $act_id = $row["act_id"];
      $act_name = $row["act_name"];
      $date_start = $row["date_start"];
      $progCode = $row["progCode"];
      $regpoint = $row["regpoint"];

      if($regpoint=='a')
      {
        $regs = "Audience";
      }
      else if($regpoint=='p')
      {
        $regs = "Contestant";
      }
      else if($regpoint=='c')
      {
        $regs = "Committee";
      }

    ?>
    <tr>
      <th scope="row"><?php echo $z ?></th>

      <td><?php echo $stdNo ?></td>
      <td><?php echo $act_name ?></td>
      <td><?php echo $date_start ?></td>
      <td><?php echo $regs ?></td>
      <td><?php echo checkMarks($actreg_id) ?></td>

    </tr>
    <?php
    $totact += checkMarks($actreg_id);
    $z++;
  }
  ?>


  </tbody>
</table>

<h4>2) Aktiviti Pusat Asasi </h4>

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
  <thead>
    <tr>
      <th>No</th>
      <th>No Pelajar</th>
      <th>Nama Aktiviti</th>
      <th>Tarikh</th>
      <th>Jenis Penyertaan</th>
      <th>Markah</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $sql_events = mysqli_query($connection, "select * from student,dept,dept_activities,dactreg where student.stdNo=dactreg.stdNo and dept.dept_id=dept_activities.dept_id and dept_activities.dact_id=dactreg.dact_id and student.stdNo='$ssid' order by regpoint desc") or die (mysqli_error());
    $z =1;
    $totdact = 0;

    while ($row = mysqli_fetch_array($sql_events)) {
      $stdNo = $row["stdNo"];
      $dactreg_id = $row["dactreg_id"];
      $stdName = $row["stdName"];
      $dact_id = $row["dact_id"];
      $dact_name = $row["dact_name"];
      $progCode = $row["progCode"];
      $date_start = $row["date_start"];
      $regpoint = $row["regpoint"];

      if($regpoint=='a')
      {
        $regs = "Audience";
      }
      else if($regpoint=='p')
      {
        $regs = "Contestant";
      }
      else if($regpoint=='c')
      {
        $regs = "Committee";
      }

    ?>
    <tr>
      <th scope="row"><?php echo $z ?></th>

      <td><?php echo $stdNo ?></td>
      <td><?php echo $dact_name ?></td>
      <td><?php echo $date_start ?></td>
      <td><?php echo $regs ?></td>
      <td><?php echo checkMarksD($dactreg_id) ?></td>

    </tr>
    <?php
    $totdact += checkMarksD($dactreg_id);
    $z++;
  }
  ?>


  </tbody>
</table>

<h4>3) Aktiviti Pusat Asasi </h4>

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
<thead>
  <tr>
    <th>No</th>
    <th>Komiti / Kelas</th>
    <th>Markah</th>
  </tr>
</thead>
<tbody>
  <?php
  $sql_events = mysqli_query($connection, " select * from student, regcom, com_marks where student.stdNo=regcom.stdNo and com_marks.com_id=regcom.com_id and regcom.stdNo='$ssid' ") or die (mysqli_error());
  $z =1;
  $totmarkah = 0;
  while ($row = mysqli_fetch_array($sql_events)) {
    $stdNo = $row["stdNo"];
    $regcom_id = $row["regcom_id"];
    $com_name = $row["com_name"];
    $com_marks = $row["com_marks"];
    $totmarkah += $com_marks;

  ?>
  <tr>
    <th scope="row"><?php echo $z ?></th>
    <td><?php echo $com_name ?></td>
    <td><?php echo $com_marks ?></td>
  </tr>
  <?php
  $z++;
}
?>
</tbody>
</table>

<h4>Markah Terkumpul</h4>

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
  <thead>
    <tr>
      <th>Markah Aktiviti Persatuan Kelab</th>
      <th>Markah Aktivi Pusat Asasi</th>
      <th>Markah Penyertaan / Komiti / Kelas</th>
      <th>Jumlah</th>

    </tr>
  </thead>
  <tbody>

    <tr>


      <td><?php echo $totact ?></td>
      <td><?php echo $totdact ?></td>
      <td><?php echo $totmarkah ?></td>
      <td><b><?php echo $totdact+$totact+$totmarkah ?></b></td>

    </tr>

  </tbody>
</table>

</body>
</html>
