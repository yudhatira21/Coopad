<?php 
error_reporting(0); 
include '../../../function.php';

$date = date('y-m-d');


$judul = $_POST['judul_cerita'];
$desk = $_POST['deskripsi'];
$img = $_FILES['fileupload'];
$id_status = $_POST['id_status'];
$id_users = $_SESSION['users']['id_users'];

if ($judul == "" || $desk == "" || $img == "" || $id_status == "" || $id_users == "") {
	$data['status'] = 3;
	$data['msg']   = 'Terdapat form yang kosong, pastikan form telah terisi dengan benar.';
	die(json_encode($data));
} else {

	$explode = explode('deskripsi=', $desk);
	$isi = urldecode($explode[1]);
	
	$cek = $func->tambah_cerita($judul,$isi,$img, $id_status, $id_users, $date);

	if ($cek = "success_upload") {
		$data['status'] = 0;
		$data['msg']   = 'Berhasil membuat cerita!';
		die(json_encode($data));
	} else if ($cek = "ukuran_besar") {
		$data['status'] = 1;
		$data['msg']   = 'Ukuran file size terlalu besar!';
		die(json_encode($data));
	} else {
		$data['status'] = 2;
		$data['msg']   = 'Gagal mengunggah foto, silahkan coba lagi!';
		die(json_encode($data));
	}
}



?>