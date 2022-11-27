<?php view('static/header') ?>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" href="<?= url('logout') ?>">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <?php view('static/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-5">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo  get('message') ?
                            '<div class="alert alert-' . get('type') . '">' . get('message') . '</div>'
                            : null ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="line-height: 30px;">ToDo Listesi</h3>
                                <div class="card-tools">
                                    <a href="<?= url('todo/add') ?>" class="btn btn-sm btn-default text-dark"><i class="fa fa-plus fa-sm"></i> ToDo Ekle</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Başlık</th>
                                            <th>Kategori</th>
                                            <th>Başlangıç Tarihi</th>
                                            <th>Bitiş Tarihi</th>
                                            <th>İlerleme</th>
                                            <th>Durum</th>
                                            <th style="width: 40px">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($data as $key => $value) : ?>
                                            <tr id="row_<?= $value['id'] ?>">
                                                <td><?= $value['title'] ?></td>
                                                <td><?= $value['category_title'] ?></td>
                                                <td><?= $value['start_date'] ?></td>
                                                <td><?= $value['end_date'] ?></td>
                                                <td>
                                                    <div class="progress progress">
                                                        <div class="progress-bar bg-primary" style="width: <?= $value['progress'] ?>%"><?= $value['progress'] ?>%</div>
                                                    </div>
                                                </td>
                                                <td>

                                                    <span class="badge bg-<?= status($value['status'])['color'] ?>"><?= status($value['status'])['title'] ?></span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-sm btn-danger mr-2" onclick="removeTodo('<?= $value['id'] ?>')">Sil</button>
                                                        <a class="btn btn-sm btn-warning" href="<?= url('todo/edit/' . $value['id']) ?>">Güncelle</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php view('static/footer') ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
<script src="<?= assets('plugins/toastr/toastr.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function removeTodo(id) {
        let formData = new FormData();
        formData.append('id', id);
        axios.post('<?= url('api/removetodo') ?>', formData).then(res => {
            if (res.data.status == 'success') {
                if (res.data.id) {
                    let row = document.getElementById('row_' + res.data.id)
                    row.remove();
                }
                toastr.success(res.data.message)
            } else {
                toastr.error(res.data.message)
            }
        }).catch(err => console.log(err))
    }
</script>
</body>

</html>