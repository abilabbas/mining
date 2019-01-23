<?php
// Date Function
function date_year() {
	$date = date("Y");
	for($i=2017;$i<=$date;$i++){
		echo "<option value='$i'>$i</option>";
	}
}

function date_day() {
	for($tgl=1; $tgl<=31; $tgl++){
    $tgl_leng=strlen($tgl);
    if ($tgl_leng==1)
    $i="0".$tgl;
    else
    $i=$tgl;
    echo "<option value='$i'>$i</option>";}
}

function date_month() {
	$bln = array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
	for($bulan=1; $bulan<=12; $bulan++){
    if ($bulan_leng==1)
    $i='0'.$bulan;
    else
    $i=$bulan;
	echo "<option value='$bulan'>$bln[$bulan]</option>";}
}
?>


