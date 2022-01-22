<?php  
$tampil_chapter = $func->tampil_chapter_by_id($_GET['id_chapter']);

$tampil_cerita = $func->tampil_cerita_id($_GET['id_cerita'], $_SESSION['users']['id_users']);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="pt-3">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div>
                                <div class="text-center">
                                    <h4><?= $tampil_chapter['judul_chapter']?></h4>
                                </div>
                                <hr>

                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div>
                                                <p class="text-muted mb-2">Status cerita</p>
                                                <h5 class="font-size-15"><?= $tampil_cerita['status']?></h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mt-4 mt-sm-0">
                                                <p class="text-muted mb-2">Tanggal rilis chapter</p>
                                                <h5 class="font-size-15"><?= $tampil_chapter['tanggal']?></h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mt-4 mt-sm-0">
                                                <p class="text-muted mb-2">Post by</p>
                                                <h5 class="font-size-15"><?= $tampil_cerita['name']?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="my-5">
                                    <img src="assets/images/cover/<?= $tampil_cerita['sampul_cerita']?>" alt=""
                                        class="img-thumbnail mx-auto d-block">
                                </div>
                                <hr>
                                <div class="mt-4">
                                    <div class="text-muted font-size-14">
                                        <p><?= $tampil_chapter['isi_chapter']?></p>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>