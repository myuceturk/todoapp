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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kategori Listesi</h3>
                                <div class="card-tools">
                                    <a href="<?= url('categories/add') ?>" class="btn btn-sm btn-dark">Ekle</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Başlık</th>
                                            <th>Oluşturma Tarihi</th>
                                            <th>Güncelleme Tarihi</th>
                                            <th style="width: 40px">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $key => $value) : ?>
                                            <tr>
                                                <td>1.</td>
                                                <td><?= $value['title'] ?></td>
                                                <td><?= $value['created_date'] ?></td>
                                                <td><?= $value['updated_date'] ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-sm btn-danger mr-2" href="<?= url('categories/remove/' . $value['id']) ?>">Sil</a>
                                                        <a class="btn btn-sm btn-warning" href="<?= url('categories/edit/' . $value['id']) ?>">Güncelle</a>
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
</body>

</html>