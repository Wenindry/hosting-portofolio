<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Imunisasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('licensing');
        $this->licensing->check_license();
		if(!$this->session->userdata('level')){
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		}
	}

	public function index()
	{
		$data['title']		= 'Data Imunisasi';
		$data['subtitle']	= 'Semua data imunisasi akan muncul disini';

		$data['collapse']	= 'No';
        
        $this->db->where('level', 'Bidan');
		$data['bidan']       = $this->m_model->get_desc('tb_user');
		$data['balita']         = $this->m_model->get_desc('tb_balita');
		$data['imunisasi']       = $this->m_model->get_desc('tb_imunisasi');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/imunisasi');
		$this->load->view('admin/templates/footer');
    }

    public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_imunisasi');
		$this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
		redirect('admin/imunisasi');
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');

		$idBidan		= $_POST['idBidan'];
		$idBalita		= $_POST['idBalita'];
		$jenis	        = $_POST['jenis'];
		$tgl	        = $_POST['tgl'];
		$terdaftar		= date('Y-m-d H:i:s');

        $data = array(
            'idBidan'       => $idBidan,
            'idBalita'      => $idBalita,
            'jenis'         => $jenis,
            'tgl'           => $tgl,
            'terdaftar'     => $terdaftar,
        );

		$this->m_model->insert($data, 'tb_imunisasi');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('admin/imunisasi');
	}

	public function update($id)
	{
		$idBidan		= $_POST['idBidan'];
		$idBalita		= $_POST['idBalita'];
		$jenis	        = $_POST['jenis'];
		$tgl	        = $_POST['tgl'];

        $data = array(
            'idBidan'       => $idBidan,
            'idBalita'      => $idBalita,
            'jenis'         => $jenis,
            'tgl'           => $tgl,
		);

        $where = array('id' => $id );

		$this->m_model->update($where, $data, 'tb_imunisasi');
		$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
		redirect('admin/imunisasi');
	}
}