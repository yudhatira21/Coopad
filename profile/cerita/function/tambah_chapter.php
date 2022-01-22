<?php 
include '../../../function.php';


$date = date('y-m-d');

$judul = $_POST['judul_chapter'];
$desk = $_POST['isi_chapter'];
$id_cerita = $_POST['id_cerita'];


if ($judul == "" || $desk == "" || $id_cerita == "") {
	$data['status'] = 3;
	$data['msg']   = 'Terdapat form yang kosong, pastikan form telah terisi dengan benar.';
	die(json_encode($data));
} else {

	$explode = explode('isi_chapter=', $desk);
	$isi = urldecode($explode[1]);
	$cek = $func->tambah_chapter($judul,$isi,$id_cerita,$date);

	if ($cek = "success_tambah") {
		$data['status'] = 0;
		$data['msg']   = 'Berhasil membuat chapter!';
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