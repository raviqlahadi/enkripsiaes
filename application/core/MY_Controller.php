<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{



  public function __construct(){
    parent::__construct();
    $this->load->helper('url');

  }
  public function cekLogin($level)
  {
    if($this->session->userdata('user_level')!=$level){
      redirect('auth/login');
    }
  }
  public function cekAkses($menu_link){
    $this->load->model(array('m_group','m_menu','m_menugroupmember'));


    $w_group['group_id'] = $this->session->userdata('group_id');
    $group_data = $this->m_group->getWhere($w_group)[0];
    $w_menu['menu_link'] = $menu_link;
    $menu_data = $this->m_menu->getWhere($w_menu)[0];

    $w['menu_id'] = $menu_data->menu_id;
    $w['menugroup_id'] = $group_data->menugroup_id;

    $result = $this->m_menugroupmember->getWhere($w);
    if($result==null){
      redirect('homepage');
    }

  }

  public function getUserData(){
    $userdata = $this->session->userdata();
    return  $userdata;
  }

  public function getSkpd(){
    $this->load->model(array('m_skpd'));
    $group_id = $this->session->userdata('group_id');
    $id_skpd = $this->session->userdata('id_skpd');
    if($group_id=='group1000'){
      return $this->m_skpd->get();
    }else{
      return $this->m_skpd->getWhere(array('id_skpd'=>$id_skpd));
    }
  }
  public function userLevel(){
    $userdata = $this->getUserData();
    return $userdata['level'];
  }


  public function is_connected()
  {
      $connected = @fsockopen("www.google.com", 80);
                                          //website, port  (try 80 or 443)
      if ($connected){
          $is_conn = true; //action when connected
          fclose($connected);
      }else{
          $is_conn = false; //action in connection failure
      }
      return $is_conn;

  }


  public function getCrudData($crudname){
    $this->load->model(array('m_crud'));
    $where['crud_name'] = $crudname;
    $data = $this->m_crud->getWhere($where);
    if(empty($data)){
      $status['message'] = 'Registrasi crud first';
      $status['type'] = 'add';
      $status['color'] = 'yellow';
      $this->session->set_flashdata('status', $status);
      redirect('crud/create');
    }else{
      return $data[0];
    }
  }
  function error_message($msg){
    echo $msg;
  }

  public function getMenu(){
    $this->load->model(array('m_menu','m_group'));
    $w_group['group_id'] = $this->session->userdata('group_id');
    $level_data = $this->m_group->getWhere($w_group)[0];
    $w['menugroup_id'] = $level_data->menugroup_id;
    $menugroup_data = $this->m_menu->getMenu($w);

    $menu = array();
    foreach ($menugroup_data as $key => $value) {
      if($value->parent_id==0){
        $menu[$value->menu_id]['menu']=$value;
      }else {
        if (!isset($menu[$value->parent_id]['sub_menu'])) {
          $menu[$value->parent_id]['sub_menu']=array($value);
        }else{
          array_push($menu[$value->parent_id]['sub_menu'], $value);
        }

      }
    }
    //var_dump($menu);

    return $menu;
  }

  public function callCkeditor(){
    $this->load->library('ckeditor');
    //$this->load->library('ckfinder');

    $this->ckeditor->basePath = base_url().'assets/ckeditor/';
    $this->ckeditor->config['toolbar'] = array(
                    array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                        );
    $this->ckeditor->config['language'] = 'it';
    $this->ckeditor->config['width'] = '';
    $this->ckeditor->config['height'] = '300px';
  }

  public function getBreadcrumbs($parent, $current_page, $child){
    //breadcrumbs
    $this->mybreadcrumb->add('Dashboard', base_url('dashboard'));
    if(!empty($parent)) $this->mybreadcrumb->add(ucfirst($parent), base_url($parent));
    $this->mybreadcrumb->add(ucfirst($current_page), base_url($current_page));
    if (!empty($child)) $this->mybreadcrumb->add(ucfirst($child), base_url($current_page.'/'.$child));
        $breadcrumbs = $this->mybreadcrumb->render();
    $breadcrumbs = str_replace('breadcrumb','breadcrumb ',$breadcrumbs);
    //end breadcrumb
    return $breadcrumbs;
  }

  public function setPagination($base_url, $total_records, $limit_per_page, $uri_segment = 3){
    $config['base_url'] = $base_url;
    $config['total_rows'] = $total_records;
    $config['per_page'] = $limit_per_page;
    $config["uri_segment"] = $uri_segment;

    // custom paging configuration
    $config['num_links'] = $total_records/$limit_per_page;
    $config['use_page_numbers'] = TRUE;
    $config['reuse_query_string'] = TRUE;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    // build paging links
    return $this->pagination->create_links();
  }

  //remove already exit data for select
  public function removeExistData($dataA, $dataB, $var){
    foreach ($dataA as $key => $value) {
      foreach ($dataB as $k => $v) {
        if($value->{$var}==$v->{$var}){
          unset($dataA[$key]);
        }
      }
    }
    return $dataA;
  }

}
