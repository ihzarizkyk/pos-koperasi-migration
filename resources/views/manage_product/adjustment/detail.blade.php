
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Website POS</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/assets/css/shared/style.css">
    <link rel="stylesheet" href="/assets/css/demo_1/style.css">
    <link rel="stylesheet" href="/css/main/style.css">
    <link rel="shortcut icon" href="/icons/favicon.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/manage_product/adjustment/detail/style.css">
<style>
	.margin{
		margin-right: 5px;
	}
	.mg-top{
		margin-top: 10px;
	}
	.form-hidden{
		visibility: hidden;
	}
</style>
    <!-- End-CSS -->

  </head>
  <body>
    <div class="container-scroller">
      <!-- TopNav -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="https://koperasi.ittelkom-sby.ac.id/dashboard">
            <img src="https://koperasi.ittelkom-sby.ac.id/icons/logo.png" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="https://koperasi.ittelkom-sby.ac.id/dashboard">
            <img src="https://koperasi.ittelkom-sby.ac.id/icons/logo-mini.png" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <form class="search-form d-none d-md-block" action="#">
            <div class="form-group">
              <input type="search" class="form-control" name="search_page" placeholder="Cari Halaman">
            </div>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                                                    <span class="count bg-success">2</span>
                                                </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <div class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 font-weight-medium float-left">Anda Memiliki 2 Pemberitahuan</p>
                   <a href="#" role="button" data-toggle="modal" data-target="#notificationModal"><span class="badge badge-pill badge-primary float-right">Semua</span></a>
                </div>
                    <a class="dropdown-item preview-item py-3">
                    <div class="preview-thumbnail">
                      <i class="mdi mdi-alert m-auto text-warning"></i>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">Barang Hampir Habis</h6>
                      <p class="font-weight-light small-text mb-0"> Stok COCHO tersisa -2 </p>
                    </div>
                  </a>
                    <a class="dropdown-item preview-item py-">
                    <div class="preview-thumbnail">
                      <i class="mdi mdi-alert m-auto text-danger"></i>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">Barang Telah Habis</h6>
                      <p class="font-weight-light small-text mb-0"> Stok barang batre telah habis</p>
                    </div>
                  </a>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="https://koperasi.ittelkom-sby.ac.id/pictures/default.png" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="https://koperasi.ittelkom-sby.ac.id/pictures/default.png" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold">Mochammad Ihza Rizky Karim</p>
                  <p class="font-weight-light text-muted mb-0">ihzarizky30@gmail.com</p>
                </div>
                <a href="https://koperasi.ittelkom-sby.ac.id/profile" class="dropdown-item">Profil</a>
                <a href="https://koperasi.ittelkom-sby.ac.id/logout" class="dropdown-item">Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- End-TopNav -->

      <div class="container-fluid page-body-wrapper">
        <!-- SideNav -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="https://koperasi.ittelkom-sby.ac.id/profile" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="https://koperasi.ittelkom-sby.ac.id/pictures/default.png" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                                    <p class="profile-name">Mochammad Ih..</p>
                  <p class="designation">admin</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Daftar Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/dashboard">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
                                    <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#kelola_akun" aria-expanded="false" aria-controls="kelola_akun">
                <span class="menu-title">Kelola Akun</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="kelola_akun">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/account">Daftar Akun</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/access">Hak Akses</a>
                  </li>
                </ul>
              </div>
            </li>
                                                <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#kelola_barang" aria-expanded="false" aria-controls="kelola_barang">
                <span class="menu-title">Kelola Barang</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="kelola_barang">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/product">Daftar Barang</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/supply">Pasok Barang</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/transaction">
                <span class="menu-title">Transaksi</span>
              </a>
            </li>
                                    <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#kelola_laporan" aria-expanded="false" aria-controls="kelola_laporan">
                <span class="menu-title">Kelola Laporan</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="kelola_laporan">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/report/transaction">Laporan Transaksi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://koperasi.ittelkom-sby.ac.id/report/workers">Laporan Pegawai</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End-SideNav -->

        <div class="main-panel">
          <div class="row">
            <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Daftar Notifikasi</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                              <div class="icon-notification">
                              <i class="mdi mdi-alert m-auto text-warning"></i>
                            </div>
                            <div class="text-group ml-3">
                              <p class="m-0 title-notification">Barang Hampir Habis</p>
                              <p class="m-0 description-notification">Stok COCHO tersisa -2</p>
                            </div>
                          </div>
                              <div class="icon-notification">
                              <i class="mdi mdi-alert m-auto text-danger"></i>
                            </div>
                            <div class="text-group ml-3">
                              <p class="m-0 title-notification">Barang Telah Habis</p>
                              <p class="m-0 description-notification">Stok barang batre telah habis</p>
                            </div>
                          </div>
                          <div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content-wrapper" id="content-web-page">
            <div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-start align-items-center">
      <div class="quick-link-wrapper d-md-flex flex-md-wrap">
        <ul class="quick-links">
          <li><a href="https://koperasi.ittelkom-sby.ac.id/supply">Riwayat Pasok</a></li>
          <li><a href="https://koperasi.ittelkom-sby.ac.id/supply/new">Pasok Barang</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row modal-group">
  <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
	        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	          <div class="row">
	          	<div class="col-12 text-center" id="area-scan">
	          	</div>
	          	<div class="col-12 barcode-result" hidden="">
	          		<h5 class="font-weight-bold">Hasil</h5>
	          		<div class="form-border">
	          			<p class="barcode-result-text"></p>
	          		</div>
	          	</div>
	          </div>
	      </div>
	      <div class="modal-footer" id="btn-scan-action" hidden="">
	        <button type="button" class="btn btn-primary btn-sm font-weight-bold rounded-0 btn-continue">Lanjutkan</button>
	        <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold rounded-0 btn-repeat">Ulangi</button>
	      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="formatModal" tabindex="-1" role="dialog" aria-labelledby="formatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      	<div class="modal-header">
	        <h5 class="modal-title" id="formatModalLabel">Format Upload</h5>
	        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
	    <div class="modal-body">
	    	<div class="row">
	    		<div class="col-12 img-import-area">
	    			<img src="{{ asset('images/instructions/ImportSupply.jpg') }}" class="img-import">
	    		</div>
	    	</div>
	    </div>
      </div>
	</div>
  </div>
  <div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="tableModalLabel">Daftar Barang</h5>
	        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div class="row">
				<div class="col-12">
					<div class="card card-noborder b-radius">
						<div class="card-body">
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
								  <a class="nav-link active" id="master-form-tab" data-toggle="tab" href="#master-form" role="tab" aria-controls="master-form" aria-selected="true">Master</a>
								  <a class="nav-link" id="new-form-tab" data-toggle="tab" href="#new-form" role="tab" aria-controls="new-form" aria-selected="false">New</a>
								</div>
							</nav>
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="master-form" role="tabpanel" aria-labelledby="master-form-tab">
									<div class="row">
										<div class="col-12">
											<div class="form-group mg-top">
												<input type="text" class="form-control" name="search" placeholder="Cari barang">
											</div>	
										</div>
										<div class="col-12">
											<ul class="list-group product-list">
											  <li class="list-group-item d-flex justify-content-between align-items-center active-list">
											  <div class="text-group">
												  <p class="m-0">1</p>
												  <p class="m-0 txt-light">COCHO</p>
											  </div>
											  <div class="d-flex align-items-center">
												  <span class="ammount-box bg-secondary mr-1"><i class="mdi mdi-cube-outline"></i></span>
												  <p class="m-0">-2</p>
											  </div>
											  <a href="#" class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></a>
											</li>
									     <li class="list-group-item d-flex justify-content-between align-items-center active-list">
											  <div class="text-group">
												  <p class="m-0">ELE-81842</p>
												  <p class="m-0 txt-light">batre</p>
											  </div>
											  <div class="d-flex align-items-center">
												  <span class="ammount-box bg-secondary mr-1"><i class="mdi mdi-cube-outline"></i></span>
												  <p class="m-0">0</p>
											  </div>
											  <a href="#" class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></a>
											</li>
																					  </ul>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="new-form" role="tabpanel" aria-labelledby="new-form-tab">
									<form action="https://koperasi.ittelkom-sby.ac.id/supply/new_product" method="POST">
										<input type="hidden" name="_token" value="jXbVyE4XNiggp6m9NlI3BnUpKrMAdZ4q7lYMnXFo">	
										<div class="form-group row top-min mg-top">
											<label class="col-12 font-weight-bold col-form-label">Nama Barang</label>
											<div class="col-12">
												<input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Barang">
											</div>
										</div>
										<div class="form-group row top-min mg-top">
											<label class="col-12 font-weight-bold col-form-label">Jenis Barang</label>
											<div class="col-12">
												<select name="kategori" required class="form-control">
													<option value="">Pilih Jenis Barang</option>
													<option value="4">Minuman</option>
												  <option value="5">Snack</option>
													<option value="6">ATK</option>
												  <option value="7">Pantry</option>
												  <option value="9">Ice Cream</option>
													<option value="10">Lain-lain</option>
													<option value="11">Elektronik</option>
												</select>
											</div>
										</div>
										<div>
											<button class="btn btn-simpan" type="submit"><i class="mdi mdi-content-save"></i> Create</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	      </div>
	  </div>
	</div>
  </div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-12 col-sm-12 mb-4">
		<div class="row">
			<div class="col-12">
				<div class="card card-noborder b-radius">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex">
								<button class="btn-tab manual_form_btn btn-tab-active">Manual</button>
								<button class="btn-tab import_form_btn">Import</button>
								<div class="btn-tab-underline"></div>
							</div>
							<div class="col-12 mt-3">
								<form method="post" name="manual_form">
									<div class="form-group row">
										<label class="col-12 font-weight-bold col-form-label">Kode Barang</label>
										<div class="col-8">
											<input type="text" class="form-control" name="kode_barang" readonly="">
										</div>
										<div class="col-4 left-min d-flex">
											<div class="btn-group">
												<button class="btn btn-search" data-toggle="modal" data-target="#tableModal" type="button">
													<i class="mdi mdi-magnify"></i>
												</button>
												<button class="btn btn-scan" data-toggle="modal" data-target="#scanModal" type="button">
													<i class="mdi mdi-crop-free"></i>
												</button>
											</div>
										</div>
										<div class="col-12 error-notice" id="kode_barang_error"></div>
									</div>
									<div class="form-group row top-min">
										<label class="col-12 font-weight-bold col-form-label">In-Stock</label>
										<div class="col-12">
											<input type="text" class="form-control number-input input-notzero" name="in_stock" placeholder="Masukkan Jumlah">
										</div>
										<div class="col-12 error-notice" id="jumlah_error"></div>
									</div>
									<div class="form-group row top-min">
										<label class="col-12 font-weight-bold col-form-label">Actual Stock</label>
										<div class="col-12">
											<input type="text" class="form-control input-notzero" name="actual_stock" placeholder="Masukkan Tempat Beli">
										</div>
										<div class="col-12 error-notice" id="jumlah_error"></div>
									</div>
									<div class="form-group row top-min">
										<label class="col-12 font-weight-bold col-form-label">Adjustment</label>
										<div class="col-12">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">Rp.</div>
												</div>
												<input type="text" class="form-control number-input input-notzero" name="adjustment" placeholder="Masukkan Harga Satuan">
											</div>
										</div>
										<div class="col-12 error-notice" id="harga_beli_error"></div>
									</div>

                  <div class="form-group row top-min">
                  <label for="exampleFormControlTextarea1" class="col-12 font-weight-bold col-form-label" >Note</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
                  </div>

									<div class="row">
										<div class="col-12 d-flex justify-content-end">
											<button class="btn font-weight-bold btn-tambah" type="button">Tambah</button>
										</div>
									</div>
								</form>
								<form action="https://koperasi.ittelkom-sby.ac.id/supply/import" method="post" name="import_form" enctype="multipart/form-data" hidden="">
									<input type="hidden" name="_token" value="jXbVyE4XNiggp6m9NlI3BnUpKrMAdZ4q7lYMnXFo">									<div class="d-flex justify-content-between pb-2 align-items-center">
					                  <h2 class="font-weight-semibold mb-0">Import</h2>
					                  <input type="file" name="excel_file" hidden="" accept=".xls, .xlsx">
					                  <a href="#" class="excel-file">
					                  	<div class="icon-holder">
						                   <i class="mdi mdi-upload"></i>
						                </div>
					                  </a>
					                </div>
					                <div class="d-flex justify-content-between">
					                  <h5 class="font-weight-semibold mb-0">Upload file excel</h5>
					                  <p class="excel-name">Pilih File</p>
					                </div>
					                <button class="btn btn-block mt-3 btn-upload" type="submit" hidden="">Import Data</button>
					                <div class="row mt-4">
					                	<div class="col-12">
					                		<h4 class="card-title mb-1">Langkah - Langkah Import</h4>
						                    <div class="d-flex py-2 border-bottom">
						                      <div class="wrapper">
						                        <p class="font-weight-semibold text-gray mb-0">1. Siapkan data dengan format Excel (.xls atau .xlsx)</p>
						                        <small class="text-muted">
						                        	<a href="" role="button" class="link-how" data-toggle="modal" data-target="#formatModal">Selengkapnya</a>
						                    	</small>
						                      </div>
						                    </div>
						                    <div class="d-flex py-2 border-bottom">
						                      <div class="wrapper">
						                        <p class="font-weight-semibold text-gray mb-0">2. Jika sudah sesuai pilih file</p>
						                      </div>
						                    </div>
						                    <div class="d-flex py-2">
						                      <div class="wrapper">
						                        <p class="font-weight-semibold text-gray mb-0">3. Klik simpan, maka data otomatis tersimpan</p>
						                      </div>
						                    </div>
					                	</div>
					                </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-12 col-sm-12">
		<div class="card card-noborder b-radius">
			<div class="card-body">
				<form action="https://koperasi.ittelkom-sby.ac.id/supply/create" method="post">
					<input type="hidden" name="_token" value="jXbVyE4XNiggp6m9NlI3BnUpKrMAdZ4q7lYMnXFo">					

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
          </div>
          <div class="content-wrapper" id="content-web-search" hidden="">
            <div class="row">
              <div class="col-12 text-left">
                <h3 class="d-block">Cari Halaman</h3>
                <h5 class="mt-3 d-block"><span class="result-1"></span> <span class="result-2"></span></h5>
              </div>
              <div class="col-12 mt-3">
                <div class="row" id="page-result-parent">
                </div>
              </div>
            </div>
          </div>
          <footer class="footer" id="footer-content">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
        </div>
      </div>
    </div>

  </body>
</html>