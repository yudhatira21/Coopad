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

	function tampil_cerita($id_users) {
		$data = array();
		$qcerita = $this->con->query("SELECT * FROM cerita JOIN status ON cerita.id_status = status.id_status JOIN users ON cerita.id_users = users.id_users WHERE cerita.id_users = '$id_users'");

		while($break = $qcerita->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}

	function tampil_cerita_all() {
		$data = array();
		$qcerita = $this->con->query("SELECT * FROM cerita JOIN status ON cerita.id_status = status.id_status JOIN users ON cerita.id_users = users.id_users");

		while($break = $qcerita->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}

	function tampil_cerita_user($id_cerita) {
		$qcerita = $this->con->query("SELECT * FROM cerita JOIN users ON cerita.id_users = users.id_users JOIN status ON cerita.id_status = status.id_status WHERE cerita.id_cerita = '$id_cerita'");
		return $qcerita->fetch_assoc();
	}

	function tampil_cerita_id($id_cerita, $id_users) {
		$qcerita = $this->con->query("SELECT * FROM cerita JOIN status ON cerita.id_status = status.id_status JOIN users ON cerita.id_users = users.id_users WHERE id_cerita = '$id_cerita' AND cerita.id_users = '$id_users'");
		return $qcerita->fetch_assoc();
	}

	function hapus_cerita($id_cerita, $id_users) {
		$qcerita = $this->con->query("DELETE FROM cerita WHERE id_cerita = '$id_cerita' AND id_users = '$id_users'");
		
		$qchapter = $this->con->query("DELETE FROM chapter WHERE id_cerita = '$id_cerita'");

	}



	function tambah_cerita($judul_cerita,$sinopsis,$sampul_cerita,$id_status,$id_users, $tanggal) {
		$rand = rand();
		$ekstensi =  array('png','jpg','jpeg','gif');
		$filename = $sampul_cerita['name'];
		$ukuran = $sampul_cerita['size'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if(!in_array($ext,$ekstensi) ) {
			return "failed";
		} else {

			if ($ukuran < 1044070) {		
				$xx = $rand.'_'.$filename;
				move_uploaded_file($sampul_cerita['tmp_name'], '../../../assets/images/cover/'.$rand.'_'.$filename);
				$this->con->query("INSERT INTO cerita(judul_cerita,sinopsis,sampul_cerita,id_status,id_users,tanggal) VALUES ('$judul_cerita','$sinopsis','$xx','$id_status','$id_users','$tanggal')");
				return "success_upload";
			} else {
				return "ukuran_besar";
			}
		}
	}


	function edit_cerita($judul_cerita, $sinopsis, $sampul_cerita, $id_status, $id_cerita, $id_users) {
		$nama_foto = $sampul_cerita['name'];
		$lokasi = $sampul_cerita['tmp_name'];

		if (!empty($lokasi)) {
			$cek_data = $this->con->query("SELECT * FROM cerita WHERE id_cerita = '$id_cerita' AND id_users = '$id_users'");
			$break = $cek_data->fetch_assoc();
			$old_foto = $break['sampul_cerita'];

			if (file_exists("../../../assets/images/cover/$old_foto")) 
			{
				unlink("../../../assets/images/cover/$old_foto");
			}

			$rand = rand();
			$ekstensi =  array('png','jpg','jpeg','gif');
			$filename = $sampul_cerita['name'];
			$ukuran = $sampul_cerita['size'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			$xx = $rand.'_'.$filename;
			move_uploaded_file($sampul_cerita['tmp_name'], '../../../assets/images/cover/'.$rand.'_'.$filename);


			$this->con->query("UPDATE cerita SET judul_cerita = '$judul_cerita', sinopsis = '$sinopsis', sampul_cerita = '$xx', id_status = '$id_status', id_users = '$id_users' WHERE id_cerita = '$id_cerita' AND id_users = '$id_users'");

			return 'success_edit'; 

		} else {
			$this->con->query("UPDATE cerita SET judul_cerita = '$judul_cerita', sinopsis = '$sinopsis', id_status = '$id_status', id_users = '$id_users' WHERE id_cerita = '$id_cerita'");
			return 'success_edit'; 
		}


	}

	function tampil_aktivitas($id_users) {
		$data = array();
		$qaktivitas = $this->con->query("SELECT * FROM aktivitas JOIN users ON aktivitas.id_users = users.id_users WHERE aktivitas.id_users = '$id_users'");

		while ($break = $qaktivitas->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}



	function tambah_aktivitas($aktivitas, $id_users) {
		$this->con->query("INSERT INTO aktivitas(aktivitas, id_users) VALUES ('$aktivitas', $id_users)");
	}

	function getUserIpAddr(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif( !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	function edit_chapter($id_chapter, $judul_chapter, $isi_chapter) {
		$this->con->query("UPDATE chapter SET judul_chapter = '$judul_chapter', isi_chapter = '$isi_chapter' WHERE id_chapter = '$id_chapter'");
		return 'success_edit';
	}


	function tampil_users() {
		$data = array();
		$quser = $this->con->query("SELECT * FROM users JOIN roles ON users.id_roles = roles.id_roles");
		while ($break = $quser->fetch_assoc()) {
			$data[] = $break;
		}
		return $data;
	}

	function hapus_users($id_users) {
		$quser = $this->con->query("DELETE FROM users WHERE id_users = '$id_users'");
	}

	function tambah_users($name, $email, $password, $id_roles) {
		$qcek = $this->con->query("SELECT * FROM users WHERE email = '$email'");
		$cek_rows = mysqli_num_rows($qcek);

		if ($cek_rows > 0) {
			return 'already_register';
		} else {
			$this->con->query("INSERT INTO users(name,email,password,id_roles) VALUES ('$name','$email','$password','$id_roles')");
			return 'success_register';
		}
	}

	function tampil_roles() {
		$data = array();
		$qroles = $this->con->query("SELECT * FROM roles");

		while ($break = $qroles->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}

	function edit_users($name, $email, $password, $id_roles, $id_users) {

		$qusers = $this->con->query("UPDATE users SET name = '$name', email = '$email', password = '$password', id_roles = '$id_roles' WHERE id_users = '$id_users'");
		return 'success_edit';
		
		
	}

	function tampil_users_id($id_users) {
		$qusers = $this->con->query("SELECT * FROM users JOIN roles ON users.id_roles = roles.id_roles WHERE id_users = '$id_users'");
		return $qusers->fetch_assoc();
	}

	function update_users($name, $email, $password, $id_users) {


		$qusers = $this->con->query("UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id_users = '$id_users'");
		return 'success_edit';
		
		
	}



}

$func = new menu($mysqli);