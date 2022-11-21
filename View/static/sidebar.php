    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= url('home') ?>" class="brand-link">
            <i class="fa fa-check mr-2"></i>
            <span class="brand-text font-weight-light">ToDo App</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image bg-warning d-flex align-item-center justify-content-center p-2">
                    <i class="fa fa-user"></i>
                </div>
                <div class="info">
                    <a href="<?= url('profile') ?>" class="d-block"><?= get_session('fullname') ?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?= url('home') ?>" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Keşfet
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Yapılacaklar
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url('todo/add') ?>" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Yeni Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url('todo/list') ?>" class="nav-link">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>
                                Kategoriler
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url('categories/add') ?>" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Yeni Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url('categories/list') ?>" class="nav-link">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>