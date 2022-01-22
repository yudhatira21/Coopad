<?php 
include '../function.php';

$id_cerita = $_POST['id_cerita'];
$komentar = $_POST['komentar'];
$id_users = $_SESSION['users']['id_users'];
$date = date('y-m-d');


if ($id_cerita == "" || $komentar == "" || $id_users == "") {
	$data['status'] = 1;
	$data['msg']   = 'Terdapat form yang kosong, pastikan form telah terisi dengan benar.';
	die(json_encode($data));
} else {


	$tambah = $func->komentar_cerita($komentar, $id_users, $id_cerita, $date);

	$data['status'] = 0;
	$data['msg']   = 'Success menambahkan komentar';
	die(json_encode($data));


}




?>