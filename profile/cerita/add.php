<?php 
$tampil_status = $func->tampil_status(); 
?>

<title><?= $name_web ?> - Buat cerita</title>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Buat cerita anda</h4>
                <form id="form-data">
                    <div class="row mb-4">
                        <label for="judul_cerita" class="col-form-label col-lg-2">Judul cerita</label>
                        <div class="col-lg-10">
                            <input id="judul_cerita" name="judul_cerita" type="text" class="form-control" placeholder="Judul cerita anda" required="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="deskripsi" class="col-form-label col-lg-2">Deskripsi</label>
                        <div class="col-lg-10">
                            <textarea class="ckeditor" id="deskripsi" name="deskripsi" rows="8" placeholder="Masukan deskripsi cerita..." required=""></textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="sampul_cerita" class="col-form-label col-lg-2">Sampul cover</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="file" id="fileupload" name="fileupload">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="id_status" class="col-form-label col-lg-2">Status</label>
                        <div class="col-lg-10">
                            <select class="form-select" id="id_status" name="id_status">
                                <option value="3">Pilih status</option>
                                <?php foreach($tampil_status as $tampil): ?>
                                    <option value="<?= $tampil['id_status'] ?>"><?= $tampil['status']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="button" name="simpan" id="simpan" class="btn btn-primary mt-3">Simpan cerita</button>
                        </div>
                    </div>
                    
                </form>

            </div>
        </div>
    </div>


</div>
<!-- end row -->

<div id="modal_tambah_success" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Berhasil membuat cerita!</p>
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
    $(document).ready( function () {
        $("#simpan").click(function(){

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            const fileupload = $('#fileupload').prop('files')[0];

            let formData = new FormData();
            formData.append('fileupload', fileupload);
            formData.append('judul_cerita', $('#judul_cerita').val());
            formData.append('deskripsi', $('#deskripsi').serialize());
            formData.append('id_status', $('#id_status').val());

            $.ajax({
                type: 'POST',
                url: "profile/cerita/function/tambah_cerita.php",
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
</script>

