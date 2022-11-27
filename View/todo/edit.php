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
                    <div class="col-lg-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title" style="line-height: 30px;">ToDo Güncelle</h3>
                                <div class="card-tools">
                                    <a href="<?= url('todo/list') ?>" class="btn btn-sm btn-default text-dark"><i class="fa fa-list fa-sm"></i> ToDo Listesi</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <?php echo  get_session('error') ?
                                '<div class="alert alert-' . $_SESSION['error']['type'] . '">' . $_SESSION['error']['message'] . '</div>'
                                : null ?>
                            <!-- form start -->
                            <form action="" method="POST" id="todo">
                                <input id="id" type="hidden" value="<?= $data['id'] ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Kategori Seçiniz:</label>
                                        <select class="form-control" id="category_id"">
                                        <option value=" 0"> -- Kategori Seçimi Yapınız --</option>
                                            <?php foreach ($data['categories'] as $category) : ?>
                                                <option <?= $data['category_id'] == $category['id'] ? 'selected' : null  ?> value=" <?= $category['id'] ?>"><?= $category['title'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class=" form-group">
                                        <label for="title">Başlık:</label>
                                        <input type="text" class="form-control" id="title" value="<?= $data['title'] ?>" placeholder="ToDo Başlığını Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Açıklama:</label>
                                        <input type="text" class="form-control" id="description" value="<?= $data['description'] ?>" placeholder="ToDo Açıklaması Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Durum</label>
                                        <select class="form-control" id="status">
                                            <option <?= $data['status'] == 'a' ? 'selected' : null ?> value="a">Aktif</option>
                                            <option <?= $data['status'] == 'p' ? 'selected' : null ?> value="p">Pasif</option>
                                            <option <?= $data['status'] == 's' ? 'selected' : null ?> value="s">Süreçte</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="progress">İlerleme</label>
                                        <input type="range" class="form-control" value="<?= $data['progress'] ?>" id="progress" min="0" max="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Renk</label>
                                        <input type="color" class="form-control" value="<?= $data['color'] ?>" id="color" value="#007bff">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Başlangıç Tarihi:</label>
                                        <div class="row">


                                            <?php
                                            $start_date = date('Y-m-d', strtotime($data['start_date']));
                                            $start_date_time = date('H:i', strtotime($data['start_date']));
                                            $end_date = date('Y-m-d', strtotime($data['end_date']));
                                            $end_date_time = date('H:i', strtotime($data['end_date']));
                                            ?>

                                            <input type="date" value="<?= $start_date ?>" class="form-control col-8" id="start_date">
                                            <input type="time" value="<?= $start_date_time ?>" class="form-control col-4" id="start_date_time">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">Bitiş Tarihi:</label>
                                        <div class="row">
                                            <input type="date" value="<?= $end_date ?>" class="form-control col-8" id="end_date">
                                            <input type="time" value="<?= $end_date_time ?>" class="form-control col-4" id="end_date_time">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" value="1" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
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
<script src="<?= assets('plugins/toastr/toastr.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const todo = document.getElementById('todo')

    todo.addEventListener('submit', (e) => {
        let id = document.getElementById('id').value
        let title = document.getElementById('title').value
        let description = document.getElementById('description').value
        let category_id = document.getElementById('category_id').value
        let color = document.getElementById('color').value
        let start_date = document.getElementById('start_date').value
        let end_date = document.getElementById('end_date').value
        let start_date_time = document.getElementById('start_date_time').value
        let end_date_time = document.getElementById('end_date_time').value
        let status = document.getElementById('status').value
        let progress = document.getElementById('progress').value

        let formData = new FormData();

        formData.append('id', id)
        formData.append('title', title)
        formData.append('description', description)
        formData.append('category_id', category_id)
        formData.append('color', color)
        formData.append('start_date', start_date)
        formData.append('end_date', end_date)
        formData.append('start_date_time', start_date_time)
        formData.append('end_date_time', end_date_time)
        formData.append('status', status)
        formData.append('progress', progress)

        axios.post('<?= url('api/edittodo') ?>', formData).then(res => {

            if (res.data.redirect) {
                toastr.success(res.data.message)
                setTimeout(function() {
                    window.location.href = res.data.redirect
                }, 1000); //will call the function after 2 secs.
            } else {
                toastr.error(res.data.message)
            }

        }).catch(err => console.log(err))

        e.preventDefault();
    })
</script>

</body>

</html>