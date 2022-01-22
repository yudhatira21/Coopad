<?php  

if ($_SESSION['users']['id_roles'] != 1) {
    session_unset();
    session_destroy();
    echo("<script>location='login';</script>");
}


$tampil_users = $func->tampil_users();

?>

<title><?= $name_web ?> - List Users</title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="input-group input-group-sm">
                        <a href="index.php?page=add_users"
                            class="btn btn-primary waves-effect waves-light btn-sm">Tambah users </a>
                    </div>
                </div>
                <h4 class="card-title">List Users</h4>
                <p class="card-title-desc">Daftar users</p>

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 data_users">
                    <thead>
                        <tr>
                            <th>Nama users</th>
                            <th>Email users</th>
                            <th>Roles users</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($tampil_users as $tampil): ?>

                        <tr>
                            <td><?= $tampil['name'] ?></td>

                            <td><?= $tampil['email'] ?></td>
                            <td><?= $tampil['name_roles'] ?></td>

                            <td>

                                <button id="<?= $tampil['id_users']; ?>"
                                    class="btn btn-danger btn-sm btn-rounded waves-effect waves-light hapus_data">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <a href="index.php?page=edit_users&id_users=<?= $tampil['id_users']?>"
                                    class="btn btn-warning btn-sm btn-rounded waves-effect waves-light">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>


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
    $(document).on('click', '.hapus_data', function () {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "users/function/hapus.php",
            data: {
                id: id
            },
            success: function () {
                location.reload();
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    });
</script>