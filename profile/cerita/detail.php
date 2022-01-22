<?php  

$tampil_cerita = $func->tampil_cerita_id($_GET['id_cerita'], $_SESSION['users']['id_users']);
$tampil_chapter = $func->tampil_chapter_id($_GET['id_cerita']);


?>
<title><?= $tampil_cerita['judul_cerita']?></title>
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
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                            <div>
                                                <img src="assets/images/cover/<?= $tampil_cerita['sampul_cerita']?>" alt="" class="img-fluid mx-auto d-block">
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
                        <div class="float-end">
                            <div class="input-group input-group-sm">
                                <a href="index.php?page=add_chapter&id_cerita=<?= $tampil_cerita['id_cerita']?>" class="btn btn-primary waves-effect waves-light btn-sm">Tambah chapter </a>
                            </div>
                        </div>

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Chapter</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($tampil_chapter as $tampil): ?>

                                    <tr>
                                        <td><a href="index.php?page=chapter&id_cerita=<?= $tampil['id_cerita']?>&id_chapter=<?= $tampil['id_chapter']?>"><?= $tampil['judul_chapter'] ?></a></td>
                                    </td>
                                    <td>
                                        <button id="<?= $tampil['id_chapter'] ?>" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light hapus_data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <a href="index.php?page=edit_chapter&id_chapter=<?= $tampil['id_chapter']?>" class="btn btn-warning btn-sm btn-rounded waves-effect waves-light">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a href="index.php?page=chapter&id_cerita=<?= $tampil['id_cerita']?>&id_chapter=<?= $tampil['id_chapter']?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                    </td>
                                </tr>

                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end Specifications -->
        </div>
    </div>
    <!-- end card -->
</div>


<script>
    $(document).on('click', '.hapus_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "profile/cerita/function/hapus_chapter.php",
            data: {id:id},
            success: function() {
                location.reload();
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>
