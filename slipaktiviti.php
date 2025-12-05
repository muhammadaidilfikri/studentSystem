<?php
//test
session_start();
include("dbconnect.php");
include("iqfunction.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$ssid = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>CRS | Slip Aktiviti Pelajar</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {families: ["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <style>
        body {
            font-family: "Roboto", "Poppins", "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            background: #ffffffff;
        }

        .certificate-container {
            width: 800px;
            margin: 30px auto;
            padding: 40px;
            background: #ffffffff;
            border: 3px solid #4E2A84;
            border-radius: 1px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.25);
        }

        h2 {
            text-align: center;
            font-family: "Poppins", sans-serif;
            font-size: 28px;
            margin-bottom: 20px;
        }

        h4 {
            margin-top: 40px;
            font-family: "Poppins", sans-serif;
            border-bottom: 3px solid #000;
            width: fit-content;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 2px solid #000;
        }

        th, td {
            padding: 6px 8px;
            font-size: 12px;
            text-align: center;
        }

        th {
            background: #e3e3e3;
            font-weight: bold;
        }

        /* PRINT BUTTON */
        .print-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 12px;
            text-align: center;
            background: #76d2f9;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #4a89e1;
        }

        /* PRINT ONLY CERTIFICATE */
        @media print {
            body * {
                visibility: hidden;
            }
            .certificate-container, .certificate-container * {
                visibility: visible;
            }
            .print-btn {
                display: none;
            }
        }

        /* HEADER SECTION */
        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .uitm-logo {
            width: 250px;
        }

        .header-right {
            font-size: 16px;
            font-weight: bold;
            font-family: "Poppins", sans-serif;
        }

        .gold-line {
            border: none;
            height: 4px;
            background: #D4AF37;
            margin-top: 10px;
            margin-bottom: 25px;
        }
    </style>
    <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />

    <script>
        function printCertificate() {
            window.print();
        }
    </script>
</head>

<body>

<a class="print-btn" onclick="printCertificate()">🖨 Print / Save as PDF</a>

<div class="certificate-container">

    <div class="header-box">
        <div class="header-left">
            <img src="images/uitm-logo.png" class="uitm-logo">
        </div>
        <div class="header-right">
            <b>LAPORAN AKTIVITI PELAJAR</b>
        </div>
    </div>

    <hr class="gold-line">

    <?php
    $stmt = $connection->prepare("
        SELECT stdNo, stdName, progCode, progName, noIc 
        FROM student 
        WHERE stdNo = ?
    ");
    $stmt->bind_param("s", $ssid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stdNo = $row['stdNo'];
    $stdName = $row['stdName'];
    $progCode = $row['progCode'];
    $progName = $row['progName'];
    $noIc = $row['noIc'];

    $stmt->close();

    ?>

    <div style="text-align: left; font-family: Helvetica Neue, arial; font-size: 13px; line-height: 1.5;">
        <div><b>Nama :</b> <?php echo $stdName ?></div>
        <div><b>No Pelajar :</b> <?php echo $stdNo ?></div>
        <div><b>Program :</b> (<?php echo $progCode ?>) <?php echo $progName ?></div>
        <div><b>No IC :</b> <?php echo $noIc ?></div>
    </div>

    <h4>Aktiviti Kelab Persatuan</h4>

    <table>
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
        $stmt = $connection->prepare("
            SELECT a.actreg_id, s.stdNo, c.act_name, c.date_start, a.regpoint
            FROM actreg a
            INNER JOIN student s ON s.stdNo = a.stdNo
            INNER JOIN club_activities c ON c.act_id = a.act_id
            WHERE s.stdNo = ?
        ");
        $stmt->bind_param("s", $ssid);
        $stmt->execute();
        $sql_events = $stmt->get_result();

        $z = 1;
        $totact = 0;

        while ($row = $sql_events->fetch_assoc()) {
            $actreg_id = $row["actreg_id"];
            $regs = ($row["regpoint"] == 'a' ? "Audience" :
                    ($row["regpoint"] == 'p' ? "Contestant" : "Committee"));

            echo "<tr>
                    <td>{$z}</td>
                    <td>{$row['stdNo']}</td>
                    <td>{$row['act_name']}</td>
                    <td>{$row['date_start']}</td>
                    <td>{$regs}</td>
                    <td>".checkMarks($actreg_id)."</td>
                </tr>";

            $totact += checkMarks($actreg_id);
            $z++;
        }

        $stmt->close();
        ?>
        </tbody>
    </table>     

    <h4>Aktiviti Pusat Asasi</h4>

    <table>
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
        $stmt = $connection->prepare("
            SELECT d.dactreg_id, s.stdNo, a.dact_name, a.date_start, d.regpoint
            FROM dactreg d
            INNER JOIN student s ON s.stdNo = d.stdNo
            INNER JOIN dept_activities a ON a.dact_id = d.dact_id
            WHERE s.stdNo = ?
            ORDER BY d.regpoint DESC
        ");
        $stmt->bind_param("s", $ssid);
        $stmt->execute();
        $sql_events = $stmt->get_result();

        $z = 1;
        $totdact = 0;

        while ($row = $sql_events->fetch_assoc()) {
            $dactreg_id = $row["dactreg_id"];
            $regs = ($row["regpoint"] == 'a' ? "Audience" :
                    ($row["regpoint"] == 'p' ? "Contestant" : "Committee"));

            echo "<tr>
                    <td>{$z}</td>
                    <td>{$row['stdNo']}</td>
                    <td>{$row['dact_name']}</td>
                    <td>{$row['date_start']}</td>
                    <td>{$regs}</td>
                    <td>".checkMarksD($dactreg_id)."</td>
                </tr>";

            $totdact += checkMarksD($dactreg_id);
            $z++;
        }

        $stmt->close();
        ?>

        </tbody>
    </table>

    <h4>Penyertaan / Komiti / Kelas</h4>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Komiti / Kelas</th>
            <th>Markah</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $stmt = $connection->prepare("
            SELECT m.com_name, m.com_marks 
            FROM regcom r
            INNER JOIN com_marks m ON m.com_id = r.com_id
            WHERE r.stdNo = ?
        ");
        $stmt->bind_param("s", $ssid);
        $stmt->execute();
        $sql_events = $stmt->get_result();

        $z = 1;
        $totmarkah = 0;

        while ($row = $sql_events->fetch_assoc()) {
            $totmarkah += $row["com_marks"];

            echo "<tr>
                    <td>{$z}</td>
                    <td>{$row['com_name']}</td>
                    <td>{$row['com_marks']}</td>
                </tr>";
            $z++;
        }

        $stmt->close();
        ?>
        </tbody>
    </table>

    <h4>Markah Terkumpul</h4>

    <table>
        <thead>
        <tr>
            <th>Markah Aktiviti Persatuan Kelab</th>
            <th>Markah Aktiviti Pusat Asasi</th>
            <th>Markah Penyertaan / Komiti / Kelas</th>
            <th>Jumlah</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td><?php echo $totact ?></td>
            <td><?php echo $totdact ?></td>
            <td><?php echo $totmarkah ?></td>
            <td><b><?php echo $totact + $totdact + $totmarkah ?></b></td>
        </tr>
        </tbody>
    </table>

</div>

</body>
</html>