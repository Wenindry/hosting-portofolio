<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Balita extends CI_Controller {

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
		$data['title']		= 'Data Balita';
		$data['subtitle']	= 'Semua data balita akan muncul disini';

		$data['collapse']	= 'No';
        
        $this->db->where('level', 'Orang Tua');
		$data['orang_tua']       = $this->m_model->get_desc('tb_user');
		$data['balita']       = $this->m_model->get_desc('tb_balita');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/balita');
		$this->load->view('admin/templates/footer');
    }

    public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_balita');
		$this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
		redirect('admin/balita');
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');

		$idOrangtua		= $_POST['idOrangtua'];
		$nama			= $_POST['nama'];
		$jenisKelamin	= $_POST['jenisKelamin'];
		$tempatLahir	= $_POST['tempatLahir'];
		$tglLahir		= $_POST['tglLahir'];
		$berat			= $_POST['berat'];
		$panjang		= $_POST['panjang'];
		$golonganDarah	= $_POST['golonganDarah'];
		$terdaftar		= date('Y-m-d H:i:s');

        $data = array(
            'idOrangtua'    => $idOrangtua,
            'nama'          => $nama,
            'jenisKelamin'  => $jenisKelamin,
            'tempatLahir'   => $tempatLahir,
            'tglLahir'      => $tglLahir,
            'berat'         => $berat,
            'panjang'       => $panjang,
            'golonganDarah' => $golonganDarah,
            'terdaftar'     => $terdaftar,
        );

		$this->m_model->insert($data, 'tb_balita');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('admin/balita');
	}

	public function update($id)
	{
		$idOrangtua		= $_POST['idOrangtua'];
		$nama			= $_POST['nama'];
		$jenisKelamin	= $_POST['jenisKelamin'];
		$tempatLahir	= $_POST['tempatLahir'];
		$tglLahir		= $_POST['tglLahir'];
		$berat			= $_POST['berat'];
		$panjang		= $_POST['panjang'];
		$golonganDarah	= $_POST['golonganDarah'];

        $data = array(
            'idOrangtua'    => $idOrangtua,
            'nama'          => $nama,
            'jenisKelamin'  => $jenisKelamin,
            'tempatLahir'   => $tempatLahir,
            'tglLahir'      => $tglLahir,
            'berat'         => $berat,
            'panjang'       => $panjang,
            'golonganDarah' => $golonganDarah,
		);

        $where = array('id' => $id );

		$this->m_model->update($where, $data, 'tb_balita');
		$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
		redirect('admin/balita');
	}

	public function history($id)
	{
		$data['title']		= 'History Balita';
		$data['subtitle']	= 'history data balita akan muncul disini';

		$data['collapse']	= 'Yes';
        
        $this->db->where('id', $id);
		$data['balita']       	= $this->m_model->get_desc('tb_balita');
        $this->db->where('idBalita', $id);
		$data['imunisasi']      = $this->m_model->get_desc('tb_imunisasi');
        $this->db->where('idBalita', $id);
		$data['penimbangan']    = $this->m_model->get_desc('tb_penimbangan');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/historybalita');
		$this->load->view('admin/templates/footer');
    }
}