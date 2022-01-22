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

	function hapus_chapter($id_chapter) {
		$qchapter = $this->con->query("DELETE FROM chapter WHERE id_chapter = '$id_chapter'");
	}



	function tampil_chapter_id($id) {
		$data = array();
		$qchapter = $this->con->query("SELECT * FROM chapter JOIN cerita ON chapter.id_cerita = cerita.id_cerita WHERE chapter.id_cerita = '$id'");

		while ($break = $qchapter->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}

	function tampil_chapter_by_id($id) {
		$qchapter = $this->con->query("SELECT * FROM chapter JOIN cerita ON chapter.id_cerita = cerita.id_cerita WHERE id_chapter = '$id'");

		$break = $qchapter->fetch_assoc();

		return $break;
	}

	function tampil_komentar_cerita($id_cerita) {
		$data = array();
		$qakomentar = $this->con->query("SELECT * FROM komentar_cerita JOIN cerita ON komentar_cerita.id_cerita = cerita.id_cerita JOIN users ON komentar_cerita.id_users = users.id_users WHERE komentar_cerita.id_cerita = '$id_cerita'");

		while ($break = $qakomentar->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}

	function tampil_status() {
		$data = array();
		$qstatus = $this->con->query("SELECT * FROM status");

		while ($break = $qstatus->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
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

	function tambah_chapter($judul_chapter, $isi_chapter, $id_cerita, $tanggal) {
		$this->con->query("INSERT INTO chapter(judul_chapter,isi_chapter,id_cerita,tanggal) VALUES ('$judul_chapter','$isi_chapter','$id_cerita','$tanggal')");
		return "success_tambah";
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

	function komentar_cerita($komentar, $id_users, $id_cerita, $date) {
		$this->con->query("INSERT INTO komentar_cerita(komentar,id_users, id_cerita, tgl) VALUES ('$komentar','$id_users','$id_cerita', '$date')");
		return "success_komentar";
	}

	function search($cari) {
		$data = array();
		$qcari = $this->con->query("SELECT * FROM cerita JOIN status ON cerita.id_status = status.id_status JOIN users ON
		cerita.id_users = users.id_users WHERE judul_cerita LIKE '%".$cari."%'");

		while ($break = $qcari->fetch_assoc()) {
			$data[] = $break;
		}

		return $data;
	}

	function likes($id_cerita, $id_users) {
		$qcek = $this->con->query("SELECT * FROM cerita WHERE id_cerita = '$id_cerita'");
		$break = $qcek->fetch_assoc();
		$n = $break['likes'];

		$this->con->query("INSERT INTO likes (id_cerita, id_users) VALUES ('$id_cerita', $id_users)");
		$this->con->query("UPDATE cerita SET likes=$n+1 WHERE id_cerita = '$id_cerita'");

		return $n+1;
		exit();
	}

	function unlikes($id_cerita, $id_users) {
		$qcek = $this->con->query("SELECT * FROM cerita WHERE id_cerita = '$id_cerita'");
		$break = $qcek->fetch_assoc();
		$n = $break['likes'];

		$this->con->query("DELETE FROM likes WHERE id_cerita = '$id_cerita' AND id_users = 'id_users')");
		$this->con->query("UPDATE cerita SET likes=$n-1 WHERE id_cerita = '$id_cerita'");

		return $n-1;
		exit();
	}

	function check_likes($id_users, $id_cerita) {
		$qcek = $this->con->query("SELECT * FROM likes WHERE id_users = '$id_users' AND id_cerita = '$id_cerita'");
		$cek_rows = mysqli_num_rows($qcek);

		if ($cek_rows == 1) {
			return $cek_rows;
		}
		

	}

	function likes_cerita() {
		$data = array();
		$qcek = $this->con->query("SELECT * FROM cerita");
		while ($break = $qcek->fetch_assoc()) {
		$data[] = $break;
		}

		return $data;
	}


}

$func = new menu($mysqli);