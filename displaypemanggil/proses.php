<?php 
	include ('../config.php');

	if ($_GET['show'] == "Loket"){
  	$antrian = $_GET['show'];
  	$status  = "panggil";

	$sql_loket = query("SELECT noantrian, type FROM antrian_loket WHERE postdate='$tanggal' AND type='$antrian' AND status = 'panggil' ORDER BY noantrian ASC");
	$result_loket = fetch_assoc($sql_loket);

	header("panggil.php?show=".$antrian);

  }
?>