<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->model('Products_Model');
    }
    public function index()
    {

        $response['allcategory'] = $this->Products_Model->get_all('product_category_master');
        $this->load->view('category/category_list', $response);
    }
    public function create_category()
    {
        $this->load->view('category/category_create');
    }
    public function check_unique()
    {
        if (isset($_POST['category_name'])) {
            $category_name = $_POST['category_name'];
        
        $response = $this->Products_Model->check_records('product_category_master', 'category_name', $category_name);
        if ($response == 0) {
            $description = $_POST['description'];
            $data = [
                'category_name' => $category_name,
                'description' => $description,
                'IsActive' => 1,

            ];
            $data = $this->Products_Model->insert_data('product_category_master', $data);
            if (!empty($data)) {
                print json_encode(array('status' => '1', 'msg' => 'successfully completed category'));
                die;
            } else {
                print json_encode(array('status' => '0', 'msg' => 'somthing worng try again'));
                die;
            }
        } else {
            print json_encode(array('status' => '0', 'msg' => ' This product category name already exists'));
            die;
        }
    }
    }
    public function edit()
    {
        $cat_id = $this->uri->segment(3);
        $response['allcategory'] = $this->Products_Model->get_id_wise_detail('product_category_master', 'id', $cat_id);
        $this->load->view('layout/header');
        $this->load->view('category/category_edit', $response);
        $this->load->view('layout/footer');
    }

    public function edit_data()
    {

        $editData['category_name'] = $this->input->post('category_name');
        $editData['description'] = $this->input->post('description');
        // $editData['Last_Updated_Date'] = time('Y-m-d H:i:s');
        $id = $this->input->post('category_id');
        $edit_check = $this->Products_Model->edit_check('product_category_master', 'category_name', $editData['category_name'], $id);
        if (empty($edit_check)) {
            $update = $this->Products_Model->update('product_category_master', $editData, $id);
            if ($update) {
                print json_encode(array('status' => '1', 'msg' => 'successfully updated category'));
                die;
            } else {
                print json_encode(array('status' => '0', 'msg' => 'somthing worng try again'));
                die;
            }
        } else {
            print json_encode(array('status' => '0', 'msg' => ' This product category name already exists'));
            die;
        }
        
    }
    public function delete()
    {
        $cat_id = $this->uri->segment(3);
        $delete = $this->Products_Model->delete_data('product_category_master', $cat_id);
        if ($delete) {
            // $response['allcategory'] = $this->Products_Model->get_all('product_category_master');
            // $this->load->view('layout/header');
            // $this->load->view('category/category_list',$response);
            // $this->load->view('layout/footer'); 
            // print json_encode(array('status' => '1', 'msg' => ' This product category deleted'));
            // die;
            redirect('category');
        } else {
            print json_encode(array('status' => '0', 'msg' => 'somthing worng try again'));
            die;
        }
    }
}
