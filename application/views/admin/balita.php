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
                                <th>Orang Tua</th>
                                <th>Nama Balita</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>Berat</th>
                                <th>Panjang</th>
                                <th>Golongan Darah</th>
                                <th>Imunisasi</th>
                                <th>Penimbangan</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($balita->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idOrangtua']);
                                            foreach ($this->m_model->get_desc('tb_user')->result() as $vOt) {
                                                echo $vOt->nama;
                                            }
                                        ?>
                                    </td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenisKelamin'] ?></td>
                                    <td><?= $row['tempatLahir'] . ', ' . date('d F Y', strtotime($row['tglLahir'])) ?></td>
                                    <td>
                                        <?php
                                            $diff = date_diff(date_create(date("Y-m-d", strtotime($row['tglLahir']))), date_create(date("Y-m-d")));
                                            echo $diff->format('%y') . ' Tahun '. $diff->format('%m') . ' Bulan';
                                        ?>
                                    </td>
                                    <td><?= $row['berat'] ?> kg</td>
                                    <td><?= $row['panjang'] ?> cm</td>
                                    <td><?= $row['golonganDarah'] ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('idBalita', $row['id']);
                                            echo $this->db->get('tb_imunisasi')->num_rows();
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $this->db->where('idBalita', $row['id']);
                                            echo $this->db->get('tb_penimbangan')->num_rows();
                                        ?>
                                    </td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/balita/history/').$row['id'] ?>" class="btn btn-success btn-xs">
                                            <div class="fa fa-history"></div> History
                                        </a>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('admin/balita/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini?">
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
            <form action="<?= base_url('admin/balita/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Orang Tua</label>
                        <select name="idOrangtua" class="select2" required style="width: 100%;">
                            <option value="" selected disabled>-- Pilih Orang Tua --</option>
                            <?php foreach ($orang_tua->result() as $iOt) { ?>
                                <option value="<?= $iOt->id ?>"><?= $iOt->nama . ' - ' . $iOt->alamat ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Balita</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Balita" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenisKelamin" class="form-control" required>
                            <option value="" selected disabled> -- Pilih Jenis Kelamin -- </option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempatLahir" class="form-control" placeholder="Tempat Lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tglLahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Berat (kg)</label>
                                <input type="number" name="berat" class="form-control" placeholder="Berat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Panjang (cm)</label>
                                <input type="number" name="panjang" class="form-control" placeholder="Panjang" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Golongan Darah</label>
                        <select name="golonganDarah" class="form-control" required>
                            <option value="" disabled selected> -- Pilih Golongan Darah -- </option>
                            <option value="Tidak Diketahui">Tidak Diketahui</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
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
<?php foreach ($balita->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('admin/balita/update/').$edit->id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Orang Tua</label>
                            <select name="idOrangtua" class="select2" required style="width: 100%;">
                                <?php
                                $this->db->where('id', $edit->idOrangtua);
                                foreach ($this->m_model->get_desc('tb_user')->result() as $uOt) { ?>
                                    <option value="<?= $uOt->id ?>"><?= $uOt->nama . ' - ' . $uOt->alamat ?></option>
                                <?php } ?>
                                <option value="" disabled>-- Pilih Orang Tua Lain --</option>
                                <?php foreach ($orang_tua->result() as $iOt) { ?>
                                    <option value="<?= $iOt->id ?>"><?= $iOt->nama . ' - ' . $iOt->alamat ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Balita</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Balita" value="<?= $edit->nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenisKelamin" class="form-control" required>
                                <option value="Laki-Laki" <?= ($edit->jenisKelamin == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= ($edit->jenisKelamin == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempatLahir" class="form-control" placeholder="Tempat Lahir" value="<?= $edit->tempatLahir ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tglLahir" class="form-control" value="<?= $edit->tglLahir ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat (kg)</label>
                                    <input type="number" name="berat" class="form-control" placeholder="Berat" value="<?= $edit->berat ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Panjang (cm)</label>
                                    <input type="number" name="panjang" class="form-control" placeholder="Panjang" value="<?= $edit->panjang ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <select name="golonganDarah" class="form-control" required>
                                <option value="Tidak Diketahui" <?= ($edit->golonganDarah == 'Tidak Diketahui') ? 'selected' : '' ?>>Tidak Diketahui</option>
                                <option value="A" <?= ($edit->golonganDarah == 'A') ? 'selected' : '' ?>>A</option>
                                <option value="B" <?= ($edit->golonganDarah == 'B') ? 'selected' : '' ?>>B</option>
                                <option value="AB" <?= ($edit->golonganDarah == 'B') ? 'selected' : '' ?>>AB</option>
                                <option value="O" <?= ($edit->golonganDarah == 'O') ? 'selected' : '' ?>>O</option>
                            </select>
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