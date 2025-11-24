<?php
//header ("Location:muatturunems.php");
$mail_to = 'hairulnizam@penang.uitm.edu.my';
$emel = 'hairulnizam@gmail.com';
$subject = $log.' Masuk EMS ';
$body_message = $log.' telah masuk sistem pada '.date("Y-m-d h:i:sa");
$headers = 'Daripada: '.$emel."\r\n";
$headers .= 'Balas Kepada: '.$emel."\r\n";
//ini_set("SMTP","cyberoutbound.uitm.edu.my");
ini_set("SMTP","badang.uitm.edu.my");
ini_set("smtp_port","25");
//include("../smtp.php");
$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
  <script>
  alert('SELAMAT DATANG <?php echo $log ?> ');
        </script>
       <?php }
else { ?>
    <script>
        alert('TERIMAKASIH <?php echo $log ?> ');
    </script>
        <?php  }
