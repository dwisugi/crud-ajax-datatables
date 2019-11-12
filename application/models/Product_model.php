<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{
 
    private $_table = "gambar";

    public $id_gambar;
    public $image = "default.jpg";

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_gambar" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->id_gambar = uniqid();
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->product_id = $post["id"];
        $this->db->update($this->_table, $this, array('id_gambar' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_gambar" => $id));
    }

}