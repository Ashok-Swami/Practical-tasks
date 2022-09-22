<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Products_Model');
    }
    public function index()
    {

        $response['allcategory'] = $this->Products_Model->prodcutview();
        // echo"<pre>";
        // print_r($response);
        $this->load->view('product/product_list', $response);
    }
    public function create_product()
    {
        $response['all_category'] = $this->Products_Model->prodcutview();
        $this->load->view('product/product_create', $response);
    }
    public function check_unique()
    {
        if (isset($_POST['pr'])) {
            $product_sub_category_name = $_POST['subcategory_name'];
            $category_id = $_POST['category_id'];

            $response = $this->Products_Model->check_records('product_subcategory_master', 'product_sub_category_name', $product_sub_category_name);
            if ($response == 0) {
                $description = $_POST['description'];
                $data = [
                    'product_category_no' => $category_id,
                    'product_sub_category_name' => $product_sub_category_name,
                    'description' => $description,
                    'IsActive' => 1,

                ];
                $data = $this->Products_Model->insert_data('product_subcategory_master', $data);
                if (!empty($data)) {
                    print json_encode(array('status' => '1', 'msg' => 'successfully inserted sub category'));
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
        $response['allcategory'] = $this->Products_Model->get_id_wise_detail('product_subcategory_master', 'id', $cat_id);
        $response['all_category'] = $this->Products_Model->get_all('product_category_master');
        $this->load->view('layout/header');
        $this->load->view('subcategory/subcategory_edit', $response);
        $this->load->view('layout/footer');
    }

    public function edit_data()
    {

        $editData['product_sub_category_name'] = $this->input->post('subcategory_name');
        $editData['description'] = $this->input->post('description');
        $editData['product_category_no'] = $this->input->post('category_id');

        // $editData['Last_Updated_Date'] = time('Y-m-d H:i:s');
        $id = $this->input->post('subcategory_id');
        $edit_check = $this->Products_Model->edit_check('product_subcategory_master', 'product_sub_category_name', $editData['product_sub_category_name'], $id);
        if (empty($edit_check)) {
            $update = $this->Products_Model->update('product_subcategory_master', $editData, $id);
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
        $delete = $this->Products_Model->delete_data('product_subcategory_master', $cat_id);
        if ($delete) {
            // $response['allcategory'] = $this->Products_Model->get_all('product_subcategory_master');
            // $this->load->view('layout/header');
            // $this->load->view('category/category_list',$response);
            // $this->load->view('layout/footer'); 
            // print json_encode(array('status' => '1', 'msg' => ' This product category deleted'));
            // die;
            redirect('subcategory');
        } else {
            print json_encode(array('status' => '0', 'msg' => 'somthing worng try again'));
            die;
        }
    }
    public function getsubcategory()
    {
        $cat_id = $_POST['selectVal'];
        if ($cat_id != '') {
            $option = $this->Products_Model->get_subcat('product_subcategory_master', $cat_id);
            if (!empty($option)) {
                print json_encode(array('status' => '1','results' => $option));
                die;
            } else {
                print json_encode(array('status' => '0', 'msg' => 'Please Add sub category first then you can add '));
                die;
            }
            // print_r($option);

        }
    }
}
