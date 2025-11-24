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



<!DOCTYPE html>

<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			CRS | Sejarah Penyertaan Aktiviti
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
        <!--begin::Page Vendors -->
        <link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    		<!--end::Page Vendors -->
    		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    		<link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <style>
        /* Donut charts get built from Pie charts but with a fundamentally difference in the drawing approach. The donut is drawn using arc strokes for maximum freedom in styling */
.ct-series-a .ct-slice-donut {
  /* give the donut slice a custom colour */
  stroke: #8E44AD;

}
.ct-series-b .ct-slice-donut {
  /* give the donut slice a custom colour */
  stroke: #26C281;

}
.ct-series-c .ct-slice-donut {
  /* give the donut slice a custom colour */
  stroke: #E43A45;

}
.ct-series-d .ct-slice-donut {
  /* give the donut slice a custom colour */
  stroke: #F3C200;

}

        </style>

		<!--end::Base Styles -->
		<link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<?php include ("menuheader.php")?>
			<!-- END: Header -->
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<!-- Start : Left Aside -->

				<?php include ("mainmenu.php")?>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->

					<!-- END: Subheader -->

          <div class="m-content">
          <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
              <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                  <h3 class="m-portlet__head-text">
                    Aktiviti Kelab Persatuan
                  </h3>
                </div>
              </div>
              <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                  <li class="m-portlet__nav-item">
                  </li>
                </ul>
              </div>
            </div>
            <div class="m-portlet__body">
              <!--begin: Datatable -->
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
            </div>
          </div>

          <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
              <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                  <h3 class="m-portlet__head-text">
                    Aktiviti Pusat Asasi
                  </h3>
                </div>
              </div>
              <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                  <li class="m-portlet__nav-item">
                  </li>
                </ul>
              </div>
            </div>
            <div class="m-portlet__body">
              <!--begin: Datatable -->
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
            </div>
          </div>
          <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
              <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                  <h3 class="m-portlet__head-text">
                    Markah Penyertaan / Komiti / Kelas
                  </h3>
                </div>
              </div>
              <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                  <li class="m-portlet__nav-item">
                  </li>
                </ul>
              </div>
            </div>
          <div class="m-portlet__body">
              <table class="table m-table m-table--head-bg-primary">
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

          </div>
</div>

          <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
              <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                  <h3 class="m-portlet__head-text">
                    Markah Terkumpul
                  </h3>
                </div>
              </div>
              <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                  <li class="m-portlet__nav-item">
                  </li>
                </ul>
              </div>
            </div>
            <div class="m-portlet__body">
              <!--begin: Datatable -->
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
            </div>
          </div>

            <!-- end section -->
          </div>

				</div>
			</div>

      <!--begin::Add Modal-->


      <!--end::Modal-->



			<!-- end:: Body -->
    <?php include("footer.php"); ?>
		</div>
		<!-- end:: Page -->
	    <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->
      <script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
  		<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
  		<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
  		<script src="assets/app/js/dashboard.js" type="text/javascript"></script>
      <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

    <script>
    $(document).ready( function () {
    $('#m_table_1').DataTable();
      } );
    </script>

	</body>
	<!-- end::Body -->
</html>
