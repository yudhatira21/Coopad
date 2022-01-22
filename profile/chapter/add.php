<?php 
$tampil_cerita = $func->tampil_cerita_id($_GET['id_cerita'], $_SESSION['users']['id_users']);
?>

<title><?= $name_web ?> - Tambah chapter</title>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah chapter</h4>
                <form id="form-data">
                    <div class="row mb-4">
                        <label for="judul_chapter" class="col-form-label col-lg-2">Judul chapter</label>
                        <div class="col-lg-10">
                            <input id="id_cerita" name="id_cerita" type="hidden" class="form-control"
                                value="<?= $tampil_cerita['id_cerita']?>">
                            <input id="judul_chapter" name="judul_chapter" type="text" class="form-control"
                                placeholder="Judul chapter anda" required="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="deskripsi" class="col-form-label col-lg-2">Isi chapter</label>
                        <div class="col-lg-10">
                            <textarea class="ckeditor" id="isi_chapter" name="isi_chapter" cols="80"
                                rows="10"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="button" name="simpan" id="simpan" class="btn btn-primary mt-3">Simpan
                                chapter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


</div>
<!-- /.modal -->


<div id="modal_tambah_success" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Berhasil menyimpan chapter!</p>
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
    CKEDITOR.replace('judul_chapter', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>

<script>
    $(document).ready(function () {

        $("#simpan").click(function () {

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            let formData = new FormData();
            formData.append('judul_chapter', $('#judul_chapter').val());
            formData.append('isi_chapter', $('#isi_chapter').serialize());
            formData.append('id_cerita', $('#id_cerita').val());


            $.ajax({
                type: 'POST',
                url: "profile/cerita/function/tambah_chapter.php",
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (e) {
                    $('#simpan').html(
                        '<i class="fa fa-spinner fa-spin"></i> &nbsp; Menyimpan chapter...'
                        );
                },
                success: function (data) {

                    if (data.status == 1) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Simpan chapter');
                    } else if (data.status == 2) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Simpan chapter');
                    } else if (data.status == 3) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Simpan chapter');
                    } else if (data.status == 0) {
                        $('#modal_tambah_success').modal('show');
                        $('#simpan').text('Simpan chapter');
                    }

                    ajaxCall_getToken.abort();
                }
            });
        });

    });
</script>