<?php $tampil_cerita = $func->tampil_cerita($_SESSION['users']['id_users']); ?>

<title><?= $name_web ?> -  Daftar Cerita</title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="input-group input-group-sm">
                        <a href="index.php?page=add_story" class="btn btn-primary waves-effect waves-light btn-sm">Buat cerita </a>
                    </div>
                </div>
                <h4 class="card-title">Daftar cerita</h4>
                <p class="card-title-desc">Daftar cerita saya</p>

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>Judul Cerita</th>
                            <th>Jumlah Chapter</th>
                            <th>Status</th>
                            <th>Aksi</th>
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

                                <td>
                                    <button id="<?= $tampil['id_cerita']?>" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light hapus_data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <a href="index.php?page=edit_story&id_cerita=<?= $tampil['id_cerita']?>" class="btn btn-warning btn-sm btn-rounded waves-effect waves-light">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <a href="index.php?page=detail_story&id_cerita=<?= $tampil['id_cerita']?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="index.php?page=add_chapter&id_cerita=<?= $tampil['id_cerita']?>" class="btn btn-success btn-sm btn-rounded waves-effect waves-light">
                                     <i class="fas fa-plus"></i>
                                 </a>
                             </td>
                         </tr>

                     <?php endforeach ?>

                 </tbody>
             </table>
         </div>
     </div>
 </div> <!-- end col -->
</div> <!-- end row -->


<script>
    $(document).on('click', '.hapus_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "profile/cerita/function/hapus.php",
            data: {id:id},
            success: function() {
                location.reload();
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>
