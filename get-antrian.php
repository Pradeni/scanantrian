<?php
include ('config.php');

$aksi = $_REQUEST['aksi'] ?? $_GET['aksi'] ?? '';

$tanggal = date('d');
$bulan   = date('m');
$tahun   = date('Y');

if ($aksi == "tampilPendaftaran") {
    // Gunakan prepared statement secara aman
    $stmt = $connection->prepare("
        SELECT * FROM antrian_loket 
        WHERE DAY(postdate) = ? 
        AND MONTH(postdate) = ? 
        AND YEAR(postdate) = ? 
        AND type = 'Pendaftaran' 
        ORDER BY noantrian DESC 
        LIMIT 1
    ");

    // Pastikan binding parameternya integer (i)
    $stmt->bind_param('iii', $tanggal, $bulan, $tahun);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $noantrian = isset($row) ? $row['noantrian'] : 0;
    $next_antrian = ($noantrian > 0) ? $noantrian + 1 : 1;

    echo '<div id="nomernya" align="center">';
    echo '<h1 class="display-1">A' . $next_antrian . '</h1>';
    echo '[' . $tanggal . '-' . $bulan . '-' . $tahun . ']';
    echo '</div>';

    $stmt->close(); // tutup prepared statement
    $connection->close(); // tutup koneksi
    exit();
}

if ($aksi === 'simpanCetak') {
    $no_rawat      = $_POST['no_rawat'] ?? '';
    $tanggal_cetak = $_POST['tanggal_cetak'] ?? '';
    $waktu_cetak   = $_POST['waktu_cetak'] ?? '';

    // Validasi format waktu cetak (HH:MM:SS)
    if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $waktu_cetak)) {
        echo json_encode([
            'status' => false,
            'message' => 'Format waktu tidak valid: ' . htmlspecialchars($waktu_cetak),
        ]);
        exit;
    }

    // Validasi format tanggal cetak (YYYY-MM-DD)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_cetak)) {
        echo json_encode([
            'status' => false,
            'message' => 'Format tanggal tidak valid',
        ]);
        exit;
    }

    // Simpan ke database dengan prepared statement
    $query = "INSERT INTO antrian_scan (no_rawat, tanggal_cetak, waktu_cetak) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);

    if ($stmt) {
        $stmt->bind_param('sss', $no_rawat, $tanggal_cetak, $waktu_cetak);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => true,
                'message' => 'WAKTU BERHASIL DIKIRIM',
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Gagal menyimpan data',
                'error' => $stmt->error,
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Kesalahan pada persiapan query: ' . $connection->error,
        ]);
    }

    $connection->close();
    exit;
}


if ($aksi == 'check_norawat') {
	header('Content-Type: application/json');
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$no_rawat = $_POST["no_rawat"];
		$sql = query("SELECT * FROM resep_obat WHERE no_rawat = '$no_rawat' ORDER BY tgl_peresepan DESC LIMIT 1");
		$result = fetch_assoc($sql);
		if (isset($result)){
			echo json_encode(['status' => true]);
		} else{
			echo json_encode(['status' => false]);
		}
	} else {
		echo json_encode(['status' => false]);
	}
}

if ($aksi == "printPendaftaran") {
  //ketahui jumlah total sehari...
	$sql = query("SELECT * FROM antrian_loket WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' AND type = 'Pendaftaran' ORDER BY round(noantrian) DESC");
	$result = fetch_assoc($sql);
	if (isset($result)){
		$noantrian = $result['noantrian'];
	} else{
		$noantrian = "0";
	}
	//nomor antrian, total yang ada + 1
	if($noantrian > 0) {
		$next_antrian = $noantrian + 1;
	} else {
		$next_antrian = 1;
	}
	echo '<div id="nomernya" align="center">';
  echo '<h1 class="display-1">';
  echo 'A'.$next_antrian;
  echo '</h1>';
  echo '['.$tanggal.'-'.$bulan.'-'.$tahun.']';
  echo '<br>';
  echo '<div style="margin-top: 10px;">ANTRIAN PENDAFTARAN</div>';
  echo '</div>';
  echo '<br>';
  echo '<p class="text-center">.</p>';

	?>

	<script>
	$(document).ready(function(){
		$("#btnKRM").on('click', function(){
			$("#formloket").submit(function(){
				$.ajax({
					url: "get-antrian.php?aksi=simpanPendaftaran&noantrian=<?php echo $next_antrian;?>",
					type:"POST",
					data:$(this).serialize(),
					success:function(data){
						setTimeout('$("#loading").hide()',1000);
						window.location.href = "index.php";
						}
					});
				return false;
			});
		});
	})
	</script>
	<?php
	exit();
}

//jika simpan
if ($aksi == "simpanPendaftaran") {
	//ambil nilai
	$noantrian = $_GET['noantrian'];
	//cek
	//$sql = query("SELECT * FROM antrian_loket WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' AND noantrian = '$noantrian' AND type = 'Loket'");
	//if (empty(num_rows($sql))) {
		query("INSERT INTO antrian_loket(kd, type, noantrian, postdate, start_time, end_time) VALUES (NULL, 'Pendaftaran', '$noantrian', '$date_time', CURRENT_TIME(), '00:00:00')");
	//}
	?>
	<?php
	exit();
}

if ($aksi == "tampilcs") {
	  //ketahui jumlah total sehari...
		$sql = query("SELECT * FROM antrian_loket WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' AND type = 'CS' ORDER BY round(noantrian) DESC");
		$result = fetch_assoc($sql);
		$noantrian = $result['noantrian'];
		//nomor antrian, total yang ada + 1
		if($noantrian > 0) {
			$next_antrian = $noantrian + 1;
		} else {
			$next_antrian = 1;
		}
		echo '<div id="nomernya" align="center">';
	  echo '<h1 class="display-1">';
	  echo 'B'.$next_antrian;
	  echo '</h1>';
	  echo '['.$tanggal.'-'.$bulan.'-'.$tahun.']';
	  echo '</div>';
	  echo '<br>';

		exit();
}

if ($aksi == "printcs") {
	  //ketahui jumlah total sehari...
		$sql = query("SELECT * FROM antrian_loket WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' AND type = 'CS' ORDER BY round(noantrian) DESC");
		$result = fetch_assoc($sql);
		$noantrian = $result['noantrian'];
		//nomor antrian, total yang ada + 1
		if($noantrian > 0) {
			$next_antrian = $noantrian + 1;
		} else {
			$next_antrian = 1;
		}
		echo '<div id="nomernya" align="center">';
	  echo '<h1 class="display-1">';
	  echo 'B'.$next_antrian;
	  echo '</h1>';
	  echo '['.$tanggal.'-'.$bulan.'-'.$tahun.']';
	  echo '</div>';
	  echo '<br>';

		?>

		<script>
		$(document).ready(function(){
			$("#btnKRMCS").on('click', function(){
				$("#formcs").submit(function(){
					$.ajax({
						url: "get-antrian.php?aksi=simpancs&noantrian=<?php echo $next_antrian;?>",
						type:"POST",
						data:$(this).serialize(),
						success:function(data){
							setTimeout('$("#loading").hide()',1000);
							window.location.href = "index.php";
							}
						});
					return false;
				});
			});
		})
		</script>
		<?php
		exit();
}

//jika simpan
if ($aksi == "simpancs") {
	//ambil nilai
	$noantrian = $_GET['noantrian'];
	//cek
	$sql = query("SELECT * FROM antrian_loket WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' AND noantrian = '$noantrian' AND type = 'CS'");
	if (empty(num_rows($sql))) {
		query("INSERT INTO antrian_loket(kd, type, noantrian, postdate, start_time, end_time) VALUES (NULL, 'CS', '$noantrian', '$date_time', CURRENT_TIME(), '00:00:00')");
	}
	?>
	<?php
	exit();
}

if ($aksi == "tampilfarmasi" && $_REQUEST['no_rawat'] != null) {
	
	$no_rawat = $_REQUEST['no_rawat'];
	$sql = query("SELECT * FROM resep_obat WHERE no_rawat = '$no_rawat' ORDER BY tgl_peresepan DESC LIMIT 1");
	$result = fetch_assoc($sql);
	if (isset($result)){
		$check_racikan = query("SELECT * FROM resep_dokter_racikan WHERE no_resep = ".$result['no_resep']." LIMIT 1");
		$result_racikan = fetch_assoc($check_racikan);
		$tipe_antrian = empty($result_racikan) ? 'Non-Racikan' : 'Racikan';
		$noantrian = $result['no_resep'];
	} else{
		$noantrian = "0000";
		$tipe_antrian = '-';
	}

	echo '<div id="nomernya" align="center">';
	echo '<h1 class="display-1">';
	echo ''.$noantrian.'';
	echo '</h1>';
	echo '['.$tanggal.'-'.$bulan.'-'.$tahun.']';
	echo '<br>';
	echo '<div style="margin-top: 10px;">NOMOR RESEP</div>';
	echo '<div style="margin-top: 15px;">'.$tipe_antrian.'</div>';
	echo '</div>';
	echo '<br>';
	exit();
}

if ($aksi == "printfarmasi" && isset($_REQUEST['no_rawat'])) {
    $no_rawat = $_REQUEST['no_rawat'];

    // Validasi dan ambil data
    $stmt = $connection->prepare("SELECT * FROM resep_obat WHERE no_rawat = ? ORDER BY tgl_peresepan DESC LIMIT 1");
    $stmt->bind_param("s", $no_rawat);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $noantrian = "0000";
    $tipe_antrian = '-';
    if ($result) {
        $no_resep = $result['no_resep'] ?? null;
        if ($no_resep) {
            $stmt_racikan = $connection->prepare("SELECT * FROM resep_dokter_racikan WHERE no_resep = ? LIMIT 1");
            $stmt_racikan->bind_param("s", $no_resep);
            $stmt_racikan->execute();
            $result_racikan = $stmt_racikan->get_result()->fetch_assoc();
            $tipe_antrian = $result_racikan ? 'Racikan' : 'Non-Racikan';
        }
        $noantrian = $result['no_resep'];
    }

    echo "<html><head><title>Cetak Antrian Farmasi</title></head><body style='font-family: Arial;'>";
    echo "<div align='center'>";
    echo "<h1 style='font-size: 48px;'>$noantrian</h1>";
    echo "<p>" . date('d-m-Y') . "</p>";
    echo "<p>NOMOR RESEP</p>";
    echo "<p>$tipe_antrian</p>";
    echo "</div>";
    echo "</body></html>";
    exit();
}


//jika simpan
if ($aksi == "simpanfarmasi") {
	//ambil nilai
	$noantrian = $_GET['noantrian'];
	//cek
	$sql = query("SELECT * FROM antrian_loket WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' AND noantrian = '$noantrian' AND type = 'Farmasi'");
	if (empty(num_rows($sql))) {
		query("INSERT INTO antrian_loket(kd, type, noantrian, postdate, start_time, end_time) VALUES (NULL, 'Farmasi', '$noantrian', '$date_time', CURRENT_TIME(), '00:00:00')");
	}
	?>
	<?php
	exit();
}
?>
