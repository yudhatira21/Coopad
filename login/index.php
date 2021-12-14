<!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login | Coopad</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Selamat datang !</h5>
                                            <p>Login akun anda untuk menulis</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="../assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div class="auth-logo">
                                    <a href="index.html" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="../assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="p-2">
                                    <form class="form-horizontal">

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" id="password" name="password" required>
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-check">
                                            <label class="form-check-label" for="remember-check">
                                                Remember me
                                            </label>
                                        </div>
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="button" id="login" name="login">Log In</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>

                        <div id="modal_gagal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Notice</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="alert_gagal"></div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <div class="mt-5 text-center">

                            <div>
                                <p>Tidak punya akun ? <a href="/new/register" class="fw-medium text-primary"> Daftar sekarang </a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Coopad. Crafted with <i class="mdi mdi-heart text-danger"></i> by usco</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

        <!-- JAVASCRIPT -->
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>

        <script>
            $(document).ready( function () {

                $("#login").click(function(){ /*#login mengambil id button login*/

                    let formData = new FormData();
                    formData.append('email', $('#email').val()); /*form data membuat formdata email dan password*/
                    formData.append('password', $('#password').val());


                    $.ajax({
                        type: 'POST', /*type POST data*/
                        url: "../function/login.php", /*tujuan yang akan di tuju*/
                        data: formData,
                        dataType: 'json', /*data type yang akan ditampilkan adalah json*/
                        cache: false,
                        processData: false,
                        contentType: false,

                        /*Sebelum mengirim maka tampilkan spiner dan tulisan mencoba login*/
                        beforeSend: function (e) {
                            $('#login').html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Mencoba login...');
                        },

                        /*ketika berhasil mengirimkan data makan akan tampil beberapa data status*/
                        success: function(data) {

                            if (data.status == 1) {
                                $('#modal_gagal').modal('show'); /*jika result kirim gagal maka menampilkan data msg tulisan*/
                                $('#alert_gagal').text(data.msg);
                                $('#login').text('Log In');
                            } else if(data.status == 2) {
                                $('#modal_gagal').modal('show');
                                $('#alert_gagal').text(data.msg);
                                $('#login').text('Log In');
                            } else if(data.status == 3) {
                                $('#modal_gagal').modal('show');
                                $('#alert_gagal').text(data.msg);
                                $('#login').text('Log In');
                           } else if (data.status == 0) {
                                /*jika berhasil makan akan langsung redirect ke halaman dashboard*/
                                document.location = "../index.php?page=dashboard";
                                $('#login').text('Log In');
                            }

                        ajaxCall_getToken.abort();
                    }
                });
                });

            });
        </script>
        
        <!-- App js -->
        <script src="../assets/js/app.js"></script>
    </body>
    </html>
