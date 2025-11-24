<?php

session_start();
include ("dbconnect.php");
$ssid = $_SESSION['username'];

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
			<? include ("menuheader.php")?>
			<!-- END: Header -->
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<? include ("mainmenu.php")?>
				<!-- END: Left Aside -->
				<?

				$query = "select * from bkp where stdNo='$ssid' ";
				$result = $mysqli->query($query);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
			 		$totSal = $row["totSal"];
	 				 }

				 if ($totSal >=10000)
				 {
					?>
					<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
					<div class="col-12">

					<div class="m-portlet m--bg-danger m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">

						<div class="m-portlet__body">
							<div class="m-widget7 m-widget7--skin-dark">
								<div class="m-widget7__desc">
									Maaf. Berdasarkan syarat yang dikeluarkan oleh UPU, anda tidak layak untuk menerima Bantuan Kewangan Pelajar IPTA. (Pendapatan kasar melebihi RM10,959.00)
								</div>
								<div class="m-widget7__user">
									<div class="m-widget7__user-img">
									</div>
								</div>
							</div>
							<!--end::Widget 7-->
						</div>
					</div>
				</div>
			</div>
		</div>
					<?
				 }
				 else {

					?>
					<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
					<div class="col-12">
					<div class="m-portlet m--bg-success m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">Status Permohonan </h3>
									<ul>
									</ul>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="m-widget7 m-widget7--skin-dark">
								<div >
								<h4>Permohonan telah dihantar dan didalam <span class="m--font-warning">Proses Semakan</span>. </h4><br>

								<h4>Pelajar diminta membawa dokumen dokumen lampiran bagi tujuan pengesahan semasa Minggu Destini Siswa.</h4>
								<br>
								<h4 class="m-class-danger"> Wajib dilampirkan salinan dokumen terkini bagi kedua-dua ibu bapa/penjaga dan disahkan oleh Ketua Kampung/ Penghulu/ Pengerusi JKKK/ Pegawai Kerajaan Kumpulan A KECUALI kakitangan Pusat Asasi UiTM.</h4>
								<br>
								<h4>Dokumen sokongan yang WAJIB dilampirkan:</h4>
								<br>
								<h4>1. Bapa / Penjaga </h4>
									<label class="m-radio m-radio--solid m-radio--success">
										<input type="radio" name="example_5" value="5"> Penyata pendapatan/gaji [bagi bapa/ penjaga yang bekerja] <b>ATAU</b>
										<span></span>
									</label>
									<br>
									<label class="m-radio m-radio--solid m-radio--success">
										<input type="radio" name="example_5" value="5"> Penyata pencen [bagi  bapa/penjaga yang telah bersara] <b>ATAU</b>
										<span></span>
									</label>
									<br>
									<label class="m-radio m-radio--solid m-radio--success">
										<input type="radio" name="example_5" value="5"> Borang Cukai Pendapatan dari Lembaga Hasil Dalam Negeri [bagi bapa/penjaga yang mempunyai perniagaan] <b>ATAU</b>
										<span></span>
									</label>
									<br>
									<label class="m-radio m-radio--solid m-radio--success">
										<input type="radio" name="example_5" value="5"> Tidak Bekerja/Tiada Penyata Pendapatan/Gaji [Surat Akuan Sumpah/ Surat Pengesahan Tidak Bekerja/ Surat Pengesahan Pendapatan] <b>ATAU</b>
										<span></span>
									</label>
									<br>
									<label class="m-radio m-radio--solid m-radio--success">
										<input type="radio" name="example_5" value="5"> Dokumen sokongan yang berkaitan [Surat Pencen, Sijil Kematian/Sijil Cerai, sijil anak angkat dan lain-lain]
										<span></span>
									</label><br>
									<br>
									<h4>2. Ibu / Penjaga </h4>
										<label class="m-radio m-radio--solid m-radio--success">
											<input type="radio" name="example_5" value="5"> Penyata pendapatan/gaji [bagi ibu/penjaga yang bekerja] <b>ATAU</b>
											<span></span>
										</label>
										<br>
										<label class="m-radio m-radio--solid m-radio--success">
											<input type="radio" name="example_5" value="5"> Penyata pencen [bagi ibu/penjaga yang telah bersara] <b>ATAU</b>
											<span></span>
										</label>
										<br>
										<label class="m-radio m-radio--solid m-radio--success">
											<input type="radio" name="example_5" value="5"> Borang Cukai Pendapatan dari Lembaga Hasil Dalam Negeri [bagi ibu/penjaga yang mempunyai perniagaan] <b>ATAU</b>
											<span></span>
										</label>
										<br>
										<label class="m-radio m-radio--solid m-radio--success">
											<input type="radio" name="example_5" value="5"> Tidak Bekerja/Tiada Penyata Pendapatan/Gaji [Surat Akuan Sumpah/ Surat Pengesahan Tidak Bekerja/ Surat Pengesahan Pendapatan] <b>ATAU</b>
											<span></span>
										</label>
										<br>
										<label class="m-radio m-radio--solid m-radio--success">
											<input type="radio" name="example_5" value="5"> Dokumen sokongan yang berkaitan [Surat Pencen, Sijil Kematian/Sijil Cerai, sijil anak angkat dan lain-lain]
											<span></span>
										</label><br>
									<br><br>

													<h4 class="m-portlet__head-text">3. Borang-borang</h4>
													<p>Contoh Penyata Pendapatan / Borang Cukai Pendapatan / Surat Akuan Sumpah dll boleh diperolehi melalui pautan dibawah :</p>
													<li><a href="download/cds.rar">Muatturun contoh borang</a></li>
													<li><a href="download/bpp.doc">Borang Pengesahan Pendapatan</a></li>
								</div>
								<div class="m-widget7__user">
									<div class="m-widget7__user-img">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



					<?
				 }

				}
				else {
	    	?>


				<?
				}
				?>

			</div>


			<!-- end:: Body -->
<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2019 &copy; AsidApps by <a href="https://asasi.uitm.edu.my" class="m-link">
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

	</body>
	<!-- end::Body -->
</html>
