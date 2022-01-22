<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Daftar | Coopad</title>
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
                                        <h5 class="text-primary">Daftar akun sekarang</h5>
                                        <p>Daftarkan akun anda untuk bergabung bersama kami.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="../assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form class="form-horizontal">

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama anda">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter email">
                                    </div>



                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter password">
                                    </div>

                                    <div class="mt-4 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="button"
                                            name="daftar" id="daftar">Daftar akun sekarang</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div id="modal_success" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Notice</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="alert_success"></div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div id="modal_gagal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Notice</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="alert_gagal"></div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="mt-5 text-center">

                        <div>
                            <p>Sudah punya akun ? <a href="/new/login" class="fw-medium text-primary"> Masuk
                                    sekarang</a> </p>
                            <p>© <script>
                                    document.write(new Date().getFullYear())
                                </script> Coopad. Crafted with <i class="mdi mdi-heart text-danger"></i> by kelompok
                                10</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>

    <!-- validation init -->
    <script src="../assets/js/pages/validation.init.js"></script>


    <script>
        $(document).ready(function () {

            $("#daftar").click(function () {

                let formData = new FormData();
                formData.append('nama', $('#nama').val());
                formData.append('email', $('#email').val());
                formData.append('password', $('#password').val());


                $.ajax({
                    type: 'POST',
                    url: "../function/register.php",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function (e) {
                        $('#daftar').html(
                            '<i class="fa fa-spinner fa-spin"></i> &nbsp; Mencoba daftar akun anda...'
                            );
                    },
                    success: function (data) {

                        if (data.status == 1) {
                            $('#modal_gagal').modal('show');
                            $('#alert_gagal').text(data.msg);
                            $('#daftar').text('Daftar akun sekarang');
                        } else if (data.status == 2) {
                            $('#modal_gagal').modal('show');
                            $('#alert_gagal').text(data.msg);
                            $('#daftar').text('Daftar akun sekarang');
                        } else if (data.status == 3) {
                            $('#modal_gagal').modal('show');
                            $('#alert_gagal').text(data.msg);
                            $('#daftar').text('Daftar akun sekarang');
                        } else if (data.status == 0) {
                            $('#modal_success').modal('show');
                            $('#alert_success').text(data.msg);
                            $('#daftar').text('Daftar akun sekarang');
                            setTimeout(function () {
                                window.location.href = "../login";
                            }, 2000);
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