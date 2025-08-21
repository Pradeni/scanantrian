<?php
  include ('../config.php');
  if ($_GET['show'] == "Loket"){
  	$antrian = $_GET['show'];
  	$tanggal = date("Y-m-d");

	$sql_loket = query("SELECT kd, noantrian, type FROM antrian_loket WHERE postdate='$tanggal' AND type='$antrian' AND status = 'panggil' ORDER BY noantrian ASC");
	$result_loket = fetch_assoc($sql_loket);

	if (isset($result_loket['noantrian']) != NULL) {
	    $noantrian = $result_loket['noantrian'];
	    $id        = $result_loket['kd'];
	} else{
	    $noantrian = "0";
	    $id        = $result_loket['kd'];
	}

	$sql_hitungloket = query("SELECT COUNT(noantrian) as jml FROM antrian_loket WHERE postdate='$tanggal' AND type='$antrian' AND status = 'antri' ORDER BY noantrian ASC");
	$hitungloket = fetch_assoc($sql_hitungloket);

  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $dataSettings['nama_instansi']; ?></title>
    <link rel="icon" href="{{?=url()?}/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <script src="assets/jscripts/jquery.min.js"></script>
    <script src="assets/jscripts/bootstrap.min.js"></script>
    <style media="screen">
      body {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        color: #fff;
        background: #0264d6;
        height:calc(100vh);
        width:100%;
      }
      .antrian_judul {
        font-size:56px;
        padding-bottom:20px;
      }
      .loket {
        padding: 0;
      }
      .loket a {
        text-decoration: none;
      }
      .kiri {
        float: left;
        width:80%;
        padding: 10px;
      }
      .kanan {
        float: right;
        width:20%;
        padding: 10px;
      }
      .panel-body .no_antrian {
        font-size:100px;
        font-weight:lighter;
        padding:0;
        margin-top:-45px;
        margin-bottom:-45px;
      }
      .panel-footer .no_loket {
        font-size:40px;
        color: #000;
        padding-top:0;
        padding-bottom:0;
      }
      .panel-body .date {
        font-size:21px;
        color: #FF0000;
        font-weight:lighter;
        padding-top:5px;
        padding-bottom:5px;
        margin-top:-20px;
        margin-bottom:-25px;
      }
      .panel-footer .clock {
        font-size:26px;
        color: #000;
        padding-top:0;
        padding-bottom:0;
      }
      .panel-title.marquee {
         font-size:36px;
         padding-top: 10px;
         padding-bottom: 0px;
         margin-top: 10px;
         margin-bottom: 10px;
         color: #FF0000;
         background-color: #fff;
      }
      footer {
          position: fixed;
          right: 0px;
          bottom: 0px;
          height: 40px;
          width: calc(100% - 0px);
          font-size: 14px;
          color: #fff;
      }
      footer a, footer a:hover {
        color: #fff;
      }
    </style>
</head>
<body>
	<audio id="antrian" src="{?=url()?}/plugins/anjungan/suara/antrian.wav"></audio>
	<audio id="notif" src="{?=url()?}/plugins/anjungan/suara/notification.wav"></audio>
	<audio id="{$namaloket}" src="{?=url()?}/plugins/anjungan/suara/{$namaloket}.wav"></audio>
	<audio id="counter" src="{?=url()?}/plugins/anjungan/suara/counter.wav"></audio>
	<audio id="nol" src="{?=url()?}/plugins/anjungan/suara/nol.wav"></audio>
	<audio id="belas" src="{?=url()?}/plugins/anjungan/suara/belas.wav"></audio>
	<audio id="sebelas" src="{?=url()?}/plugins/anjungan/suara/sebelas.wav"></audio>
	<audio id="puluh" src="{?=url()?}/plugins/anjungan/suara/puluh.wav"></audio>
	<audio id="sepuluh" src="{?=url()?}/plugins/anjungan/suara/sepuluh.wav"></audio>
	<audio id="ratus" src="{?=url()?}/plugins/anjungan/suara/ratus.wav"></audio>
	<audio id="seratus" src="{?=url()?}/plugins/anjungan/suara/seratus.wav"></audio>
   	<audio id="suarabelloket{$value}" src="{?=url()?}/plugins/anjungan/suara/pendaftaran.wav"></audio>
    <audio id="suarabelloket{$value}" src="{?=url()?}/plugins/anjungan/suara/farmasi.wav"></audio>
    <div align="center" style="font-size: 64px;color:white; text-shadow: 2px 2px 4px #000000;margin:30px;"><img class="logo" src="{?=url()?}/{$logo}" alt="" width="80px"> Pemanggil Antrian Loket</div>
    <div class="container text-center">
        <div class="row">
      		<div class="card-deck">
  				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-5">
<?php
	if ($antrian == "Loket") {
?>	
  				    <div class="panel" style="color:#000;">
			        	<div class="panel-heading" style="font-size:32px;">Loket Pendaftaran</div>
  				    <div class="panel-body">
  						<h5 class="panel-title" style="font-size:72px;">A<?= $noantrian; ?></h5>
  				    </div>
  				    <div class="panel-footer">
  						<div class="btn-group btn-group-justified">
  							<a href="#" class="btn btn-primary" style="font-size:32px;"><?= $hitungloket['jml']; ?></a>
  							<a href="proses.php?show= &loket= " class="btn btn-primary" style="font-size:32px;"><i class="fa fa-bullhorn" onclick=""></i></a>
  							<a href="{?=url()?}/anjungan/loket?show={$panggil_loket}&loket={$value}" class="btn btn-primary" style="font-size:32px;"><i class="fa fa-forward"></i></a>
  						</div>
  				    </div>
<?php
  	} else if ($antrian == "Apotek"){
?>
					<div class="panel" style="color:#000;">
			        	<div class="panel-heading" style="font-size:32px;">Loket Pendaftaran</div>
			        	<div class="panel-heading" style="font-size:32px;">Loket Farmasi</div>
  				    <div class="panel-body">
  						<h5 class="panel-title" style="font-size:72px;">A<?= $noantrian; ?></h5>
  				    </div>
  				    <div class="panel-footer">
  						<div class="btn-group btn-group-justified">
  							<a href="#" class="btn btn-primary" style="font-size:32px;"></a>
  							<a href="#" class="btn btn-primary" style="font-size:32px;"><i class="fa fa-bullhorn" onclick=""></i></a>
  							<a href="{?=url()?}/anjungan/loket?show={$panggil_loket}&loket={$value}" class="btn btn-primary" style="font-size:32px;"><i class="fa fa-forward"></i></a>
  						</div>
  				    </div>
<?php
  	}
?>
  				  </div>
  				</div>
      		</div>
      	</div>
      </div>
      <div class="text-center" style="width: 300px;margin: 20px auto;">
        <form action="">
          <input type="hidden" name="show" value="{$panggil_loket}">
          <input type="hidden" name="reset" value="{?=isset($_GET['loket'])?$_GET['loket']:'1'?}">
          <div class="row">
            <div class="col">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control form-control-lg" name="antrian" placeholder="Input Nomor Antrian">
                    <span class="input-group-btn"><!-- Append button addon using class input-group-lg -->
                        <button class="btn btn-danger" type="submit">Reset</button>
                    </span>
                </div>
            </div>
          </div>
        </form>
      </div>

      <div class="text-center text-white" style="font-size:20px;">
        # Klik 1X Tombol <i class="fa fa-forward"></i> Untuk Antrian Nomor Urut Selanjutnya dan Klik Tombol <i class="fa fa-bullhorn"></i> Untuk Memanggil </br>
        # Untuk Menyesuaikan Urutan, Masukan Nomor Urut Yang Akan dipanggil kemudian Klik RESET 1X dan Tombol <i class="fa fa-forward"></i> 1X</br>
        # Untuk Reset Nomor Antrian, masukkan nomor antrian, Klik RESET 1X dan Tombol <i class="fa fa-forward"></i> 1X</br>
        # Angka di Sebelah Kiri Tombol Pemanggil Menunjukan Jumlah Nomor Antrian Yang Telah diambil Pasien</br>
      </div>
  </div>
</body>
</html>