<?php  

$tampil_cerita = $func->tampil_cerita_all();

?>
<title><?= $name_web; ?> - Dashboard</title>
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-post" role="tab">
                     Semua cerita
                 </a>
             </li>
             <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#archive" role="tab">
                 Berdasarkan status  
             </a>
         </li>
     </ul>

     <!-- Tab panes -->
     <div class="tab-content p-4">
        <div class="tab-pane active" id="all-post" role="tabpanel">
            <div>
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div>
                                        <h5 class="mb-0">Cerita</h5>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- end row -->

                            <hr class="mb-4">
                            
                            <div class="row">
                                <?php foreach($tampil_cerita as $tampil ): ?>

                                    <?php if ($tampil['id_status'] == 2 || $tampil['id_status'] == 1 || $tampil['id_status'] == 4): ?>

                                    
                                        <div class="col-sm-6">
                                            <div class="card p-1 border shadow-none">
                                                <div class="p-3">
                                                    <h5><a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>" class="text-dark"><?= $tampil['judul_cerita']?></a></h5>
                                                    <p class="text-muted mb-0"><?= $tampil['tanggal']?></p>
                                                </div>

                                                <div class="position-relative">
                                                    <img src="assets/images/cover/<?= $tampil['sampul_cerita']?>" alt="" class="img-thumbnail">
                                                </div>

                                                <div class="p-3">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item me-3">
                                                            <a href="index.php?page=profile_users&id_users=<?= $tampil['id_users']?>" class="text-muted">
                                                                <i class="bx bx-user align-middle text-muted me-1"></i> <?= $tampil['name']?>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-heart align-middle text-muted me-1"></i> <?= $tampil['status']?>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <p><?= substr(strip_tags($tampil['sinopsis']), 0, 80)?>...</p>

                                                    <div>
                                                        <a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    
                                <?php endforeach; ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="archive" role="tabpanel">
            <div>
                <div class="row justify-content-center">
                    <div class="col-xl-8">

                        <div class="mt-5">
                            <div class="d-flex flex-wrap">
                                <div class="me-2">
                                    <h4>Completed story</h4>
                                </div>
                            </div>
                            <hr class="mt-2">
                            <?php foreach($tampil_cerita as $tampil2 ): ?>


                                <?php if ($tampil2['id_status'] == 2): ?>
                                    <div class="list-group list-group-flush">
                                        <a href="index.php?page=detail&id_cerita=<?= $tampil2['id_cerita']?>" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> <?= $tampil2['judul_cerita']?>
                                    </a>
                                    </div>
                                <?php endif ?>

                            <?php endforeach; ?>
                        </div>


                        <div class="mt-5">
                            <div class="d-flex flex-wrap">
                                <div class="me-2">
                                    <h4>Ongoing story</h4>
                                </div>
                            </div>
                            <hr class="mt-2">

                            <div class="list-group list-group-flush">
                                <?php foreach($tampil_cerita as $tampil3 ): ?>


                                    <?php if ($tampil3['id_status'] == 1): ?>
                                        <div class="list-group list-group-flush">
                                            <a href="index.php?page=detail_story&id_cerita=<?= $tampil3['id_cerita']?>" class="list-group-item text-muted"><i class="mdi mdi-circle-medium me-1"></i> <?= $tampil3['judul_cerita']?></a>

                                        </div>
                                    <?php endif ?>

                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
