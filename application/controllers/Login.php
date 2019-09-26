<?php 

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();	
		if($this->session->userdata('status') == "login"){
			redirect(base_url("person"));
		}
		$this->load->model('person_model'); //load model person_model

	}

	function index(){
		$this->load->view('v_login'); //load view v_login
	}

	function aksi_login(){ //fungsi login
		$username = $this->input->post('username'); //get data from post method
		$password = $this->input->post('password');
		$where = array(
			'username' => $username, //masukkan ke variabel
			'password' => md5($password) //masukkan ke variabel dan ubah password
			);
		$cek = $this->person_model->cek_login("admin",$where)->num_rows(); //jalankan method
		if($cek > 0){ //jika $cek berhasil

			$data_session = array( 
				'nama' => $username, //masukkan username
				'status' => "login" // masukan status sudah login
				);

			$this->session->set_userdata($data_session); //jalankan session

			redirect(base_url("person")); //redirect ke halaman admin

		}else{
			echo "Username dan password salah !"; //jika salah maka tampilkan
		}
	}

	// function logout(){ //fungsi logout
	// 	$this->session->sess_destroy(); //matikan session
	// 	redirect(base_url('login')); //redirect ke halaman login
	// }
}