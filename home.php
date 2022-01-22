<?php  

$tampil_cerita = $func->tampil_cerita_all();



?>


<style>
    .hide {
        display: none;
    }
</style>
<title><?= $name_web; ?> - Dashboard</title>

<div class="row">

</div>


<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="search-box">
                    <p class="text-muted">Search</p>
                    <div class="position-relative">
                        <form id="form-data">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control rounded bg-light border-light"
                                        placeholder="Search ..." name="search" id="search" aria-label="Search input">
                                    <i class="mdi mdi-magnify search-icon"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <hr class="my-4">

                <div>
                    <p class="text-muted">Categories</p>

                    <ul class="list-unstyled fw-medium">
                        <li><a href="javascript: void(0);" class="text-muted py-2 d-block"><i
                                    class="mdi mdi-chevron-right me-1"></i> Design</a></li>
                        <li><a href="javascript: void(0);" class="text-muted py-2 d-block"><i
                                    class="mdi mdi-chevron-right me-1"></i> Development <span
                                    class="badge badge-soft-success badge-pill float-end ms-1 font-size-12">04</span></a>
                        </li>
                        <li><a href="javascript: void(0);" class="text-muted py-2 d-block"><i
                                    class="mdi mdi-chevron-right me-1"></i> Business</a></li>
                        <li><a href="javascript: void(0);" class="text-muted py-2 d-block"><i
                                    class="mdi mdi-chevron-right me-1"></i> Project</a></li>
                        <li><a href="javascript: void(0);" class="text-muted py-2 d-block"><i
                                    class="mdi mdi-chevron-right me-1"></i> Travel<span
                                    class="badge badge-soft-success badge-pill ms-1 float-end font-size-12">12</span></a>
                        </li>
                    </ul>
                </div>
                <hr class="my-4">

                <div>
                    <p class="text-muted mb-2">Popular Posts</p>

                    <div class="list-group list-group-flush">

                        <?php foreach($tampil_cerita as $tampil ): ?>
                        <a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>"
                            class="list-group-item text-muted py-3 px-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <img src="assets/images/cover/<?= $tampil['sampul_cerita']?>" alt=""
                                        class="avatar-md h-auto d-block rounded">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-13 text-truncate"><?= $tampil['judul_cerita']?></h5>

                                    <p><?= substr(strip_tags($tampil['sinopsis']), 0, 80)?>...</p>

                                    <p class="mb-0 text-truncate"><?= $tampil['tanggal']?></p>
                                </div>
                            </div>
                        </a>

                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- end card -->
    </div>
    <div class="col-xl-8 col-lg-8">
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

                                    <div class="row" id="tampil">
                                        <?php foreach($tampil_cerita as $tampil ): ?>

                                        <?php if ($tampil['id_status'] == 2 || $tampil['id_status'] == 1 || $tampil['id_status'] == 4): ?>



                                        <div class="col-sm-6">
                                            <div class="card p-1 border shadow-none">
                                                <div class="p-3">
                                                    <h5><a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>"
                                                            class="text-dark"><?= $tampil['judul_cerita']?></a></h5>
                                                    <p class="text-muted mb-0"><?= $tampil['tanggal']?></p>
                                                </div>

                                                <div class="position-relative">
                                                    <img src="assets/images/cover/<?= $tampil['sampul_cerita']?>" alt=""
                                                        class="img-thumbnail">
                                                </div>
                                                <div class="p-3">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item me-3">
                                                            <a href="index.php?page=profile_users&id_users=<?= $tampil['id_users']?>"
                                                                class="text-muted">
                                                                <i class="bx bx-user align-middle text-muted me-1"></i>
                                                                <?= $tampil['name']?>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">

                                                            <?php 
                                                            
                                                            $check = $func->check_likes($_SESSION['users']['id_users'], $tampil['id_cerita']); 
                                                            
                                                            if ($check == 1):

                                                            ?>

                                                            <span class="unlike bx bx-dislike align-middle text-muted
                                                                    me-1" id="<?= $tampil['id_cerita']?>"></span>
                                                            <span
                                                                class="suka hide bx bx-like align-middle text-muted me-1"
                                                                id="<?= $tampil['id_cerita']?>"></span>

                                                            <?php else: ?>

                                                            <span class="suka bx bx-like align-middle text-muted me-1"
                                                                id="<?= $tampil['id_cerita']?>"></span>
                                                            <span class="unlike hide bx bx-dislike align-middle text-muted
                                                                    me-1" id="<?= $tampil['id_cerita']?>"></span>

                                                            <?php endif ?>

                                                            <span class="likes_count"><?php echo $tampil['likes']; ?>
                                                                likes</span>
                                                            <?= $tampil['status']?>

                                                        </li>
                                                    </ul>
                                                    <p><?= substr(strip_tags($tampil['sinopsis']), 0, 80)?>...</p>

                                                    <div>
                                                        <a href="index.php?page=detail&id_cerita=<?= $tampil['id_cerita']?>"
                                                            class="text-primary">Read more <i
                                                                class="mdi mdi-arrow-right"></i></a>
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
                                        <a href="index.php?page=detail&id_cerita=<?= $tampil2['id_cerita']?>"
                                            class="list-group-item text-muted"><i
                                                class="mdi mdi-circle-medium me-1"></i> <?= $tampil2['judul_cerita']?>
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
                                            <a href="index.php?page=detail&id_cerita=<?= $tampil3['id_cerita']?>"
                                                class="list-group-item text-muted"><i
                                                    class="mdi mdi-circle-medium me-1"></i>
                                                <?= $tampil3['judul_cerita']?></a>

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

        <script type="text/javascript">
            $(document).ready(function () {
                $('#search').on('keyup', function () {
                    $.ajax({
                        type: 'POST',
                        url: 'search.php',
                        data: {
                            search: $(this).val()
                        },
                        cache: false,
                        success: function (data) {
                            $('#tampil').html(data);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                // when the user clicks on like
                $('.suka').on('click', function () {
                    var id = $(this).attr('id');
                    $post = $(this);

                    $.ajax({
                        url: 'likes.php',
                        type: 'post',
                        data: {
                            'liked': 1,
                            'id': id
                        },
                        success: function (response) {
                            $post.parent().find('span.likes_count').text(response +
                                " likes");
                            $post.addClass('hide');
                            $post.siblings().removeClass('hide');
                        }
                    });
                });

                // when the user clicks on unlike
                $('.unlike').on('click', function () {
                    var id = $(this).attr('id');
                    $post = $(this);

                    $.ajax({
                        url: 'likes.php',
                        type: 'post',
                        data: {
                            'unliked': 1,
                            'id': id
                        },
                        success: function (response) {
                            $post.parent().find('span.likes_count').text(response +
                                " likes");
                            $post.addClass('hide');
                            $post.siblings().removeClass('hide');
                        }
                    });
                });
            });
        </script>