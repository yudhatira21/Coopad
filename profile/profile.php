<?php 

$tampil_users = $func->tampil_users_id($_GET['id_users']);

$tampil_cerita = $func->tampil_cerita($_GET['id_users']);

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
                            <div class="card-body">
                                <h4 class="card-title mb-4">Personal Information</h4>

                                <p class="text-muted mb-4">Hi I'm Cynthia Price,has been the industry's standard dummy
                                    text To an English person, it will seem like simplified English, as a skeptical
                                    Cambridge.</p>
                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td><?= $tampil_users['name']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Location :</th>
                                                <td>California, United States</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                            aria-labelledby="v-pills-support-tab">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Daftar cerita <?= $tampil_users['name']?></h4>

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
</div>
<!-- end row -->