<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->cekLogin('admin');
    $this->load->model(array('m_post'));
  }

  private $current_page = 'kibtanah';

  //=============================== CRUD post Start Here ==========================
  private $name_post = [
    'post_title',
    'post_content',
    'post_image',
    'post_file',
    'user_id',
  ];

  //fungsi data post
  public function index(){

    //basic variable
    $key = $this->input->get('key');
    //pagination var
    $base_url = base_url() .$this->current_page.'/post/index';
    $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
    $total_records = (isset($key))
                      ? $this->m_post->search_count($key, $this->name_post)
                      : $this->m_post->get_total();
    $limit_per_page = 100;
    $start_record = $page*$limit_per_page;
    //set pagination
    if ($total_records>0) {
      $data['links'] = $this->setPagination($base_url, $total_records, $limit_per_page,4);
    }

    //get search key if exist
    $search_record = $this->m_post->search($key, $limit_per_page, $start_record, $this->name_post);
    //get data if key not exists
    $for_table = $this->m_post->get_current($limit_per_page, $start_record);
    //get flashdata

    $status = $this->session->flashdata('status');
    $data['status'] = (isset($status)) ? $status : NULL ;
    $data["data"] = (isset($key)) ? $search_record : $for_table;
    $data["number"] = $start_record;
    $data["current_page"] = $this->current_page."/post";
    $data['content'] = 'admin/post/content';
    $this->load->view('admin/index', $data);

  }


  public function create(){
    $parent = 'admin/'.$this->uri->segment(2);
    $data['parent'] = site_url($parent);
    $data['form_post'] = site_url($parent.'/insert');
    $data['content'] = 'admin/post/create';
    $this->load->view('admin/index',$data);
  }

  public function insert() {

     $config['upload_path']          = './uploads/img/';
     $config['allowed_types']        = 'gif|jpg|png|pdf';
     $config['max_size']             = 10000;
     $config['max_width']            = 8024;
     $config['max_height']           = 8024;

     $this->load->library('upload', $config);

     $name = $this->name_post;
     unset($name['post_image']);
     unset($name['post_file']);

     foreach ($name as $k_name => $v_name) {
       if ($v_name=='user_id') {
         $data[$v_name] = $this->session->userdata('user_id');
       } else {
         $data[$v_name] = $this->input->post($v_name);
       }
     }

     if ( ! $this->upload->do_upload('post_image')){
        $error = array('error' => $this->upload->display_errors());
        var_dump($error);
        $data['post_image'] = 'no_image.jpg';
     }else{
       $image_data = $this->upload->data();
       $data['post_image'] = $image_data['file_name'];
     }

     $this->load->library('upload', $config);

     if ( ! $this->upload->do_upload('post_file')){

        $error = array('error' => $this->upload->display_errors());
        var_dump($error);
        $data['post_file'] = null;
     }else{
       $file_data = $this->upload->data();
       $data['post_file'] = $file_data['file_name'];
     }

      $query = $this->m_post->add($data);
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
    //  redirect('admin/post');

  }

  public function edit(){
    $parent = 'admin/'.$this->uri->segment(2);
    $id = $this->input->get('id');
    $data['parent'] = site_url($parent);
    $data['form_post'] = site_url($parent.'/update?id='.$id);
    $data['content'] = 'admin/post/edit';
    $data['name'] = $this->name_post;
    $where_data['post_id'] = $id;
    $data['form_value'] =  $this->m_post->getWhere($where_data)[0];
    if(!isset($data['form_value']) || $data['form_value'] == ""){
        redirect('admin/post');
    } else {
        $this->load->view('admin/index',$data);
    }
  }

  public function update() {

      //get data
      //$id_post=$this->m_post->record_count()+1;
      $id = $this->input->get('id');

      $config['upload_path']          = './uploads/img/';
      $config['allowed_types']        = 'gif|jpg|png|pdf';
      $config['max_size']             = 10000;
      $config['max_width']            = 8024;
      $config['max_height']           = 8024;

      $this->load->library('upload', $config);

      $name = $this->name_post;
      unset($name['post_image']);
      unset($name['post_file']);

      foreach ($name as $k_name => $v_name) {
        if ($v_name=='user_id') {
          $data[$v_name] = $this->session->userdata('user_id');
        } else {
          $data[$v_name] = $this->input->post($v_name);
        }
      }

      if ( ! $this->upload->do_upload('post_image')){
         //$error = array('error' => $this->upload->display_errors());
         //var_dump($error);
         //$data['post_image'] = 'no_image.jpg';
      }else{
        $image_data = $this->upload->data();
        $data['post_image'] = $image_data['file_name'];
      }

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('post_file')){
         $error = array('error' => $this->upload->display_errors());
         //var_dump($error);
         //$data['post_file'];
      }else{
        $file_data = $this->upload->data();
        $data['post_file'] = $file_data['file_name'];
      }

      //call function
      $query = $this->m_post->update($id, $data);
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

      redirect('admin/post');

  }

  public function detail(){
    $parent = 'admin/'.$this->uri->segment(2);
    $id = $this->input->get('id');
    $data['parent'] = site_url($parent);
    $data['form_post'] = "#";
    $data['content'] = 'admin/post/detail';
    $data['name'] = $this->name_post;
    $where_data['post_id'] = $id;
    $data['form_value'] =  $this->m_post->getWhere($where_data)[0];
    if(!isset($data['form_value']) || $data['form_value'] == ""){
        redirect('admin/post');
    } else {

        $this->load->view('admin/index',$data);
    }
  }

  public function delete() {
    if($this->input->get('id')!="") {
      $w_delete['post_id'] = $this->input->get('id');
      $this->m_post->delete($w_delete);
      $status['message'] = 'Data Berhasil Di Hapus';
      $status['type'] = 'danger';
      $status['color'] = 'blue';
      $this->session->set_flashdata('status', $status);

    }else {
      redirect('admin/post');
    }
      //redirect to page
    redirect('admin/post');
  }


}
