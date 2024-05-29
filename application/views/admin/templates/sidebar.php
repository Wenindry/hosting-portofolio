<aside class="main-sidebar">
    <section class="sidebar">
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets') ?>/profil/<?= $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('nama') ?></p>
                <a href="#"><i class="fa fa-circle text-succes"></i> Online</a>
            </div>
        </div> -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <style>
                    .sidebar-menu i.fa.fa-tachometer{
                        color:blue;
                    }
                    </style>
            <li>
                <a href="<?= base_url('admin/dashboard') ?>">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/balita') ?>">
                    <i class="fa fa-user-plus"></i> <span>Data Balita</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/imunisasi') ?>">
                    <i class="fa fa-book"></i> <span>Data Imunisasi</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/penimbangan') ?>">
                    <i class="fa fa-bookmark"></i> <span>Laporan </span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/penimbangan') ?>">
                    <i class="fa fa-folder-open"></i> <span>Import</span>
                </a>
            </li>
            <?php if($this->session->userdata('level') == 'Administrator') { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Pengaturan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url('admin/user') ?>"><i class="fa fa-circle-o"></i> Manajemen User</a></li>
                        <li><a href="<?= base_url('admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a></li>
                        <li><a href="<?= base_url('admin/backupdatabase') ?>"><i class="fa fa-circle-o"></i> Backup Database</a></li>
                        <li><a href="<?= base_url('admin/log') ?>"><i class="fa fa-circle-o"></i> Log Status</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li>
                <a href="<?= base_url('admin/profil') ?>">
                    <i class="fa fa-user"></i> <span>Profil</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </section>
</aside>