<?php  
session_start();
date_default_timezone_set('Asia/Jakarta');

$mysqli = new mysqli('localhost', 'root', '', 'news');

class menu
{
	
	function __construct($mysqli) {
		$this->con = $mysqli;
	}

	function login($email, $password) {
		$qlogin = $this->con->query("SELECT * FROM users JOIN roles ON users.id_roles = roles.id_roles WHERE email = '$email' AND password = '$password'");
		$cek_rows = mysqli_num_rows($qlogin);

		if ($cek_rows > 0) {
			$break = $qlogin->fetch_assoc();
			$_SESSION['users'] = $break;
			return 'success_login';
		} else {
			return 'failed_login';
		}
	}

	function register($name, $email, $password) {
		$qcek = $this->con->query("SELECT * FROM users WHERE email = '$email'");
		$cek_rows = mysqli_num_rows($qcek);

		if ($cek_rows > 0) {
			return 'already_register';
		} else {
			$id_roles_default = 2;
			$this->con->query("INSERT INTO users(name,email,password,id_roles) VALUES ('$name','$email','$password','$id_roles_default')");
			return 'success_register';
		}
	}



}

$func = new menu($mysqli);
