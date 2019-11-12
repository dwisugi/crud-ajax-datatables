<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller { 

	public function __construct()
	{
		parent::__construct(); //menjalankan construct dari parent CI
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('person_model','person'); //load file model person_model diganti person
		$this->load->library('Libsantri');
		// $this->faker = Faker\Factory::create('id_ID');
    }

	public function index() // fungsi index, file yang pertama kali dijalankan
	{
	
		
		// $this->load->helper('url'); // load helper url
		$this->load->view('home');
		// $this->load->view('person_view'); // pertama menjalankan file person view
	} 

	function logout(){ //fungsi logout
		$this->session->sess_destroy(); //matikan session
		redirect(base_url('login')); //redirect ke halaman login
	}
	
	public function santri()
	{
		$this->load->view('person_view');
	}

	public function ajax_list() //fungsi menampilkan list data
	{
		$this->load->helper('url'); // load helper url

		$list = $this->person->get_datatables(); //mengambil data dari modal
		$data = array(); //definisikan bahwa data berupa array
		$no = $_POST['start']; //datatables sampai ke berapa akan ditampilkan
		foreach ($list as $person) { // looping untuk menampilkan data
			$no++;
			$row = array(); 
			$row[] = '<input type="checkbox" class="data-check" value="'.$person->id.'">';
			$row[] = $person->namaDep;
			$row[] = $person->namaBel;
			$row[] = $person->jk;
			$row[] = $person->alamat;
			$tanggal = $person->ttl;
			$row[] = format_tanggal($tanggal);
			$row[] = '<img src="'. base_url('gambar/'.$person->image).'" width="64" />';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah_santri('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_santri('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
		
			$data[] = $row; //memasukkan data array ke variabel data
		}

		$output = array(
						"draw" => $_POST['draw'], //fungsi datatables
						"recordsTotal" => $this->person->count_all(), //fungsi datatables untuk menampilkan jumlah data di database
						"recordsFiltered" => $this->person->count_filtered(), // fungsi datatables untuk menampilkan jumlah data hasil query
						"data" => $data, //menampilkan data
				);
		//mengubah output menjadi format json
		echo json_encode($output);
	}

	public function ajax_edit($id) 
	{
		$data = $this->person->get_by_id($id); //mengambil data sesuai id
		// $data->ttl = ($data->ttl == '0000-00-00') ? '' : $data->ttl; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{ 
		$this->_validate();
		
		$data = array( //mengambil data dari post
				// 'id' => uniqid(),
				'namaDep' => $this->input->post('namaDep'), 
				'namaBel' => $this->input->post('namaBel'),
				'jk' => $this->input->post('jk'),
				'alamat' => $this->input->post('alamat'),
				'ttl' => $this->input->post('ttl'),
				'image' => $this->person->_uploadImage(),
			);

		$insert = $this->person->save($data);

		echo json_encode(array("status" => TRUE));
	}



	

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'namaDep' => $this->input->post('namaDep'),
				'namaBel' => $this->input->post('namaBel'),
				'jk' => $this->input->post('jk'),
				'alamat' => $this->input->post('alamat'),
				'ttl' => $this->input->post('ttl'),

				// if (!empty($_FILES["image"]["name"])) {
				// 	'image' = $this->person->_uploadImage();
				// } else {
				// 	'image' = $this->input->post("old_image");
				// }
			);
		$this->person->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_bulk_delete()
	{
		$list_id = $this->input->post('id');
		foreach ($list_id as $id) {
			$this->person->delete_by_id($id);
		}
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('namaDep') == '')
		{
			$data['inputerror'][] = 'namaDep';
			$data['error_string'][] = 'Nama Depan Perlu Diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('namaBel') == '')
		{
			$data['inputerror'][] = 'namaBel';
			$data['error_string'][] = 'Nama Belakang Perlu Diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('ttl') == '')
		{
			$data['inputerror'][] = 'ttl';
			$data['error_string'][] = 'Tanggal Lahir Perlu Diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('jk') == '')
		{
			$data['inputerror'][] = 'jk';
			$data['error_string'][] = 'Tolong Pilih Salah Satu';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat Perlu Diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}



}
