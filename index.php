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
  <h1 class="display-2" style="font-weight: bold;">SCAN ANTRIAN</h1>
    <h3 class="display-6"><?php echo $dataSettings['nama_instansi']; ?></h3>
    <h2 class="display-5">Scan Bukti Register Untuk Mencetak No.Resep</h2>
  </div>
  <br><br>
  <div class="container">
    <div class="row">
      <div class="col-6">
        <!-- <div class="card-deck mb-3 text-center">
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
        </div> -->
      </div>
      <div class="col-8 mx-auto">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm" data-toggle="modal" data-target="#antrian-farmasi">
      <div class="card-body btn btn-lg btn-success">
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

      <!-- <div class="col-6">
      </div> -->
    </div>
  </div>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center text-danger">
    <h3 class="display-6">Silahkan Hubungi Petugas Jika Mengalami Kesulitan</h3>
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
                        <form role="form" id="form-norawat" name="formfarmasi">
                            <div class="form-group">
                                <label>Nomor Rawat</label>
                                <input type="text" class="form-control" id="no_rawat" name="no_rawat" placeholder="Masukkan no. rawat" required autofocus>
                                <div class="invalid-feedback">
                                    Nomor Rawat tidak tersedia atau tidak bisa diproses.
                                </div>
                            </div>
                            <!-- Hidden Input untuk Tanggal dan Waktu Cetak -->
                            <input type="hidden" id="tanggal_cetak" name="tanggal_cetak">
                            <input type="hidden" id="waktu_cetak" name="waktu_cetak">
                            <button type="submit" class="btn btn-lg btn-primary btn-block" id="btnCARI">Cari</button>
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
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/gijgo.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        // Muat data otomatis jika dibutuhkan
        $("#display_nomor_pendaftaran").load("get-antrian.php?aksi=tampilPendaftaran");
        $("#print_nomor_pendaftaran").load("get-antrian.php?aksi=printPendaftaran");
        $("#display_nomor_pr").load("get-antrian.php?aksi=tampilapotek");
        $("#print_nomor_pr").load("get-antrian.php?aksi=printapotekk");
    });

    // Konversi waktu ke format 24 jam
    function convertTo24HourFormat(time12hr) {
        const [time, modifier] = time12hr.split(' ');
        let [hours, minutes, seconds] = time.split(':');

        if (modifier === 'PM' && hours < 12) {
            hours = parseInt(hours) + 12;
        } else if (modifier === 'AM' && hours == 12) {
            hours = 0;
        }

        return `${hours.toString().padStart(2, '0')}:${minutes}:${seconds}`;
    }

    // Penanganan Form Nomor Rawat
    // Penanganan Form Nomor Rawat
document.getElementById("form-norawat").addEventListener("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var no_rawat = document.getElementById("no_rawat").value;

    // Ambil tanggal dan waktu
    var tanggal_cetak = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
    var waktu_cetak = new Date().toLocaleTimeString('en-GB'); // Format HH:MM:SS dalam 24 jam

    // Simpan data dalam formData
    formData.append("tanggal_cetak", tanggal_cetak);
    formData.append("waktu_cetak", waktu_cetak);

    $.ajax({
        url: "get-antrian.php?aksi=simpanCetak",
        data: formData,
        method: 'POST',
        processData: false,
        contentType: false,
        success: function (response) {
            if (typeof response === 'string') {
                response = JSON.parse(response);
            }

            if (response.status) {
                alert(response.message); // Tampilkan pesan sukses

                // Muat konten antrian farmasi untuk dicetak
                $.ajax({
                    url: "get-antrian.php",
                    method: "GET",
                    data: { aksi: "printfarmasi", no_rawat: no_rawat },
                    success: function (htmlContent) {
                        var printWindow = window.open('', '_blank', 'width=400,height=600');
                        printWindow.document.write(htmlContent); // Tulis konten untuk dicetak
                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();

                        // Redirect setelah cetak
                        window.location.href = "index.php";
                    },
                    error: function (xhr, status, error) {
                        alert('Gagal memuat data antrian farmasi: ' + error);
                    }
                });
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            alert('Terjadi kesalahan: ' + error);
        }
    });
});

</script>
