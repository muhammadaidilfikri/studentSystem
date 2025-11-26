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
<html lang="en">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>CRS | Senarai Kelab</title>
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
            <!--Begin::Section-->
            <!--begin:: Widgets/Stats-->
            <div class="m-portlet ">
              <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                  <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                      <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                          Kelab
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                          Jumlah Kelab
                        </span>
                        <span class="m-widget24__stats m--font-brand">
                          <?php echo countClub() ?>
                        </span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                          <div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
                          Kelab Berdaftar
                        </span>
                        <span class="m-widget24__number">
                          100%
                        </span>
                      </div>
                    </div>
                    <!--end::Total Profit-->
                  </div>
                  <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                      <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                          Penasihat</h4>
                        <br>
                        <span class="m-widget24__desc">
                          Jumlah Penasihat
                        </span>
                        <span class="m-widget24__stats m--font-info">
                          <?php echo countAdvisor()?>
                        </span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                          <div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
                          Penasihat Berdaftar
                        </span>
                        <span class="m-widget24__number">
                          100%
                        </span>
                      </div>
                    </div>
                    <!--end::New Feedbacks-->
                  </div>
                  <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Orders-->
                    <div class="m-widget24">
                      <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                          Pelajar</h4>
                        <br>
                        <span class="m-widget24__desc">
                          Jumlah Pelajar Ditawarkan</span>
                        <span class="m-widget24__stats m--font-danger">
                          <?php echo countStudent() ?>
                        </span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                          <div class="progress-bar m--bg-danger" role="progressbar" style="width: 89%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
                          Jumlah Pelajar Berdaftar
                        </span>
                        <span class="m-widget24__number">
                          89%
                        </span>
                      </div>
                    </div>
                    <!--end::New Orders-->
                  </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                      <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                          Pendaftaran Kelab
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                          Jumlah Pelajar Berdaftar
                        </span>
                        <span class="m-widget24__stats m--font-success">
                          <?php echo countStudentRegistered() ?>
                        </span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                          <div class="progress-bar m--bg-success" role="progressbar" style="width: 2%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
                          Jumlah Kekosongan
                        </span>
                        <span class="m-widget24__number">
                          <?php $tot = countClub()*50;
                            echo $tot;
                           ?>
                        </span>
                      </div>
                    </div>
                    <!--end::New Users-->
                  </div>
                  <div class="progress m-progress--sm">
                    <div class="progress-bar m--bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- BAHAGIAN PENDAFTARAN PELAJAR -->
            <div class="m-portlet m-portlet--mobile" style="margin-top: 30px;">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Pendaftaran Kelab Pelajar
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <?php
                    $query = "SELECT * FROM club_registration WHERE stdNo='$ssid'";
                    $result = $mysqli->query($query);
                    
                    if (mysqli_num_rows($result) == 0) {
                        ?>
                        <div class="alert alert-info">
                            <strong>Pemakluman Penting:</strong> Pelajar TIDAK DIBENARKAN untuk menukar Kelab selepas pendaftaran. 
                            Bahagian Hal Ehwal Pelajar tidak akan melayan sebarang permohonan untuk menukar Kelab.
                        </div>
                        <div class="table-responsive-container">
                            <table class="table table-striped table-bordered table-hover table-checkable" id="student_registration_table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelab</th>
                                        <th>Nama Penasihat</th>
                                        <th>Jumlah Maksimum Ahli</th>
                                        <th>Pelajar Berdaftar</th>
                                        <th>Kekosongan</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_events = mysqli_query($connection, "SELECT * FROM club WHERE club_stat='e' ORDER BY club_name ASC") or die (mysqli_error());
                                    $z = 1;

                                    while ($row = mysqli_fetch_array($sql_events)) {
                                        $club_id = $row["club_id"];
                                        $club_name = $row["club_name"];
                                        $club_max = $row["club_max"];
                                        $current_registered = countClubRegistration($club_id);
                                        $available_slots = $club_max - $current_registered;
                                    ?>
                                    <tr>
                                        <td><?php echo $z ?></td>
                                        <td><?php echo $club_name ?></td>
                                        <td><?php echo senaraiPenasihat($club_id) ?></td>
                                        <td><?php echo $club_max ?></td>
                                        <td><?php echo $current_registered ?></td>
                                        <td>
                                            <?php 
                                            if ($available_slots > 0) {
                                                echo '<span class="m-badge m-badge--success m-badge--wide">' . $available_slots . ' kekosongan</span>';
                                            } else {
                                                echo '<span class="m-badge m-badge--danger m-badge--wide">Penuh</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($available_slots > 0) {
                                                ?>
                                                <a href="regClub.php?club_id=<?php echo $club_id ?>&uid=<?php echo $ssid ?>" 
                                                   class="btn btn-info m-btn m-btn--icon" 
                                                   onclick="return confirm('Pelajar TIDAK DIBENARKAN untuk menukar Kelab selepas pendaftaran. Bahagian Hal Ehwal Pelajar tidak akan melayan sebarang permohonan untuk menukar Kelab. Adakah anda ingin meneruskan proses pendaftaran?')">
                                                    <span>
                                                        <i class="fa flaticon-edit"></i>
                                                        <span>Daftar Kelab</span>
                                                    </span>
                                                </a>
                                                <?php
                                            } else {
                                                ?>
                                                <button type="button" class="btn btn-danger m-btn m-btn--icon" disabled>
                                                    <i class="la la-minus"></i> Pendaftaran Penuh
                                                </button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $z++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        // Pelajar sudah berdaftar
                        $registered_club = mysqli_fetch_assoc($result);
                        $club_id = $registered_club['club_id'];
                        $club_name_query = mysqli_query($connection, "SELECT club_name FROM club WHERE club_id='$club_id'");
                        $club_name_row = mysqli_fetch_assoc($club_name_query);
                        ?>
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Telah Berdaftar</h4>
                            <p>Anda telah mendaftar untuk kelab: <b><?php echo $club_name_row['club_name'] ?></b></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- TAMAT BAHAGIAN PENDAFTARAN PELAJAR -->

          </div>

				</div>
			</div>

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
        // Initialize DataTable
        $('#student_registration_table').DataTable({
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    } );
    </script>

	</body>
	<!-- end::Body -->
</html>