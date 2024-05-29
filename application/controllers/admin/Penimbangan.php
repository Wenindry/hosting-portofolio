<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Penimbangan extends CI_Controller {

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
		$data['title']		= 'Data Penimbangan';
		$data['subtitle']	= 'Semua data penimbangan akan muncul disini';

		$data['collapse']	= 'No';
        
        $this->db->where('level', 'Bidan');
		$data['bidan']       = $this->m_model->get_desc('tb_user');
		$data['balita']         = $this->m_model->get_desc('tb_balita');
		$data['penimbangan']       = $this->m_model->get_desc('tb_penimbangan');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/penimbangan');
		$this->load->view('admin/templates/footer');
    }

    public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_penimbangan');
		$this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
		redirect('admin/penimbangan');
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');

		$idBidan		= $_POST['idBidan'];
		$idBalita		= $_POST['idBalita'];
		$berat	        = $_POST['berat'];
		$panjang	    = $_POST['panjang'];
		$terdaftar		= date('Y-m-d H:i:s');

        $data = array(
            'idBidan'       => $idBidan,
            'idBalita'      => $idBalita,
            'berat'         => $berat,
            'panjang'       => $panjang,
            'terdaftar'     => $terdaftar,
        );

		$this->m_model->insert($data, 'tb_penimbangan');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('admin/penimbangan');
	}

	public function update($id)
	{
		$idBidan		= $_POST['idBidan'];
		$idBalita		= $_POST['idBalita'];
		$berat	        = $_POST['berat'];
		$panjang	    = $_POST['panjang'];

        $data = array(
            'idBidan'       => $idBidan,
            'idBalita'      => $idBalita,
            'berat'         => $berat,
            'panjang'       => $panjang,
		);

        $where = array('id' => $id );

		$this->m_model->update($where, $data, 'tb_penimbangan');
		$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
		redirect('admin/penimbangan');
	}
}