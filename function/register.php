<?php  
include '../function.php';


$name = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];


if ($email == "" || $password == "" || $name == "") {

	$data['status'] = 1;
	$data['msg']   = 'Terdapat form yang kosong!';
	die(json_encode($data));
	
} else {

	if (strlen($password) > 8) {

		$login = $func->register($name, $email, $password);

		if ($login == "success_register") {
			$data['status'] = 0;
			$data['msg']   = 'Berhasil daftar akun! silahkan login akun anda.';
			die(json_encode($data));
		} else {
			$data['status'] = 3;
			$data['msg']   = 'Akun dengan email tersebut telah terdaftar!';
			die(json_encode($data));
		}

	} else {
		$data['status'] = 2;
		$data['msg']   = 'Minimal password 8 karakter';
		die(json_encode($data));
	}
	
}