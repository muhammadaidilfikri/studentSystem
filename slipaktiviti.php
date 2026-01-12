<?php
session_start();
include("dbconnect.php");
include("iqfunction.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$ssid = $_SESSION["username"];

// Get student info early to use in <title>
$stmt = $connection->prepare("
    SELECT stdNo, stdName, progCode, progName, noIc
    FROM student
    WHERE stdNo = ?
");
$stmt->bind_param("s", $ssid);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AsidApps | <?php echo $student['stdName']; ?> - <?php echo $student['stdNo']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Certificate Fonts -->
 <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: "Libre Baskerville", serif;
    background: #f2f2f2;
    margin: 0;
    color: #111;
}

.print-btn {
    width: 220px;
    margin: 25px auto;
    padding: 12px;
    text-align: center;
    background: #471658;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
}

.print-btn:hover {
    background: #5A3D8C;
}

/* Certificate container with background logo */
.certificate-container {
    position: relative;
    width: 820px;
    margin: auto;
    padding: 50px;
    background:
        url("images/logo_uitm.png") center center / 2300px no-repeat,
        #FFF8E7;
    border: 6px double #C9A24D;
}

/* Header */
.header-box {
    text-align: center;
}

.uitm-logo {
    width: 300px;
}

.cert-title {
    font-family: "Cinzel", serif;
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 3px;
    margin: 25px 0 10px;
    text-transform: uppercase;
    color: #8A6E2F;
}

.sub-title {
    text-align: center;
    font-size: 16px;
    margin-bottom: 35px;
}

/* Student name */
.student-center {
    text-align: center;
    margin-bottom: 30px;
}

.student-center .label {
    font-size: 15px;
    margin-bottom: 8px;
}

.student-center .name {
    font-family: "Cinzel", serif;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #C9A24D;
}

/* Student info */
.student-info {
    font-size: 13px;
    margin-bottom: 35px;
}

.student-info div {
    margin: 6px 0;
}

/* Section titles */
.section-title {
    text-align: center;
    font-family: "Cinzel", serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 2px;
    margin: 35px 0 15px;
    text-transform: uppercase;
    color: #8A6E2F;
}

.result-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12.5px;
}

.result-table th,
.result-table td {
    padding: 8px 6px;
}

.result-table thead th {
    border-bottom: 2px solid #C9A24D;
    text-align: center;
    font-weight: 700;
    color: #8A6E2F;
}

.result-table tbody td {
    border-bottom: 1px solid #E6D8A8;
}

.center {
    text-align: center;
}

/* Total summary */
.total-box {
    margin-top: 30px;
    font-family: "Cinzel", serif;
    font-size: 14px;
}

.total-box div {
    display: flex;
    justify-content: space-between;
    margin: 6px 0;
}

.total-final {
    font-size: 18px;
    font-weight: 700;
    border-top: 2px solid #C9A24D;
    padding-top: 10px;
    margin-top: 12px;
    color: #8A6E2F;
}

@media print {
    body * { visibility: hidden; }
    .certificate-container,
    .certificate-container * { visibility: visible; }
    .print-btn { display: none; }
}
</style>

<script>
function printCertificate() {
    window.print();
}
</script>
</head>

<body>

<div class="print-btn" onclick="printCertificate()">🖶 Print / Save as PDF</div>

<div class="certificate-container">

<div class="header-box">
    <img src="images/uitm-logo.png" class="uitm-logo">
</div>

<div class="cert-title">Sijil Rekod Aktiviti Pelajar</div>
<div class="sub-title">Pusat Asasi UiTM Dengkil</div>

<div class="student-center">
    <div class="label">Dengan ini diperakui bahawa</div>
    <div class="name"><?php echo $student['stdName']; ?></div>
</div>

<div class="student-info">
    <div><b>No Pelajar</b> : <?php echo $student['stdNo']; ?></div>
    <div><b>No Kad Pengenalan</b> : <?php echo $student['noIc']; ?></div>
    <div><b>Program</b> : (<?php echo $student['progCode']; ?>) <?php echo $student['progName']; ?></div>
</div>

<!-- Aktiviti Kelab -->
<div class="section-title">Aktiviti Kelab & Persatuan</div>
<table class="result-table">
<thead>
<tr>
    <th width="5%">Bil</th>
    <th>Nama Aktiviti</th>
    <th width="18%">Tarikh</th>
    <th width="20%">Peranan</th>
    <th width="12%">Markah</th>
</tr>
</thead>
<tbody>
<?php
$stmt = $connection->prepare("
    SELECT a.actreg_id, c.act_name, c.date_start, a.regpoint
    FROM actreg a
    JOIN club_activities c ON c.act_id = a.act_id
    WHERE a.stdNo = ?
");
$stmt->bind_param("s", $ssid);
$stmt->execute();
$res = $stmt->get_result();

$bil = 1; $totact = 0;
while ($r = $res->fetch_assoc()) {
    $type = ($r['regpoint']=='a'?'Audience':($r['regpoint']=='p'?'Contestant':'Committee'));
    $mark = checkMarks($r['actreg_id']);
    $totact += $mark;

    echo "<tr>
        <td class='center'>{$bil}</td>
        <td>{$r['act_name']}</td>
        <td class='center'>{$r['date_start']}</td>
        <td class='center'>{$type}</td>
        <td class='center'>{$mark}</td>
    </tr>";
    $bil++;
}
$stmt->close();
?>
</tbody>
</table>

<!-- Aktiviti Pusat Asasi -->
<div class="section-title">Aktiviti Pusat Asasi</div>
<table class="result-table">
<thead>
<tr>
    <th width="5%">Bil</th>
    <th>Nama Aktiviti</th>
    <th width="18%">Tarikh</th>
    <th width="20%">Peranan</th>
    <th width="12%">Markah</th>
</tr>
</thead>
<tbody>
<?php
$stmt = $connection->prepare("
    SELECT d.dactreg_id, a.dact_name, a.date_start, d.regpoint
    FROM dactreg d
    JOIN dept_activities a ON a.dact_id = d.dact_id
    WHERE d.stdNo = ?
");
$stmt->bind_param("s", $ssid);
$stmt->execute();
$res = $stmt->get_result();

$bil = 1; $totdact = 0;
while ($r = $res->fetch_assoc()) {
    $type = ($r['regpoint']=='a'?'Audience':($r['regpoint']=='p'?'Contestant':'Committee'));
    $mark = checkMarksD($r['dactreg_id']);
    $totdact += $mark;

    echo "<tr>
        <td class='center'>{$bil}</td>
        <td>{$r['dact_name']}</td>
        <td class='center'>{$r['date_start']}</td>
        <td class='center'>{$type}</td>
        <td class='center'>{$mark}</td>
    </tr>";
    $bil++;
}
$stmt->close();
?>
</tbody>
</table>

<!-- Penyertaan -->
<div class="section-title">Penyertaan / Komiti / Kelas</div>
<table class="result-table">
<thead>
<tr>
    <th width="5%">Bil</th>
    <th>Komiti / Kelas</th>
    <th width="15%">Markah</th>
</tr>
</thead>
<tbody>
<?php
$stmt = $connection->prepare("
    SELECT m.com_name, m.com_marks
    FROM regcom r
    JOIN com_marks m ON m.com_id = r.com_id
    WHERE r.stdNo = ?
");
$stmt->bind_param("s", $ssid);
$stmt->execute();
$res = $stmt->get_result();

$bil = 1; $totmarkah = 0;
while ($r = $res->fetch_assoc()) {
    $totmarkah += $r['com_marks'];
    echo "<tr>
        <td class='center'>{$bil}</td>
        <td>{$r['com_name']}</td>
        <td class='center'>{$r['com_marks']}</td>
    </tr>";
    $bil++;
}
$stmt->close();
?>
</tbody>
</table>

<!-- Total -->
<div class="section-title">Markah Terkumpul</div>
<div class="total-box">
    <div><span>Kelab & Persatuan</span><span><?php echo $totact; ?></span></div>
    <div><span>Pusat Asasi</span><span><?php echo $totdact; ?></span></div>
    <div><span>Penyertaan / Komiti</span><span><?php echo $totmarkah; ?></span></div>
    <div class="total-final">
        <span>Jumlah Keseluruhan</span>
        <span><?php echo $totact + $totdact + $totmarkah; ?></span>
    </div>
</div>

</div>
</body>
</html>