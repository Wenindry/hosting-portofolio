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
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Bidan</th>
                                <th>Nama Balita</th>
                                <th>Jenis</th>
                                <th>Tanggal Imunisasi</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($imunisasi->result_array() as $row) {
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
                                                $this->db->where('id', $vBta->idOrangtua);
                                                foreach ($this->db->get('tb_user')->result() as $nOrtu) {
                                                    echo $vBta->nama . ' - ' . $nOrtu->nama;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?= $row['jenis'] ?></td>
                                    <td><?= date('d F Y', strtotime($row['tgl'])) ?></td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('admin/imunisasi/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini?">
                                            <div class="fa fa-trash"></div> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
            </div>
            <form action="<?= base_url('admin/imunisasi/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bidan</label>
                        <select name="idBidan" class="select2" required style="width: 100%;">
                            <option value="" selected disabled>-- Pilih Bidan --</option>
                            <?php foreach ($bidan->result() as $iBn) { ?>
                                <option value="<?= $iBn->id ?>"><?= $iBn->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Balita</label>
                        <select name="idBalita" class="select2" required style="width: 100%;">
                            <option value="" selected disabled>-- Pilih Balita --</option>
                            <?php foreach ($balita->result() as $iBta) { ?>
                                <option value="<?= $iBta->id ?>">
                                    <?php
                                        $this->db->where('id', $iBta->idOrangtua);
                                        foreach ($this->db->get('tb_user')->result() as $iOrtu) {
                                            echo $iBta->nama . ' - ' . $iOrtu->nama;
                                        }
                                    ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" name="jenis" class="form-control" placeholder="Jenis" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tgl" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($imunisasi->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('admin/imunisasi/update/').$edit->id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bidan</label>
                            <select name="idBidan" class="select2" required style="width: 100%;">
                                <?php
                                    $this->db->where('id', $edit->idBidan);
                                    foreach ($this->m_model->get_desc('tb_user')->result() as $uBn) {
                                ?>
                                    <option value="<?= $uBn->id ?>"><?= $uBn->nama ?></option>
                                <?php } ?>
                                <option value="" disabled>-- Pilih Bidan Lain --</option>
                                <?php foreach ($bidan->result() as $iBn) { ?>
                                    <option value="<?= $iBn->id ?>"><?= $iBn->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Balita</label>
                            <select name="idBalita" class="select2" required style="width: 100%;">
                                <?php
                                    $this->db->where('id', $edit->idBalita);
                                    foreach ($this->m_model->get_desc('tb_balita')->result() as $uBta) {
                                ?>
                                    <option value="<?= $uBta->id ?>">
                                        <?php
                                            $this->db->where('id', $uBta->idOrangtua);
                                            foreach ($this->db->get('tb_user')->result() as $uOrtu) {
                                                echo $iBta->nama . ' - ' . $uOrtu->nama;
                                            }
                                        ?>
                                    </option>
                                <?php } ?>
                                <option value="" disabled>-- Pilih Balita Lain --</option>
                                <?php foreach ($balita->result() as $iBta) { ?>
                                    <option value="<?= $iBta->id ?>">
                                        <?php
                                            $this->db->where('id', $iBta->idOrangtua);
                                            foreach ($this->db->get('tb_user')->result() as $nOrtu) {
                                                echo $iBta->nama . ' - ' . $nOrtu->nama;
                                            }
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" name="jenis" class="form-control" placeholder="Jenis" value="<?= $edit->jenis ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tgl" class="form-control" value="<?= $edit->tgl ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                        <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>