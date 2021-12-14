		var ajaxCall;
		var ajaxCall_getToken;
		var ajaxCall_login;
		var ajaxCall_cerita;
		var ajaxCall_simpan;


		$(document).ready(function() {
			$('#register').click(function() {
				$('#hidden_register').toggle(1000);
			});
			// register
			$('#tambah_cerita').click(function() {
				
				const sampul_cerita = $('#sampul_cerita').prop('files')[0];

				ajaxCall_cerita = $.ajax({
					url: 'source/action.php',
					dataType: 'json',
					cache: false,
					type: 'POST',
					beforeSend: function (e) {
						$('#tambah_cerita').html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Registering...');
					},
					data: 'action=tambah_cerita&judul_cerita='+$('#judul_cerita').val()+'&deskripsi='+$('#deskripsi').val()+'&sampul_cerita='+$('#sampul_cerita').val(),
					success: function(data) {
						switch (data.status) {
							case 0:
							$('#alert-register').attr('class', 'alert alert-success').text(data.message+', Will redirected in 3 Sec..');
							$('#register_result').fadeIn(3000);
							$('#tambah_cerita').fadeOut(3000);
							$('#modal_login').modal('hide');
							break;
							case 1:
							$('#alert-register').attr('class', 'alert alert-warning').text(data.message);
							$('#register_result').fadeIn(3000);
							$('#tambah_cerita').text('Try Again');
							break;
						}
						ajaxCall_register.abort();
					}
				});
			});
			// Login User
			$('#login').click(function() {
				ajaxCall_login = $.ajax({
					url: '/source/action.php',
					dataType: 'json',
					cache: false,
					type: 'POST',
					beforeSend: function (e) {
						$('#login').html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Waiting...');
					},
					data: 'action=login&username='+$('#username').val()+'&password='+$('#password').val(),
					success: function(data) {
						switch (data.status) {
							case 0:
							$('#modal_login').modal('hide');
							$('#alert_login').removeClass('alert-warning').addClass('alert-success').text(data.message);
							$('#login_result').fadeIn(3000);
							$("#login_hide").fadeIn(3000);
							break;
							case 1:
							$('#alert_login').text(data.message);
							$('#login_result').fadeIn(3000);
							break;
						}
						ajaxCall_login.abort();
						$('#login').text('Login');
					}
				});
			});
			// Get sock list
			$('#get_sock').click(function() {
				ajaxCall_getToken = $.ajax({
					url: '/source/action.php',
					dataType: 'json',
					cache: false,
					type: 'POST',
					beforeSend: function (e) {
						$('#get_sock').html('<i class="fa fa-spinner fa-spin"></i> Waiting');
					},
					data: 'action=get_sock',
					success: function(data) {
						ajaxCall_getToken.abort();
						$('#get_sock').fadeOut(4000);
						$('#socks').val(data.sock);
					}
				});
			});
			// Get the token
			$('#hapus').click(function() {
				ajaxCall_getToken = $.ajax({
					url: 'cerita/function/hapus.php',
					dataType: 'json',
					cache: false,
					type: 'POST',
					data: 'action=hapus',
					success: function(data) {
						if (data.status == 123) {
							$('#modal_login').modal('show');
							$('#loading_token').hide();
							$('#get_token').fadeIn(2000);
						} else {
							$('#loading_token').hide();
							$('#get_token').fadeIn(2000);
							$('#token').val(data.token);
						}
						ajaxCall_getToken.abort();
					}
				});
			});
			$("#simpan").click(function(){
				const fileupload = $('#fileupload').prop('files')[0];

				let formData = new FormData();
				formData.append('fileupload', fileupload);
				formData.append('judul_cerita', $('#judul_cerita').val());
				formData.append('deskripsi', $('#deskripsi').val());
				formData.append('id_status', $('#id_status').val());

				ajaxCall_ = $.ajax({
					type: 'POST',
					url: "cerita/function/tambah_cerita.php",
					data: formData,
					dataType: 'json',
					cache: false,
					processData: false,
					contentType: false,
					beforeSend: function (e) {
						$('#simpan').html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Menyimpan cerita...');
					},
					success: function(data) {

						if (data.status == 1) {
							$('#modal_tambah_gagal').modal('show');
							$('#alert_gagal').text(data.msg);
							$('#simpan').text('Simpan cerita');
						} else if(data.status == 2) {
							$('#modal_tambah_gagal').modal('show');
							$('#alert_gagal').text(data.msg);
							$('#simpan').text('Simpan cerita');
						} else if(data.status == 3) {
							$('#modal_tambah_gagal').modal('show');
							$('#alert_gagal').text(data.msg);
							$('#simpan').text('Simpan cerita');
						} else if (data.status == 0) {
							$('#modal_tambah_success').modal('show');
							$('#simpan').text('Simpan cerita');
						}
						ajaxCall_getToken.abort();
					}
				});
			});
		});

