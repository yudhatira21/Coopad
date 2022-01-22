<?php  

$tampil_cerita = $func->tampil_cerita_user($_GET['id_cerita']);

$tampil_chapter = $func->tampil_chapter_id($_GET['id_cerita']);
$tampil_komentar = $func->tampil_komentar_cerita($_GET['id_cerita']);

?>
<title><?= $tampil_cerita['judul_cerita'] ?></title>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="product-detai-imgs">
                            <div class="row">
                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                            aria-labelledby="product-1-tab">
                                            <div>
                                                <img src="assets/images/cover/<?= $tampil_cerita['sampul_cerita']?>"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="mt-4 mt-xl-3">
                            <h4 class="mt-1 mb-3"><?= $tampil_cerita['judul_cerita'] ?></h4>
                            <p class="text-muted mb-4"><?= $tampil_cerita['tanggal']?></p>
                            <h6 class="text-success text-uppercase"><?= $tampil_cerita['status']?></h6>
                            <p class="text-muted mb-4"><?= $tampil_cerita['sinopsis']?></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="mt-5">
                    <h5 class="mb-3">Chapter - <?= $tampil_cerita['judul_cerita']?> :</h5>

                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Chapter</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($tampil_chapter as $tampil): ?>

                                <tr>
                                    <td><a
                                            href="index.php?page=chapter_detail&id_cerita=<?= $tampil['id_cerita']?>&id_chapter=<?= $tampil['id_chapter']?>"><?= $tampil['judul_chapter'] ?></a>
                                    </td>
                                    </td>
                                </tr>

                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5">
                        <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i>
                            Comments :</h5>

                        <div>
                            <?php foreach ($tampil_komentar as $tampil): ?>
                            <div class="d-flex py-3 border-top">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                            <i class="bx bxs-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="font-size-14 mb-1"><?= $tampil['name']?> <small
                                            class="text-muted float-end"><?= $tampil['tgl']?></small></h5>
                                    <p class="text-muted"><?= $tampil['komentar']?></p>

                                </div>
                            </div>
                            <?php endforeach ?>

                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="font-size-16 mb-3">Leave a Message</h5>

                        <form id="form-data">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="commentmessage-input" class="form-label">Message</label>
                                    <input id="id_cerita" name="id_cerita" type="hidden" class="form-control"
                                        value="<?= $tampil_cerita['id_cerita']?>">
                                    <textarea name="komentar" id="komentar" class="form-control"
                                        placeholder="Your message..." rows="3"></textarea>
                                </div>

                                <div class="text-end">
                                    <button type="button" name="simpan" id="simpan"
                                        class="btn btn-primary mt-3">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- end Specifications -->
                </div>
            </div>
            <!-- end card -->

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


            <div id="modal_tambah_gagal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                aria-hidden="true">
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
        </div>

        <script>
            $(document).ready(function () {
                $("#simpan").click(function () {

                    let formData = new FormData();
                    formData.append('id_cerita', $('#id_cerita').val());
                    formData.append('komentar', $('#komentar').val());

                    $.ajax({
                        type: 'POST',
                        url: "cerita/komentar.php",
                        data: formData,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function (e) {
                            $('#simpan').html(
                                '<i class="fa fa-spinner fa-spin"></i> &nbsp; Submit...'
                            );
                        },
                        success: function (data) {

                            if (data.status == 1) {
                                $('#modal_tambah_gagal').modal('show');
                                $('#alert_gagal').text(data.msg);
                                $('#simpan').text('Submit');
                            } else if (data.status == 2) {
                                $('#modal_tambah_gagal').modal('show');
                                $('#alert_gagal').text(data.msg);
                                $('#simpan').text('Submit');
                            } else if (data.status == 3) {
                                $('#modal_tambah_gagal').modal('show');
                                $('#alert_gagal').text(data.msg);
                                $('#simpan').text('Submit');
                            } else if (data.status == 0) {
                                $('#modal_tambah_success').modal('show');
                                $('#alert_success').html(data.msg);
                                $('#simpan').text('Submit');
                                location.reload();
                            }

                            ajaxCall_getToken.abort();
                        }
                    });
                });
            });
        </script>