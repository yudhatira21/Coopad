<?php

include 'function.php';

if (isset($_POST['search'])) {
    

        $no = 1;
        $search = $_POST['search'];

        $search = $func->search($search);

        foreach ($search as $tampil) {
?>

<div class="col-sm-6">
    <div class="card p-1 border shadow-none">
        <div class="p-3">
            <h5><a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>"
                    class="text-dark"><?= $tampil['judul_cerita']?></a></h5>
            <p class="text-muted mb-0"><?= $tampil['tanggal']?></p>
        </div>

        <div class="position-relative">
            <img src="assets/images/cover/<?= $tampil['sampul_cerita']?>" alt="" class="img-thumbnail">
        </div>

        <div class="p-3">
            <ul class="list-inline">
                <li class="list-inline-item me-3">
                    <a href="index.php?page=profile_users&id_users=<?= $tampil['id_users']?>" class="text-muted">
                        <i class="bx bx-user align-middle text-muted me-1"></i>
                        <?= $tampil['name']?>
                    </a>
                </li>
                <li class="list-inline-item me-3">
                    <a href="javascript: void(0);" class="text-muted">
                        <i class="bx bx-like align-middle text-muted me-1">
                            123</i> <?= $tampil['status']?>
                    </a>
                </li>
            </ul>
            <p><?= substr(strip_tags($tampil['sinopsis']), 0, 80)?>...</p>

            <div>
                <a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>" class="text-primary">Read more <i
                        class="mdi mdi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>


<?php }

} ?>