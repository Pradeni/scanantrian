<?php
  include ('../config.php');

  $tanggal = date("Y-m-d");

  $sql_loket = query("SELECT noantrian, type FROM antrian_loket WHERE postdate='$tanggal' AND type='Loket' AND status='panggil' ORDER BY noantrian ASC");
  $result_loket = fetch_assoc($sql_loket);

  if (isset($result_loket['noantrian']) != NULL) {
    $pendaftaran = $result_loket['noantrian'];
    $pendaftaran_tipe = $result_loket['type'];
  } else{
    $pendaftaran = "0";
    $pendaftaran_tipe = "Loket";
  }

  $sql_apotek = query("SELECT noantrian, type FROM antrian_loket WHERE postdate='$tanggal' AND type='Apotek' AND status = 'panggil' ORDER BY noantrian ASC");
  $result_apotek = fetch_assoc($sql_apotek);

  $result_apotek = fetch_assoc($sql_apotek);

  if (isset($result_apotek['noantrian']) != NULL) {
    $apotek = $result_apotek['noantrian'];
    $apotek_tipe = $result_loket['type'];
  } else{
    $apotek = "0";
    $apotek_tipe = "apotek";
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
  <div class="container-fluid">
    <h1 class="text-center text-white antrian_judul"><img class="logo" src="{?=url()?}/{$logo}" alt="" width="80px">Antrian Loket <?php echo $dataSettings['nama_instansi']; ?></h1>
    <div class="row loket">
      <div class="kiri">
        <div class="card bg-dark text-white">
          <div class="embed-responsive embed-responsive-16by9">
            <!--
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{$vidio}?rel=0&modestbranding=1&autohide=1&mute=0&showinfo=0&controls=1&loop=1&autoplay=1&playlist={$vidio}" allowfullscreen></iframe>
-->

<!--
<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/BWS1Pc5bdjc?rel=0&modestbranding=0&autohide=1&mute=1&showinfo=0&controls=0&fs=0&loop=1&playlist=BWS1Pc5bdjc&autoplay=1&cc_load_policty=0&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>   
-->

    <video style="position:absolute; top:0; left:0; width:100%; height:100%" loop="true" autoplay="true" mute="true">
        <source src="http://192.168.100.10/lite/custom/akreditasi.mp4">
    </video>
          </div>
        </div>
      </div>
      <div class="kanan">
          <a href="panggil.php?show=<?= $pendaftaran_tipe; ?>" target="_blank">
            <div class="panel border-success">
              <div class="panel-body text-success">
                <div class="no_antrian">A<?= $pendaftaran; ?><span class="antrian_loket"><span></div>
              </div>
              <div class="panel-footer bg-transparent border-success">
                <div class="no_loket">Pendaftaran</div>
              </div>
            </div>
          </a>
          <a href="panggil.php?show=<?= $apotek_tipe; ?>" target="_blank">
            <div class="panel border-success">
              <div class="panel-body text-success">
                <div class="no_antrian">B<?= $apotek; ?><span class="antrian_cs"><span></div>
              </div>
              <div class="panel-footer bg-transparent border-success">
                <div class="no_loket">Farmasi</div>
                </div>
            </div>
          </a>
          <div class="panel border-success">
            <div class="panel-body text-success">
              <div class="date">
                <script type='text/javascript'>
                  <!--
                  var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                  var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                  var date = new Date();
                  var day = date.getDate();
                  var month = date.getMonth();
                  var thisDay = date.getDay(),
                      thisDay = myDays[thisDay];
                  var yy = date.getYear();
                  var year = (yy < 1000) ? yy + 1900 : yy;
                  document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                  //-->
                </script>
              </div>
            </div>
            <div class="panel-footer border-success" style="background-color:#ffcc00;">
              <div class="clock"><span id="clock"><span></div>
            </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="panel-title marquee">
        <marquee>Ini adalah teks berjalan</marquee>
      </div>
    </div>
<script>
