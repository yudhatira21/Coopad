<?php 
$tampil_cerita = $func->tampil_cerita_id($_GET['id_cerita'], $_SESSION['users']['id_users']); 
$tampil_status = $func->tampil_status(); 
?>

<title><?= $name_web ?> - Edit cerita</title>
<div class="row">
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="product-img position-relative">
                    <img id="previewHolder" src="assets/images/cover/<?= $tampil_cerita['sampul_cerita']?>" alt="" class="img-fluid mx-auto d-block">
                </div>
                <div class="mt-4 text-center">
                    <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark"><?= $tampil_cerita['sampul_cerita']?></a></h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit cerita - <?= $tampil_cerita['judul_cerita']?></h4>
                <form id="form-data">
                    <div class="row mb-4">
                        <label for="judul_cerita" class="col-form-label col-lg-2">Judul cerita</label>
                        <div class="col-lg-10">
                            <input type="hidden" id="id_cerita" name="id_cerita" type="text" class="form-control"  value="<?= $tampil_cerita['id_cerita'] ?>">
                            <input id="judul_cerita" name="judul_cerita" type="text" class="form-control" placeholder="Judul cerita anda" required="" value="<?= $tampil_cerita['judul_cerita'] ?>">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="deskripsi" class="col-form-label col-lg-2">Deskripsi</label>
                        <div class="col-lg-10">
                            <textarea class="ckeditor" id="deskripsi" name="deskripsi" rows="8" placeholder="Masukan deskripsi cerita..." required=""><?= $tampil_cerita['sinopsis'] ?></textarea>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <label for="sampul_cerita" class="col-form-label col-lg-2">Sampul cover</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="file" name="sampul_cerita" id="sampul_cerita">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="id_status" class="col-form-label col-lg-2">Status</label>
                        <div class="col-lg-10">
                            <select class="form-select" name="id_status" id="id_status">
                                <option value="<?= $tampil_cerita['id_status']?>"><?= $tampil_cerita['status']?></option>
                                <?php foreach($tampil_status as $tampil): ?>
                                    <option value="<?= $tampil['id_status'] ?>"><?= $tampil['status']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="button" id="simpan" name="simpan" class="btn btn-primary mt-3">Simpan cerita</button>
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
                <p>Berhasil mengubah cerita!</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    function readURL(input) {
      if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function(e) {
          $('#previewHolder').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $('#previewHolder').attr('src', '');
}
}

$("#sampul_cerita").change(function() {
  readURL(this);
});
</script>

<script>
    $(document).ready( function () {
        $("#simpan").click(function(){

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            
            const fileupload = $('#sampul_cerita').prop('files')[0];

            let formData = new FormData();
            formData.append('sampul_cerita', fileupload);
            formData.append('judul_cerita', $('#judul_cerita').val());
            formData.append('deskripsi', $('#deskripsi').serialize());
            formData.append('id_status', $('#id_status').val());
            formData.append('id_cerita', $('#id_cerita').val());

            $.ajax({
                type: 'POST',
                url: "profile/cerita/function/edit_cerita.php",
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
                        $('#simpan').text('Edit cerita');
                    } else if(data.status == 2) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Edit cerita');
                    } else if(data.status == 3) {
                        $('#modal_tambah_gagal').modal('show');
                        $('#alert_gagal').text(data.msg);
                        $('#simpan').text('Edit cerita');
                    } else if (data.status == 0) {
                        $('#modal_tambah_success').modal('show');
                        $('#simpan').text('Edit cerita');
                    }
                    ajaxCall_getToken.abort();
                }
            });
        });
    });
</script>


