<?php  
error_reporting(0);
include '../../../function.php';

$judul_chapter = $_POST['judul_chapter'];
$isi_chapter = $_POST['isi_chapter'];
$id_chapter = $_POST['id_chapter'];

$explode = explode('isi_chapter=', $isi_chapter);
$isi = urldecode($explode[1]);


$cek = $func->edit_chapter($id_chapter, $judul_chapter, $isi);

if ($cek == "success_edit") {
	$data['status'] = 0;
	$data['msg']   = 'Success edit cerita';
	die(json_encode($data));
}



?>