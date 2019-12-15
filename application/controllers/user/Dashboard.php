<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends MY_Controller{
  private $dir = './uploads';
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('directory','file'));
    $this->load->model(array('m_user'));

    /*
    $keyPair = KeyPair::generateKeyPair();

    $secretKey = $keyPair->getPrivateKey();
    $publicKey = $keyPair->getPublicKey();

    //var_dump($publicKey->getKey());
    //var_dump($secretKey->getKey());

    $message = 'hello enkrip';
    $chipertext = EasyRSA::encrypt($message, $publicKey);
    $plainText = EasyRSA::decrypt($chipertext, $secretKey);

    var_dump($message, $chipertext, $plainText);
    */
  }

  function index()
  {
    $dir = $this->dir;
    $map = directory_map($dir);
    
    $data['file_local'] = sizeof($map);
    $data['user'] = $this->m_user->get_total();

    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('template/content', $data);
    $this->load->view('template/script');
  }

}
