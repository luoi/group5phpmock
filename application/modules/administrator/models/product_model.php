<?php

/**
 * @author easyvn.net
 * @copyright 2014
 */

class product_model extends CI_Model{
    protected $_table = 'tbl_product';
    protected $_primary = 'pro_id';
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
   public function getAll(){
       $list = $this->db->get($this->_table);
       return $list->result_array();
   }
    
    public function countAll(){
        return $this->db->count_all_results($this->_table);
    }
    public function get_page($limit, $start){
        $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    } // end get_page()
    
    public function get_order($type = '', $limit = '', $start = ''){
        $sql = "SELECT * FROM {$this->_table}";
        //if($type) $sql .=" ORDER BY bran_name {$type}";
        $sql .= " LIMIT {$limit},{$start}";
      //  echo $sql;
        $result = mysql_query($sql);

       // print_r($result);
        $data = array();
        while($row = mysql_fetch_assoc($result)){
            $data[] = $row; 
        }
        return $data;
    } // end get_order()

    // writen by HoangHH
    public function deleteProduct($id){
        $this->db->where("pro_id = $id");
        $this->db->delete($this->_table);
        $this->db->where("pro_id = $id");
        $this->db->delete("tbl_cateproduct");
        $this->db->where("pro_id = $id");
        $this->db->delete("tbl_images");
        
    
    } // end deleteProduct

    
    public function count_all(){
        $this->db->from($this->_table);
        return $this->db->count_all_results();
        // return $this->db->get($this->_table)->result_array();
    }

    // writen by HoangHH
    public function getSearch($where, $start, $limit){
        // return $this->db->get_where($this->_table, $where, $limit, $start) -> result_array();
        $this->db->like($where);
        $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    } // end getSearch()

    public function getSearchAll($where){
        // return $this->db->get_where($this->_table, $where, $limit, $start) -> result_array();
        $this->db->like($where);
        
        return $this->db->get($this->_table)->result_array();
    } // end getSearch()

    // VietDQ
    public function update($data,$id)
    {
        $this->db->where("pro_id = $id");
        $this->db->update($this->_table,$data);
    }

    public function detailid($id)
    {
        $this->db->where("pro_id = $id");
        return $this->db->get($this->_table)->row_array();
    }

    public function detail($name)
    {
        $this->db->where('pro_name = "'.$name.'"');
        return $this->db->get($this->_table)->row_array();
    }
    // end VietDQ

     /*
    * HuanDT lam function insertProduct
    */
    // start insertProduct
    public function insertProduct($data){
        $this->db->insert($this->_table,$data);
    } // end insert()
    // end insertProduct
} // end class product_model

?>