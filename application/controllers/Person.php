<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller { 

	public function __construct()
	{
		parent::__construct(); //menjalankan construct dari parent CI
		$this->load->model('person_model','person'); //load file model person_model diganti person
        // $this->faker = Faker\Factory::create('id_ID');
    }

	public function index() // fungsi index, file yang pertama kali dijalankan
	{
        
		$this->load->helper('url'); // load helper url
		$this->load->view('person_view'); // pertama menjalankan file person view
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
			$row[] = $person->ttl;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
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
		$data = $this->person->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array( //mengambil data dari post
				'firstName' => $this->input->post('firstName'), 
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
			);

		$insert = $this->person->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
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

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'Please select gender';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
