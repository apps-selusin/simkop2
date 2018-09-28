<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function f_TanggalAngsuran($sTanggal, $sTgl) {
	$akhir_bulan = 0;
	$dBln2829 = array(2);
	$dBln30 = array(4, 6, 9, 11);
	$dBln31 = array(1, 3, 5, 7, 8, 10, 12);

	//$dTgl = date("j", strtotime($sTanggal));
	$dTgl = $sTgl; //date("j", strtotime($sTanggal));
	$dBln = date("n", strtotime($sTanggal));
	$dThn = date("Y", strtotime($sTanggal));

	// check apakah bulan kontrak adalah desember
	if  ($dBln == 12) {
		$dBln = "01";
		$dThn++;
	}
	else {
		$dBln++;
	}
	if ($dTgl >= 1 and $dTgl <= 27) {
	}
	else {
		if (($dTgl == 28 or $dTgl == 29) and in_array($dBln, $dBln2829)) {
			$akhir_bulan = 1;
		}
		elseif ($dTgl == 30 and in_array($dBln, $dBln30)) {
			$akhir_bulan = 1;
		}
		elseif ($dTgl == 31 and in_array($dBln, $dBln31)) {
			$akhir_bulan = 1;
		}
	}
	if ($akhir_bulan == 0) { //$akhir_bulan = 0 (bukan tanggal akhir bulan)
		do {
			$hasil_check = checkdate(
				substr("00".$dBln, -2),
				substr("00".$dTgl, -2),
				$dThn
				);
			$sTanggalAngsuran = $dThn . "-" . substr("00".$dBln, -2) . "-" . substr("00".$dTgl, -2);
			/*echo substr("00".$dBln, -2).substr("00".$dTgl, -2).$dThn;
			echo " - ";
			echo $hasil_check;
			echo "<br/>";*/
			$dTgl--;
		}
		while ($hasil_check == false);
	}
	else { //$akhir_bulan = 1;
		$sTanggalAngsuran = $dThn . "-" . substr("00".$dBln, -2) . "-" . date("t", mktime(0, 0, 0, $dBln, 1, $dThn));
	}

	//echo $akhir_bulan;
	return $sTanggalAngsuran;
}

function f_updatesaldotitipan($pinjaman_id) {
	$q = "select * from t06_pinjamantitipan where pinjaman_id = ".$pinjaman_id."
		order by id";
	$r = Conn()->Execute($q);
	$saldo = 0;
	while (!$r->EOF) {
		$saldo = $saldo + $r->fields["Masuk"] - $r->fields["Keluar"];
		$q = "update t06_pinjamantitipan set Sisa = ".$saldo." where id = ".$r->fields["id"]."";
		Conn()->Execute($q);
		$r->MoveNext();
	}
}
?>
