<?php 

$tampil_aktivitas = $func->tampil_aktivitas($_SESSION['users']['id_users']); 

$tampil_users = $func->tampil_users_id($_SESSION['users']['id_users']);

$tampil_cerita = $func->tampil_cerita($_SESSION['users']['id_users']);

?>
<title><?= $tampil_users['name']?></title>
<div class="checkout-tabs">
    <div class="row">
        <div class="col-lg-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques"
                    role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                    <i class="bx bx-user d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="fw-bold mb-4">Profile users</p>
                </a>
                <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab"
                    aria-controls="v-pills-privacy" aria-selected="false">
                    <i class="bx bx-detail d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="fw-bold mb-4">Aktivitas users</p>
                </a>
                <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab"
                    aria-controls="v-pills-support" aria-selected="false">
                    <i class="bx bx-list-ul d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="fw-bold mb-4">Daftar cerita</p>
                </a>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                            aria-labelledby="v-pills-gen-ques-tab">
                            <h4 class="card-title mb-5">Profile users</h4>
                            <form id="form-data">

                                <div class="row mb-4">
                                    <label for="email" class="col-form-label col-lg-2">Nama users</label>
                                    <div class="col-lg-10">
                                        <input id="nama" name="nama" type="text" class="form-control"
                                            placeholder="Nama users" value="<?= $tampil_users['name']?>">
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



                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="button" name="simpan" id="simpan"
                                            class="btn btn-primary mt-3">Update profile</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel"
                            aria-labelledby="v-pills-privacy-tab">
                            <h4 class="card-title mb-5">Aktivitas users</h4>

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Aktivitas</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($tampil_aktivitas as $tampil): ?>

                                    <tr>
                                        <td><?= $tampil['aktivitas'] ?></td>
                                    </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                            aria-labelledby="v-pills-support-tab">
                            <h4 class="card-title mb-5">Daftar cerita</h4>

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Judul Cerita</th>
                                        <th>Jumlah Chapter</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($tampil_cerita as $tampil): ?>

                                    <tr>
                                        <td><?= $tampil['judul_cerita'] ?></td>

                                        <?php 

                                            $chapter = $func->tampil_chapter_id($tampil['id_cerita']);  

                                            if ($chapter > 0) {
                                                echo "<td>".count($chapter)." Chapter</td>";

                                            } else {
                                                echo "<td>Belum ada chapter</td>";
                                            }

                                            ?>

                                        <td><?= $tampil['status'] ?></td>
                                    </tr>

                                    <?php endforeach ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

            $.ajax({
                type: 'POST',
                url: "profile/update.php",
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (e) {
                    $('#simpan').html(
                        '<i class="fa fa-spinner fa-spin"></i> &nbsp; Mengupdate profile...'
                    );
                },
                success: function (data) {

                    if (data.status == 1) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Update profile');
                    } else if (data.status == 2) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Update profile');
                    } else if (data.status == 3) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Update profile');
                    } else if (data.status == 0) {
                        $('#modal_tambah_success').modal('show');
                        $('#alert_success').html(data.msg);
                        $('#simpan').text('Update profile');
                    }

                    ajaxCall_getToken.abort();
                }
            });
        });
    });
</script>