<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  function __construct() {
      parent::__construct();
  }

  public function index(){
    $data['content'] = 'beranda/content';
    $this->load->view('head');
    $level = $this->session->user_level;
    
    if ($level!=null) {

      redirect($level.'/dashboard');
    }
    $this->load->view('auth/login', $data);
    $this->load->view('script');
  }

}
