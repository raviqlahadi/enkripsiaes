<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('user/about/content');
    $this->load->view('template/script');
  }


}
