<?php

session_start();
include ("dbconnect.php");
include ("addScript.php");
$ssid = $_SESSION['username'];

$date_open = "01 SEPTEMBER 2025";
$date_close = "31 DISEMBER 2025";

//$date_open = "01 JUL 2025";
//$date_close = "30 JUL 2025";

$datetoday = date("d M Y");



$date_today = date("Y-m-d");

$year = substr($date_today,0,4);
$month = substr($date_today,5,2); 
$day = substr($date_today,8,2);

$date_today_concat = trim($year.$month.$day);


//$date_today_concat = 20250730;
$date_open_concat = 20250901;
$date_close_concat = 20251231;




?>

<!DOCTYPE html>

<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>AsidApps - Student's Platform</title>
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
				<?php include ("mainmenu.php")?>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
							
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title "></h3>
							</div>
							<div>

							</div>
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						<!--Begin::Section-->
						<!--begin:: Widgets/Stats-->

						<!-- tables starts here -->
						<?php
						$sql_events = mysqli_query($connection, "select * from student where stdNo='$ssid' ") or die (mysqli_error());
						$z =1;

						while ($row = mysqli_fetch_array($sql_events)) {

							$stdName = $row["stdName"];
							$stdNo = $row["stdNo"];
							$fName = $row["fName"];
							$mName = $row["mName"];
							$fNoic = $row["fNoic"];
							$fPost = $row["fPost"];
							$mPost = $row["mPost"];
							$fEmployee = $row["fEmployee"];
							$mEmployee = $row["mEmployee"];
							$mNoic = $row["mNoic"];
							$jantina = $row["jantina"];
							$agama = $row["agama"];
							$bangsa = $row["bangsa"];
							$address = $row["address"];
							$address2 = $row["address2"];
							$postcode = $row["postcode"];
							$city = $row["city"];
							$district = $row["district"];
							$progCode = $row["progCode"];
							$progName = $row["progName"];
							$noPhone = $row["noPhone"];
							$email = $row["email"];

						       	
                                                        /*
							echo $date_today;
							echo "<br>";
							echo $year;
							echo "<br>";
							echo $month;
							echo "<br>";
							echo $day;
							echo "<br>";
							echo $date_today_concat;
							echo "<br>";
							echo $date_open_concat;
							echo "<br>";
							echo $date_close_concat;
							echo "<br><br>";

							 */

							/*

							if ($date_today_concat >= $date_open_concat)
							{
								echo "<b>";
								echo "System has been opened. You can apply now";
								echo "</b>";
							}
							else
							{
								echo "<font color='red'>";								                                 echo "<b>";
								echo "System do not open yet. Please be patient";
								echo "</b>";
								echo "</font>";

							}
                                                       
							 */
   
						


							?>
						<div class="m-portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">Borang Permohonan Bantuan Kewangan Asasi IPTA </h3>
									</div>
								</div>
							</div>

							<div class="m-portlet__body">
								<div class="m-section__content">

								<b>Syarat Permohonan</b>
								<p>(Pastikan pelajar memenuhi syarat yang telah ditetapkan)</p>
								<ul>
									<li>Warganegara Malaysia</li>
									<li>Pelajar Asasi UiTM yang berstatus <b>aktif</b></li>
									<li>Pendapatan kasar ibu bapa tidak melebihi <b>RM 11,819</b>/bulan </li>
									<li>Tidak menerima tajaan lain</li>
								</ul>

								<b>Dokumen Permohonan</b>
								<p>(Diserahkan semasa pendaftaran di kampus)</p>
								<b>IbuBapa / Penjaga mempunyai penyata pendapatan :</b>
								<ul>
									<li>Penyata Pendapatan Bapa / Penjaga Terkini (3 Bulan - April, Mei dan Jun 2024)</li>
										<li>Penyata Pendapatan Ibu / Penjaga Terkini (3 Bulan - April, Mei dan Jun Jun  2024)</li>
									<li>Pendapatan kasar ibu bapa tidak melebihi <b>RM 11,819</b>/bulan </li>
								</ul>
								<p>Atau</p>
								<b>IbuBapa / Penjaga tiada pendapatan / Tidak Bekerja: </b>
								<ul>
									<li>Surat Pengesahan Pendapatan (<a href="http://bit.ly/suratakuanTBBK" target="_blank">Klik Sini)</a> </li>
								</ul>

								<b>Maklumat Tambahan :</b>
								<ul>    
                                                                        <li>Taklimat Bantuan Kewangan Asasi (<a href="https://bit.ly/TBKA2024" target="_blank">Klik Sini</a>)</li>
									<li>Slide Taklimat Bantuan Kewangan Asasi (<a href="https://bit.ly/slideBKAI" target="_blank">Klik Sini </a>)</li>
									<li>Soalan Lazim (FAQ) Bantuan Kewangan Asasi (<a href="https://bit.ly/faqBKAI" target="_blank">Klik Sini </a>)</li>
									<li>Surat Pengesahan Pendapatan (<a href="https://bit.ly/suratakuanTBBK" target="_blank">Klik Sini</a> )</li>
									<li>Senarai Jawatan Yang Layak Mengesahkan Surat Akuan Tiada Slip Gaji / Tidak Bekerja : (<a href="https://bit.ly/layaksahBKAI" target="_blank">Klik Sini</a> )</li>
								</ul>
								<b>PERTANYAAN :</b><br />
								WhatsApp Puan Wan Intan Zuriaty  (<a href="http://www.wasap.my/60389245210" target="_blank">Klik Sini</a> ) <br />
								Whatsapp  Encik Muhammad Hafiz (<a href="http://www.wasap.my/60389245369" target="_blank">Klik Sini</a> )
								<br /><br /><br />
								<b>Borang Permohonan Bantuan Kewangan</b><br />
								<p>Permohonan bantuan kewangan bagi sesi 2024 hanya akan dibuka bermula  <b><?php echo $date_open ?> </b> (jam 12:00am) sehingga <b> <?php echo $date_close ?> </b> (jam 11:59pm )<p><br /> </br>
						
								
									<?php
						            	               //if ($datetoday<$date_open)
                                                                                if($date_today_concat < $date_open_concat)
										{

										}
								  //else if ($datetoday>=$date_open && $datetoday<=$date_close)
                                    else if ($date_today_concat >= $date_open_concat && $date_today_concat <= $date_close_concat)

										{
										
											$query = "select * from bkp where stdNo='$ssid' ";
											$result = $mysqli->query($query);
											if (mysqli_num_rows($result)==0) {
											
										


									?>
											<form class="m-form m-form--state m-form--fit m-form--label-align-right" action="bkpForm.php" method="post" id="bugForm">
											<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions">
												<button type="submit" class="btn btn-accent">Isi Permohonan </button>
											</div>
										</div>	
										</form>
										<?php
											}
											else 
											{
										?>
			<b>Anda telah membuat permohonan. sila semak permohonan anda di <a href="bkpHis.php">sini</a></b>
										<?php
											}
										}
										else {

										}
										?>
								
								
								<!-- end of content -->
								</div>
							 </div>
						 </div>
						<!-- tables stops here -->

						<!--End::Section-->
						<?php
						} 
					
						?>
					</div>

				</div>
			</div>
			<!-- end:: Body -->
<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2023 &copy; AsidApps by <a href="https://asasi.uitm.edu.my" class="m-link">
									Centre of Foundation Studies, UiTM
								</a>
							</span>
						</div>
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											About
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#"  class="m-nav__link">
										<span class="m-nav__link-text">
											Privacy
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											T&C
										</span>
									</a>
								</li>

								<li class="m-nav__item m-nav__item">
									<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
										<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
    		        <!-- begin::Quick Sidebar -->

		<!-- end::Quick Sidebar -->
	    <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->		    <!-- begin::Quick Nav -->

		<!-- begin::Quick Nav -->
    	<!--begin::Base Scripts -->
		<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
        <!--begin::Page Vendors -->
		<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<script src="assets/vendors/custom/flot/flot.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->
        <!--begin::Page Snippets -->
		<script src="assets/app/js/dashboard.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
        <!--begin::Page Resources -->
		<script src="assets/demo/default/custom/components/charts/flotcharts.js" type="text/javascript"></script>
		<script src="assets/demo/default/custom/components/charts/morris-charts.js" type="text/javascript"></script>
		<!--end::Page Resources -->

		<script src="assets/demo/default/custom/crud/forms/validation/form-controls.js" type="text/javascript"></script>

	</body>
	<!-- end::Body -->
</html>
