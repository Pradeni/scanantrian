<?php
include('config.php');
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome-free-5.6.3-web/css/all.css">
  <link href="css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <style>
    .modal-full {
      min-width: 100%;
      margin: 0;
    }

    .modal-full .modal-content {
      min-height: 100vh;
    }

    .modal-fix {
      min-width: 1024px;
      margin: 0;
    }

    .modal-fix .modal-content {
      min-height: 100vh;
    }

    .modal .tab-content {
      min-height: 50vh;
    }

    .nav-pills.nav-wizard>li {
      position: relative;
      overflow: visible;
      border-right: 8px solid transparent;
      border-left: 8px solid transparent;
    }

    .nav-pills.nav-wizard>li+li {
      margin-left: 0;
    }

    .nav-pills.nav-wizard>li:first-child {
      border-left: 0;
    }

    .nav-pills.nav-wizard>li:first-child a {
      border-radius: 5px 0 0 5px;
    }

    .nav-pills.nav-wizard>li:last-child {
      border-right: 0;
    }

    .nav-pills.nav-wizard>li:last-child a {
      border-radius: 0 5px 5px 0;
    }

    .nav-pills.nav-wizard>li a {
      border-radius: 0;
      background-color: #eee;
    }

    .nav-pills.nav-wizard>li:not(:last-child) a:after {
      position: absolute;
      content: "";
      top: 0px;
      right: -20px;
      width: 0px;
      height: 0px;
      border-style: solid;
      border-width: 20px 0 20px 20px;
      border-color: transparent transparent transparent #eee;
      z-index: 150;
    }

    .nav-pills.nav-wizard>li:not(:first-child) a:before {
      position: absolute;
      content: "";
      top: 0px;
      left: -20px;
      width: 0px;
      height: 0px;
      border-style: solid;
      border-width: 20px 0 20px 20px;
      border-color: #eee #eee #eee transparent;
      z-index: 150;
    }

    .nav-pills.nav-wizard>li:hover:not(:last-child) a:after {
      border-color: transparent transparent transparent #aaa;
    }

    .nav-pills.nav-wizard>li:hover:not(:first-child) a:before {
      border-color: #aaa #aaa #aaa transparent;
    }

    .nav-pills.nav-wizard>li:hover a {
      background-color: #aaa;
      color: #fff;
    }

    .nav-pills.nav-wizard>li:not(:last-child) a.active:after {
      border-color: transparent transparent transparent #428bca;
    }

    .nav-pills.nav-wizard>li:not(:first-child) a.active:before {
      border-color: #428bca #428bca #428bca transparent;
    }

    .nav-pills.nav-wizard>li a.active {
      background-color: #428bca;
    }
  </style>
  <title>Sistem Antrian <?php echo $dataSettings['nama_instansi']; ?></title>
</head>

<body>
  <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-2">SISTEM ANTRIAN</h1>
    <h3 class="display-6"><?php echo $dataSettings['nama_instansi']; ?></h3>
    <h2 class="display-5">silahkan pilih menu antrian yang dituju dibawah ini</h2>
  </div>
  <br><br>
  <div class="container">
    <div class="row">
      <!-- <div class="col-6">
        <div class="card-deck mb-3 text-center">
          <div class="card mb-4 shadow-sm" data-toggle="modal" data-target="#antrian">
            <div class="card-body btn btn-lg btn-success">
              <ul class="list-unstyled mt-3 mb-4">
                <span style="font-size: 120px; color: white;"><i class="fas fa-users"></i></span>
              </ul>
              <a href="#" style="text-decoration: none; color: white;">
                <h1 class="display-4">PENDAFTARAN</h1>
              </a>
            </div>
          </div>
        </div>
      </div> -->
      <div class="col-6">
        <div class="card-deck mb-3 text-center">
          <div class="card mb-4 shadow-sm" data-toggle="modal" data-target="#antrian-farmasi">
            <div class="card-body btn btn-lg btn-danger">
              <ul class="list-unstyled mt-3 mb-4">
                <span style="font-size: 120px; color: white;"><i class="fas fa-capsules"></i></span>
              </ul>
              <a href="#" style="text-decoration: none; color: white;">
                <h1 class="display-4">FARMASI</h1>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center text-danger">
    <h3 class="display-6">Silahkan hubungi petugas jika anda mengalami kesulitan.</h3>
  </div>

  <!-- Modal Antrian -->
  <div class="modal fade" id="antrian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="pt-1 pb-1">
              <div id="printAntrianPendaftaran" style="display: none;" class="cetak">
                <div style="width: 180px; font-family: Tahoma; margin-top: 10px; margin-right: 5px; margin-bottom: 100px; margin-left: 15px; font-size: 21px !important;">
                  <div id="print_nomor_pendaftaran"></div>
                </div>
              </div>
              <div id="display_nomor_pendaftaran"></div>
              <form role="form" id="formloket" name="formloket">
                <button type="submit" class="btn btn-lg btn-danger btn-block" id="btnKRM" value="Submit" name="btnKRM" onclick="printDiv('printAntrianPendaftaran');">CETAK</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal cek no rawat farmasi -->
  <div class="modal fade" id="antrian-farmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="pt-1 pb-1">
              <div id="printAntrianFarmasi" style="display: none;" class="cetak">
                <div style="width: 180px; font-family: Tahoma; margin-right: 5px; margin-bottom: 100px; margin-left: 15px; font-size: 21px !important;">
                  <div id="print_nomor_farmasi"></div>
                  <br>
                  <br>
                </div>
              </div>
              <form role="form" id="form-norawat" name="formfarmasi">
                <div class="form-group">
                  <label>Nomor Rawat</label>
                  <input type="text" class="form-control" id="no_rawat" name="no_rawat" placeholder="Masukkan no. rawat" autofocus>
                  <div class="invalid-feedback">
                      Nomor Rawat tidak tersedia tidak bisa diproses.
                  </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block" id="btnCARI" value="Submit" name="btnCARI">Cari</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Farmasi -->
  <div class="modal fade" id="nomor-farmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="pt-1 pb-1">
              <div id="printAntrianFarmasi" style="display: none;" class="cetak">
                <div style="width: 180px; font-family: Tahoma; margin-top: 10px; margin-right: 5px; margin-bottom: 100px; margin-left: 15px; font-size: 21px !important;">
                  <div id="print_nomor_farmasi"></div>
                  ANTRIAN FARMASI
                </div>
              </div>
              <div id="display_nomor_farmasi"></div>
              <div id="display_nomor_farmasi1" style="display: none;"></div>
              <form role="form" id="formfarmasi" name="formfarmasi">
                <button type="submit" class="btn btn-lg btn-danger btn-block" id="btnKRMFAR" value="Submit" name="btnKRMFAR" onclick="printDiv('printAntrianFarmasi');">CETAK</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/gijgo.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $("#display_nomor_pendaftaran").load("get-antrian.php?aksi=tampilPendaftaran");
      $("#print_nomor_pendaftaran").load("get-antrian.php?aksi=printPendaftaran");
      $("#display_nomor_cs").load("get-antrian.php?aksi=tampilcs");
      $("#print_nomor_cs").load("get-antrian.php?aksi=printcs");
      $("#display_nomor_pr").load("get-antrian.php?aksi=tampilapotek");
      $("#print_nomor_pr").load("get-antrian.php?aksi=printapotek");
    })
  </script>
  <script>
    function printDiv(eleId) {
      var PW = window.open('', '_blank', 'Print content');
      //Use css for print style
      //PW.document.write('<style>.cetak {width: 250px; font-family: Tahoma; margin-top: 10px; margin-right: 5px; margin-bottom: 50px; margin-left: 5px; font-size: 11px !important;}</style>');
      PW.document.write(document.getElementById(eleId).innerHTML);
      PW.document.close();
      PW.focus();
      PW.print();
      PW.close();
      // Redirect after close
      window.location.href = "index.php";
    }
  </script>
  <script>
    function printSEP(eleId) {
      var PW = window.open('', '_blank', 'Print content');
      //Use css for print style
      PW.document.write('<link rel="stylesheet" href="../css/bootstrap.min.css">');
      PW.document.write(document.getElementById(eleId).innerHTML);
      PW.document.close();
      PW.focus();
      PW.print();
      PW.close();
      // Redirect after close
      window.location.href = "index.php";
    }
  </script>
  <script>
    $('body').on('shown.bs.modal', '#antrian-farmasi', function () {
        $("#no_rawat").val('');
        $('input:visible:enabled:first', this).focus();
    })

    function simulateError() {
        var no_rawat = document.getElementById("no_rawat");
        no_rawat.classList.remove("is-invalid");
        no_rawat.nextElementSibling.style.display = "none";
        no_rawat.classList.add("is-invalid");
        no_rawat.nextElementSibling.style.display = "block";
    }

    document.getElementById("form-norawat").addEventListener("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var no_rawat = document.getElementById("no_rawat").value;
        $.ajax({
            url: "get-antrian.php?aksi=check_norawat",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: function (response) {
              if (response.status) {
                $("#antrian-farmasi").modal("hide");
                $('#display_nomor_farmasi1').text(no_rawat.substring(no_rawat.length -4));
                $("#display_nomor_farmasi").load("get-antrian.php?aksi=tampilfarmasi&no_rawat=" + no_rawat);
                $("#print_nomor_farmasi").load("get-antrian.php?aksi=printfarmasi&no_rawat=" + no_rawat);
                $("#nomor-farmasi").modal("show");
              } else {
                simulateError();
              }
            },
        });
    });
</script>
<script>
document.getElementById("formfarmasi").addEventListener("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var no_rawat = document.getElementById("no_rawat").value;

    // Ambil tanggal dan waktu saat ini
    var currentDate = new Date();
    var tanggalCetak = currentDate.toISOString().split('T')[0]; // Format yyyy-mm-dd
    var waktuCetak = currentDate.toTimeString().split(' ')[0]; // Format HH:MM:SS

    // Tambahkan data tanggal dan waktu ke formData
    formData.append('tanggal_cetak', tanggalCetak);
    formData.append('waktu_cetak', waktuCetak);

    $.ajax({
        url: "get-antrian.php?aksi=simpanCetak", // Ganti dengan aksi untuk menyimpan data
        data: formData,
        method: 'POST',
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status) {
                // Lanjutkan ke proses cetak
                $("#nomor-farmasi").modal("hide");
                $('#display_nomor_farmasi1').text(no_rawat.substring(no_rawat.length - 4));
                $("#display_nomor_farmasi").load("get-antrian.php?aksi=tampilfarmasi&no_rawat=" + no_rawat);
                $("#print_nomor_farmasi").load("get-antrian.php?aksi=printfarmasi&no_rawat=" + no_rawat);
                $("#nomor-farmasi").modal("show");
            } else {
                alert('Error: Gagal menyimpan data cetak.');
            }
        },
    });
});
</script>
</body>

</html>