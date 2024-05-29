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
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Data Balita</h4>
                        <button class="btn btn-primary pull-right" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($balita->result_array() as $dBta) { ?>
                                    <tr>
                                        <td>Orang Tua</td>
                                        <td width="10px">:</td>
                                        <td>
                                            <?php
                                                $this->db->where('id', $dBta['idOrangtua']);
                                                foreach ($this->m_model->get_desc('tb_user')->result() as $vOt) {
                                                    echo $vOt->nama;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Balita</td>
                                        <td>:</td>
                                        <td><?= $dBta['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td><?= $dBta['jenisKelamin'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td>:</td>
                                        <td><?= $dBta['tempatLahir'] . ', ' . date('d F Y', strtotime($dBta['tglLahir'])) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Usia</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                $diff = date_diff(date_create(date("Y-m-d", strtotime($dBta['tglLahir']))), date_create(date("Y-m-d")));
                                                echo $diff->format('%y') . ' Tahun '. $diff->format('%m') . ' Bulan';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Berat</td>
                                        <td>:</td>
                                        <td><?= $dBta['berat'] ?> kg</td>
                                    </tr>
                                    <tr>
                                        <td>Panjang</td>
                                        <td>:</td>
                                        <td><?= $dBta['panjang'] ?> cm</td>
                                    </tr>
                                    <tr>
                                        <td>Golongan Darah</td>
                                        <td>:</td>
                                        <td><?= $dBta['golonganDarah'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Terdaftar</td>
                                        <td>:</td>
                                        <td><?= date('d F Y H:i:s', strtotime($dBta['terdaftar'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">History Imunisasi (<?= $imunisasi->num_rows() ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Bidan</th>
                                        <th>Nama Balita</th>
                                        <th>Jenis</th>
                                        <th>Tanggal Imunisasi</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($imunisasi->result_array() as $dImn) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php
                                                    $this->db->where('id', $dImn['idBidan']);
                                                    foreach ($this->m_model->get_desc('tb_user')->result() as $vBn) {
                                                        echo $vBn->nama;
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $this->db->where('id', $dImn['idBalita']);
                                                    foreach ($this->m_model->get_desc('tb_balita')->result() as $vBta) {
                                                        echo $vBta->nama;
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $dImn['jenis'] ?></td>
                                            <td><?= date('d F Y', strtotime($dImn['tgl'])) ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($dImn['terdaftar'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">History Penimbangan (<?= $penimbangan->num_rows() ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Bidan</th>
                                        <th>Nama Balita</th>
                                        <th>Berat</th>
                                        <th>Panjang</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($penimbangan->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php
                                                    $this->db->where('id', $row['idBidan']);
                                                    foreach ($this->m_model->get_desc('tb_user')->result() as $vBn) {
                                                        echo $vBn->nama;
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $this->db->where('id', $row['idBalita']);
                                                    foreach ($this->m_model->get_desc('tb_balita')->result() as $vBta) {
                                                        echo $vBta->nama;
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $row['berat'] ?> kg</td>
                                            <td><?= $row['panjang'] ?> cm</td>
                                            <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>