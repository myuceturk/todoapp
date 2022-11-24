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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">ToDo Ekle</h3>
                            </div>
                            <!-- /.card-header -->
                            <?php echo  get_session('error') ?
                                '<div class="alert alert-' . $_SESSION['error']['type'] . '">' . $_SESSION['error']['message'] . '</div>'
                                : null ?>
                            <!-- form start -->
                            <form action="" method="POST" id="todo">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Kategori Seçiniz:</label>
                                        <select class="form-control" id="category_id"">
                                            <option> -- Kategori Seçimi Yapınız --</option>
                                            <?php foreach ($data as $category) : ?>
                                            <option value=" <?= $category['id'] ?>"><?= $category['title'] ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class=" form-group">
                                        <label for="title">Başlık:</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="ToDo Başlığını Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Açıklama:</label>
                                        <input type="text" name="description" class="form-control" id="description" placeholder="ToDo Açıklaması Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Renk</label>
                                        <input type="color" name="color" class="form-control" id="color" value="#007bff">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Başlangıç Tarihi:</label>
                                        <div class="row">
                                            <input type="date" name="start_date" class="form-control col-8" id="start_date">
                                            <input type="time" name="start_date_time" class="form-control col-4" id="start_date_time">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Bitiş Tarihi:</label>
                                        <div class="row">
                                            <input type="date" name="end_date" class="form-control col-8" id="end_date">
                                            <input type="time" name="end_date_time" class="form-control col-4" id="end_date_time">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" value="1" class="btn btn-primary">Ekle</button>
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
        let title = document.getElementById('title').value
        let description = document.getElementById('description').value
        let category_id = document.getElementById('category_id').value
        let color = document.getElementById('color').value
        let start_date = document.getElementById('start_date').value
        let end_date = document.getElementById('end_date').value
        let start_date_time = document.getElementById('start_date_time').value
        let end_date_time = document.getElementById('end_date_time').value

        let formData = new FormData();

        formData.append('title', title)
        formData.append('description', description)
        formData.append('category_id', category_id)
        formData.append('color', color)
        formData.append('start_date', start_date)
        formData.append('end_date', end_date)
        formData.append('start_date_time', start_date_time)
        formData.append('end_date_time', end_date_time)

        axios.post('<?= url('api/addtodo') ?>', formData).then(res => {

            if (res.data.redirect) {
                toastr.success(res.data.message)
                setTimeout(function() {
                    window.location.href = res.data.redirect
                }, 2000); //will call the function after 2 secs.
            } else {
                toastr.error(res.data.message)
            }

        }).catch(err => console.log(err))

        e.preventDefault();
    })
</script>

</body>

</html>