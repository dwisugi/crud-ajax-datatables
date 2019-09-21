<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_model extends CI_Model {

	var $table = 'datasantri';
	var $column_order = array(null,'namaDep','namaBel','jk','alamat','ttl'); //set column field database for datatable orderable
	var $column_search = array('namaDep','namaBel','alamat'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0; 
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query(); //load fungsi _get_datatables_query()
		if($_POST['length'] != -1) // length dari datatables
		$this->db->limit($_POST['length'], $_POST['start']); //menampilkan data dengan limit dari length sampai start
		$query = $this->db->get(); //query ambil data dari database
		return $query->result(); //mengembalikan nilai hasi ambil data
	}

	function count_filtered()
	{
		$this->_get_datatables_query(); //dari query ini
		$query = $this->db->get(); //mengambil data
		return $query->num_rows(); //menghitung jumlah data yang dihasilkan query
	}

	public function count_all()
	{
		$this->db->from($this->table); //mengambil dari tabel ini 
		return $this->db->count_all_results(); //mnghitung jumlah data
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table); //ambil dari database tabel ini
		$this->db->where('id',$id); // yang id nya harus sama
		$query = $this->db->get(); //eksekusi proses

		return $query->row(); //mengembalikan data (bila ada banyak ambil yang pertama)
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id(); //mendapatkan id yang terakhir dipakai
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows(); //mrnghitung jumlah baris yg berhasil dijalankan query
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}


}
