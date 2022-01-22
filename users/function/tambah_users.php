<?php 
include '../../function.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$id_roles = $_POST['id_roles'];


if ($nama == "" || $email == "" || $password == "") {
	$data['status'] = 3;
	$data['msg']   = 'Terdapat form yang kosong, pastikan form telah terisi dengan benar.';
	die(json_encode($data));
} else {

	if (strlen($password) > 8) {
		$tambah = $func->tambah_users($nama,$email,$password,$id_roles);

		if ($tambah == 'success_register') {
			$data['status'] = 0;
			$data['msg']   = 'Success tambah users<br><br>Nama : '.$nama.'<br>Email : '.$email.'<br>Password : '.$password;
			die(json_encode($data));
		} else{
			$data['status'] = 2;
			$data['msg']   = 'Email tersebut telah terdaftar!';
			die(json_encode($data));
		}
	} else {
		$data['status'] = 1;
		$data['msg']   = 'Password kurang dari 8 karakter!';
		die(json_encode($data));
	}
}







?>