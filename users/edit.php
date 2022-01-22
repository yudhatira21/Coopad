<?php 

$tampil_users = $func->tampil_users_id($_GET['id_users']);
$tampil_roles = $func->tampil_roles();

?>

<title><?= $name_web ?> - Edit users</title>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit users</h4>
                <form id="form-data">

                    <div class="row mb-4">
                        <label for="email" class="col-form-label col-lg-2">Nama users</label>
                        <div class="col-lg-10">
                            <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama users"
                                value="<?= $tampil_users['name']?>">
                            <input id="id_users" name="id_users" type="hidden" class="form-control"
                                placeholder="Nama users" value="<?= $_GET['id_users']?>">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-form-label col-lg-2">Email</label>
                        <div class="col-lg-10">
                            <input id="email" name="email" type="email" class="form-control"
                                placeholder="user@email.com" value="<?= $tampil_users['email']?>">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-form-label col-lg-2">Password</label>
                        <div class="col-lg-10">
                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="********" value="<?= $tampil_users['password']?>">
                        </div>
                    </div>



                    <div class="row mb-4">
                        <label for="id_roles" class="col-form-label col-lg-2">Roles users</label>
                        <div class="col-lg-10">
                            <select class="form-select" id="id_roles" name="id_roles">
                                <option value="<?= $tampil_users['id_roles']?>"><?= $tampil_users['name_roles']?>
                                </option>
                                <?php foreach($tampil_roles as $tampils): ?>
                                <option value="<?= $tampils['id_roles'] ?>"><?= $tampils['name_roles']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="button" name="simpan" id="simpan" class="btn btn-primary mt-3">Edit
                                users</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>


</div>
<!-- end row -->

<div id="modal_tambah_success" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="alert_success"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="modal_tambah_gagal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
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


<script>
    $(document).ready(function () {
        $("#simpan").click(function () {

            let formData = new FormData();
            formData.append('nama', $('#nama').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('id_roles', $('#id_roles').val());
            formData.append('id_users', $('#id_users').val());

            $.ajax({
                type: 'POST',
                url: "users/function/edit_users.php",
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (e) {
                    $('#simpan').html(
                        '<i class="fa fa-spinner fa-spin"></i> &nbsp; Mengupdate users...'
                    );
                },
                success: function (data) {

                    if (data.status == 1) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Edit users');
                    } else if (data.status == 2) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Edit users');
                    } else if (data.status == 3) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Edit users');
                    } else if (data.status == 0) {
                        $('#modal_tambah_success').modal('show');
                        $('#alert_success').html(data.msg);
                        $('#simpan').text('Edit users');
                    }

                    ajaxCall_getToken.abort();
                }
            });
        });
    });
</script>