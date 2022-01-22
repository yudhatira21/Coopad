<?php  
error_reporting(0);
include '../../../function.php';

$judul_cerita = $_POST['judul_cerita'];
$sinopsis = $_POST['deskripsi'];
$status = $_POST['id_status'];
$img = $_FILES['sampul_cerita'];
$id_cerita = $_POST['id_cerita'];
$id_users = $_SESSION['users']['id_users'];

$explode = explode('deskripsi=', $sinopsis);
$isi = urldecode($explode[1]);


$cek = $func->edit_cerita($judul_cerita, $isi, $img, $status, $id_cerita, $id_users);

if ($cek == "success_edit") {
	$data['status'] = 0;
	$data['msg']   = 'Success edit cerita';
	die(json_encode($data));
}





?>