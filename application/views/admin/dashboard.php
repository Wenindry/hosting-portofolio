<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_balita')->num_rows();
                            ?>
                        </h3>

                        <p>Total Balita</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-user-plus"></div>
                    </div>
                    <a href="<?= base_url('admin/balita') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_balita WHERE jenisKelamin="Laki-Laki"')->num_rows();
                            ?>
                        </h3>

                        <p>Total Balita Laki-Laki</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-male"></div>
                    </div>
                    <a href="<?= base_url('admin/balita') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_balita WHERE jenisKelamin="Perempuan"')->num_rows();
                            ?>
                        </h3>

                        <p>Total Balita Perempuan</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-female"></div>
                    </div>
                    <a href="<?= base_url('admin/balita') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_imunisasi')->num_rows();
                            ?>
                        </h3>

                        <p>Total Imunisasi</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-book"></div>
                    </div>
                    <a href="<?= base_url('admin/imunisasi') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_penimbangan')->num_rows();
                            ?>
                        </h3>

                        <p>Total Penimbangan</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-bookmark"></div>
                    </div>
                    <a href="<?= base_url('admin/penimbangan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>
                                <?php
                                    echo $this->db->query('SELECT id FROM tb_user WHERE level="Bidan"')->num_rows();
                                ?>
                            </h3>

                            <p>Total Bidan</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-user-md"></div>
                        </div>
                        <a href="<?= base_url('admin/user') ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                <?php
                                    echo $this->db->query('SELECT id FROM tb_user WHERE level="Orang Tua"')->num_rows();
                                ?>
                            </h3>

                            <p>Total Orang Tua</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-user"></div>
                        </div>
                        <a href="<?= base_url('admin/user') ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3>
                                <?php
                                    echo $this->db->query('SELECT id FROM tb_user WHERE level="Administrator"')->num_rows();
                                ?>
                            </h3>

                            <p>Total Administrator</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-users"></div>
                        </div>
                        <a href="<?= base_url('admin/user') ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Grafik Imunisasi (<?= date('Y') ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="card-body"><canvas id="imunisasi" width="100%" height="60"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Grafik Penimbangan (<?= date('Y') ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="card-body"><canvas id="penimbangan" width="100%" height="60"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>