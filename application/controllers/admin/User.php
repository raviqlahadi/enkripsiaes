<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ParagonIE\EasyRSA\KeyPair;
use ParagonIE\EasyRSA\EasyRSA;
use ParagonIE\EasyRSA\PrivateKey;
use ParagonIE\EasyRSA\PublicKey;

class User extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->cekLogin('admin');
    $this->load->model(array('m_user'));
  }

  private $current_page = 'user';

  //=============================== CRUD User Start Here ==========================
  private $name_user = [
    'user_email',
    'user_name',
    'user_phone',
    'user_birthplace',
    'user_birthdate',
    'user_sex',
    'user_password',
    'user_level',
    'user_address',

  ];

  //fungsi data User
  public function index(){

    //basic variable
    $key = $this->input->get('key');
    //pagination var
    $base_url = base_url() .$this->current_page.'/User/index';
    $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
    $total_records = (isset($key))
                      ? $this->m_user->search_count($key, $this->name_user)
                      : $this->m_user->get_total();
    $limit_per_page = 100;
    $start_record = $page*$limit_per_page;
    //set pagination
    if ($total_records>0) {
      $data['links'] = $this->setPagination($base_url, $total_records, $limit_per_page,4);
    }

    //get search key if exist
    $search_record = $this->m_user->search($key, $limit_per_page, $start_record, $this->name_user);
    //get data if key not exists
    $for_table = $this->m_user->get_current($limit_per_page, $start_record);
    //get flashdata

    $status = $this->session->flashdata('status');

    $data['status'] = (isset($status)) ? $status : NULL ;
    $data["data"] = (isset($key)) ? $search_record : $for_table;
    $data["number"] = $start_record;
    $data["current_page"] = $this->current_page."/User";


    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('admin/user/content', $data);
    $this->load->view('template/script');


  }


  public function create(){
    $parent = 'admin/'.$this->uri->segment(2);
    $data['parent'] = site_url($parent);
    $data['form_post'] = site_url($parent.'/insert');
    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('admin/user/create', $data);
    $this->load->view('template/script');
  }

  public function insert() {
      $name = $this->name_user;
      foreach ($name as $k_name => $v_name) {
        if($v_name=='user_password'){
          $data[$v_name] = sha1($this->input->post('user_password'));
        }else {
          $data[$v_name] = $this->input->post($v_name);
        }

      }
      //generate rsa key
      $keyPair  = KeyPair::generateKeyPair();
      $privateKey  = $keyPair->getPrivateKey();
      $publicKey = $keyPair->getPublicKey();

      $data['user_privatekey'] = $privateKey->getKey();
      $data['user_publickey'] = $publicKey->getKey();

      $query = $this->m_user->add($data);
      //log system
      if(!$query){
        $status['message'] = 'Terjadi Kesalahan';
        $status['type'] = 'danger';
        $status['color'] = 'blue';
        $this->session->set_flashdata('status', $status);
      }else{


        $status['message'] = 'Data telah ditambah ke database';
        $status['type'] = 'info';
        $status['color'] = 'blue';
        $this->session->set_flashdata('status', $status);
      }

      //redirect to page
      redirect('admin/user');

  }

  public function edit(){
    $parent = 'admin/'.$this->uri->segment(2);
    $id = $this->input->get('id');
    $data['parent'] = site_url($parent);
    $data['form_post'] = site_url($parent.'/update?id='.$id);
    $data['content'] = 'admin/user/edit';
    $data['name'] = $this->name_user;
    $data['id'] = $id;
    $where_data['user_id'] = $id;
    $data['form_value'] =  $this->m_user->getWhere($where_data)[0];
    if(!isset($data['form_value']) || $data['form_value'] == ""){
        redirect('admin/user');
    } else {
      $this->load->view('template/head');
      $this->load->view('template/sidemenu');
      $this->load->view('admin/user/edit', $data);
      $this->load->view('template/script');
    }
  }

  public function update() {

      //get data
      //$id_User=$this->m_user->record_count()+1;
      $id = $this->input->get('id');

      $name = $this->name_user;
      foreach ($name as $k_name => $v_name) {
        $data[$v_name] = $this->input->post($v_name);
      }
      unset($data['user_password']);
      //call function
      $query = $this->m_user->update($id, $data);
      //log system
      if(!$query){
        $status['message'] = 'Terjadi Kesalahan';
        $status['type'] = 'danger';
        $status['color'] = 'blue';
        $this->session->set_flashdata('status', $status);
      }else{

        $status['message'] = 'Data telah diubah ke database';
        $status['type'] = 'success';
        $status['color'] = 'blue';
        $this->session->set_flashdata('status', $status);
      }

      //redirect to page

      redirect('admin/user');

  }

  public function detail(){
    $parent = 'admin/'.$this->uri->segment(2);
    $id = $this->input->get('id');
    $data['parent'] = site_url($parent);
    $data['form_post'] = "#";
    $data['content'] = 'admin/user/detail';
    $data['name'] = $this->name_user;
    $where_data['user_id'] = $id;
    $data['form_value'] =  $this->m_user->getWhere($where_data)[0];

    $user_data = $data['form_value'];



    if(!isset($data['form_value']) || $data['form_value'] == ""){
        redirect('admin/user');
    } else {
      $this->load->view('admin/head');
      $this->load->view('admin/sidemenu');
      $this->load->view('admin/user/detail', $data);
      $this->load->view('admin/script');
    }
  }

  public function delete() {
    if($this->input->get('id')!="") {
      $w_delete['user_id'] = $this->input->get('id');
      $this->m_user->delete($w_delete);
      $status['message'] = 'Data Berhasil Di Hapus';
      $status['type'] = 'danger';
      $status['color'] = 'blue';
      $this->session->set_flashdata('status', $status);

    }else {
      redirect('admin/user');
    }
      //redirect to page
    redirect('admin/user');
  }


}
