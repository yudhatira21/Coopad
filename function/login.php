<?php  
include '../function.php';


$email = $_POST['email'];
$password = $_POST['password'];


if ($email == "" || $password == "") {
	$data['status'] = 1;
	$data['msg']   = 'Email atau password tidak boleh kosong!';
	die(json_encode($data));
} else {
	$login = $func->login($email, $password);

	if ($login == "success_login") {
		$aktivitas = $func->getUserIpAddr().'Anda Berhasil Login - '.$_SERVER['HTTP_USER_AGENT'];
		$func->tambah_aktivitas($aktivitas, $_SESSION['users']['id_users']);

		$data['status'] = 0;
		$data['msg']   = 'Success login!';
		die(json_encode($data));
	} else {
		$data['status'] = 3;
		$data['msg']   = 'Email atau password salah!';
		die(json_encode($data));
	}
}