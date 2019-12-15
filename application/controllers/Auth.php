<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('m_user'));
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->login();
  }

  public function login(){
    $status = $this->session->flashdata('status');
    if(isset($status)){
      $data['status'] = $status;
    }else{
      $data = [];
    }
    $this->load->view('head');
    $this->load->view('auth/login', $data);
    $this->load->view('script');
  }

  public function register(){
    $status = $this->session->flashdata('status');
    if(isset($status)){
      $data['status'] = $status;
    }
    $data['content'] = 'auth/register';
    $this->load->view('index', $data);
  }

  public function regis_user(){
    $arr_name = ['user_name','user_password','user_email','user_phone'];
    $w_email['user_email'] = $this->input->post('user_email');
    $cek_email = $this->m_user->getWhere($w_email);
    if(!empty($cek_email)){
      $this->session->set_flashdata('status', 'Email yang di masukan telah terdaftar');
      redirect('auth/register');
    }
    foreach ($arr_name as $a) {
      if($a=='user_password'){
        $data[$a] = md5($this->input->post($a));
      }else {
        $data[$a] = $this->input->post($a);
      }
    }
    $data['user_level'] = 'user';
    $res = $this->m_user->add($data);
    if($res){
      $this->session->set_flashdata('status', 'Register berhasil, silahkan login untuk melanjutkkan');
      redirect('auth/login');
    }
  }

  public function cek_user(){
    $data['user_email'] = $this->input->post('user_email');
    $data['user_password'] = sha1($this->input->post('user_password'));

    $res = $this->m_user->getWhere($data)[0];
    if(empty($res)){
      $this->session->set_flashdata('status', 'Username or password is wrong!');
      redirect('auth/login');
    }else{
      $data = [
                'user_id' => $res->user_id,
                'user_name' => $res->user_name,
                'user_email' => $res->user_email,
                'user_level' => $res->user_level
              ];
      $this->session->set_userdata($data);
      if($res->user_level=='user'){
        redirect('user/dashboard');
      }elseif($res->user_level=='admin'){
        redirect('admin/dashboard');
      }
    }

  }

  public function logout(){
    $this->session->sess_destroy();
    redirect(base_url());
  }


}
