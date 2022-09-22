<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('products_management_db');
    }
    public function check_records($tblname, $fname, $fvalue)
    {
        $this->db->select($fname);
        $this->db->distinct();
        $this->db->where($fname, $fvalue);
        $query = $this->db->get($tblname);
        return $query->num_rows();
    }
    public function insert_data($tblname, $data)
    {
        $this->db->insert($tblname, $data);
        return $this->db->insert_id();
    }
    public function get_all($tblname)
    {
        $this->db->select('*');
        $this->db->from($tblname);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_id_wise_detail($tblname,$fname,$id) {
        $this->db->select('*');
        $this->db->from($tblname);
        $this->db->where($fname, $id);
        $objQuery = $this->db->get();
        return $objQuery->result_array();
    }
    public function delete_data($tblname,$id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($tblname);  
    }
    public function update($tblname, $editData, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($tblname, $editData)) {
            return true;
        } else {
            return false;
        }
    }
    public function edit_check($tablname,$filedname,$checkdata,$id)
    {
        $this->db->from($tablname);
        $this->db->where($filedname, $checkdata);
        $this->db->where('id !=',$id);
        return $query = $this->db->get()->result_array();
    }
    public function subcategory_view()
    {
        $this->db->select('subcat.*,cat.category_name,cat.id as cid');
        $this->db->from('product_subcategory_master subcat');
        $this->db->join('product_category_master cat','cat.id = subcat.product_category_no','left');
        return $query =  $this->db->get()->result_array();
    }
    public function get_subcat($tblname,$id)
    {
        $this->db->select('id,product_sub_category_name');
        $this->db->from($tblname);
        $this->db->where('product_category_no', $id);
        $objQuery = $this->db->get()->result_array();
    
        return $objQuery;
    
    }
    public function prodcutview()
    {
        $this->db->select('*');
        $this->db->from('products_master pm');
        $this->db->join('product_subcategory_master subcat', 'subcat.id=pm.product_subcategory_no', 'left'); 
        $this->db->join('product_category_master cat','cat.id = subcat.product_category_no','left');
        return $query =  $this->db->get()->result_array();

    }
    
}
?>
