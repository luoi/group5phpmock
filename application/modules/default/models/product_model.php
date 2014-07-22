<?php
class product_model extends CI_Model
{
    protected $_table = "tbl_product";
    public function __construct()
    {
        parent::__construct();
         $this->load->database();   
    }
    public function listProduct()
    {  
        return $this->db->get($this->_table)->result_array();    
    }
    public function detailProduct($id)
    {
        $this->db->where("pro_id = $id");
        return $this->db->get($this->_table)->row_array();
    }
    public function countTable()
    {
        return $this->db->get($this->_table)->num_rows();
    }
    public function insertProduct($data = array()) {
        $this->db->insert($this->_table,$data);
    }
    public function updateProduct($data,$id)
    {
        $this->db->where("pro_id = $id");
        $this->db->update($this->_table,$data);
    }
    public function deleteProduct($id)
    {
        $this->db->where("pro_id = $id");
        $this->db->delete($this->_table);
    }
    
}