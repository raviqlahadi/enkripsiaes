<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ParagonIE\EasyRSA\KeyPair;
use ParagonIE\EasyRSA\EasyRSA;
use ParagonIE\EasyRSA\PrivateKey;
use ParagonIE\EasyRSA\PublicKey;


class File extends MY_Controller{


  private $storage;
  public function __construct()
  {
    parent::__construct();
    //$this->cekLogin('user');
    $this->load->model(array('m_file','m_user'));
    $this->load->helper(array('directory','file'));


  }

  private $current_page = 'file';
  private $dir = './uploads';
  //=============================== CRUD file Start Here ==========================
  private $name_file = [
    'file_name',
    'file_size',
    'file_type',
    'user_id'
  ];


  public function index(){
    $dir = $this->dir;
    $map = directory_map($dir);
    $file = $this->m_file->get();
    $file_info = [];
    foreach($file as $k => $f){
      $file_info[$k] = $this->file_info($f);
    }



    //var_dump($file_info);

    $status = $this->session->flashdata('status');

    $data['status'] = (isset($status)) ? $status : NULL ;

    $data["current_page"] = $this->current_page."/file";
    $data['content'] = 'user/file/content';
    $data['list_file'] = $file_info;

    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('user/file/content',$data);
    $this->load->view('template/script');

  }

  public function create(){
    $parent = 'user/'.$this->uri->segment(2);
    $data['parent'] = site_url($parent);
    $data['user'] = $this->m_user->get();
    $data['form_post'] = site_url($parent.'/insert');
    $data['content'] = 'user/file/create';
    $status = $this->session->flashdata('status');
    $data['status'] = (isset($status)) ? $status : NULL ;

    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('user/file/create',$data);
    $this->load->view('template/script');


  }

  public function edit($id){
    $parent = $this->session->user_level.'/'.$this->uri->segment(2);
    //$id = $this->input->get('id');

    $data['parent'] = site_url($parent);
    $data['user'] = $this->m_user->get();
    $data['form_post'] = site_url($parent.'/update?id='.$id);
    $data['content'] = 'user/file/edit';
    $data['name'] = $this->name_file;
    $data['id'] = $id;
    $where_data['file_id'] = $id;



    $data['form_value'] =  $this->m_file->getWhere($where_data)[0];

    foreach ($data['user'] as $key => $value) {
      if($value->user_id==$data['form_value']->owner_id){
        $data['uploader'] = $value->user_name;
      }
    }

    $this->load->view('template/head');
    $this->load->view('template/sidemenu');
    $this->load->view('user/file/edit',$data);
    $this->load->view('template/script');


  }

  public function update() {
      $dir = $this->dir;
      //get data
      //$id_User=$this->m_user->record_count()+1;
      $id = $this->input->get('id');

      $file_data =  $this->m_file->getWhere(array('file_id' => $id))[0];
      $user_data = $this->m_user->getWhere(array('user_id'=>$file_data->user_id))[0];

      $file_contents = file_get_contents($dir.'/'.$file_data->file_name);
      $plaintext = EasyRSA::decrypt($file_contents, New PrivateKey($user_data->user_privatekey));
      $file_name = $file_data->file_name;
      file_put_contents($dir.'/de_'.$file_name, base64_decode($plaintext));
      unlink($dir.'/'.$file_name);
      $file_contents_de = base64_encode(file_get_contents($dir.'/de_'.$file_name));
      $new_user = $this->m_user->getWhere(array('user_id'=>$this->input->post('user_id')))[0];
      $cipher = EasyRSA::encrypt($file_contents_de, New PublicKey($new_user->user_publickey));

      file_put_contents($dir.'/'.$file_name, $cipher);
      unlink($dir.'/de_'.$file_name);

      $name = $this->name_file;
      foreach ($name as $k_name => $v_name) {
        if($this->input->post($v_name)!=null){
            $data[$v_name] = $this->input->post($v_name);
        }
      }


      //call function
      $query = $this->m_file->update($id, $data);

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
      $level = $this->session->user_level;
      redirect($level.'/file');

  }

  public function upload() {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'pdf|docx|doc|xls|xlsx|ppt|pptx';
        $config['max_size']             = 10000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')){
                $status['message'] = 'Terjadi Kesalahan. Error: '.$this->upload->display_errors();
                $status['type'] = 'danger';
                $status['color'] = 'blue';
                $this->session->set_flashdata('status', $status);
                redirect('user/file/create');
        }else{
                $upload_data = $this->upload->data();
                $status['message'] = 'Data '.$upload_data['file_name'].' berhasil di upload';
                $status['type'] = 'info';
                $status['color'] = 'blue';
                $this->session->set_flashdata('status', $status);
                $data['file_name'] = $upload_data['file_name'];
                $data['owner_id'] = $this->session->user_id;
                $user_id = $this->input->post('user_id');
                if($user_id==''){
                  $data['user_id'] = $user_id;
                }else{
                  $data['user_id'] = $user_id;
                  $this->encrypt($data['file_name'],$user_id);
                }

                $store = $this->m_file->add($data);
                if($store){
                  redirect('admin/file');
                }
        }



  }

  public function encrypt($file, $user_id){

    $dir = $this->dir;
    //$info = $this->file_info($file);
    $user_data = $this->m_user->getWhere(array('user_id'=>$user_id))[0];
    $start = microtime(true);

    $file_contents = base64_encode(file_get_contents($dir.'/'.$file));

    $cipher = EasyRSA::encrypt($file_contents, New PublicKey($user_data->user_publickey));


    file_put_contents($dir.'/'.$file, $cipher);
    $time_elapsed_secs = microtime(true) - $start;

    $status['message'] = 'Data '.$file.' berhasil di enkrip dengan waktu: '.$time_elapsed_secs.' s';
    $status['type'] = 'info';
    $status['color'] = 'blue';
    $this->session->set_flashdata('status', $status);

  }

  public function decrypt($id){

    $start = microtime(true);
    $dir = $this->dir;
    $file = $this->m_file->getWhere(array('file_id'=>$id))[0];
    $info = $this->file_info($file);
    $user_id = $this->session->userdata('user_id');
    $level = $this->session->user_level;
    if($file->user_id!=0){
      if($user_id==$file->owner_id){
          $user_id=$file->user_id;
      }elseif($level=='admin'){
        $user_id=$file->user_id;
      }

      $user_data = $this->m_user->getWhere(array('user_id'=>$user_id))[0];
      $file_contents = file_get_contents($dir.'/'.$file->file_name);

      //var_dump($file_contents);
      try {
        $plaintext = EasyRSA::decrypt($file_contents, New PrivateKey($user_data->user_privatekey));
        $file_name = $file->file_name;
      } catch (Exception $e) {
        $status['message'] = 'Anda tidak memiliki akses ke file ini';
        $status['type'] = 'danger';
        $status['color'] = 'red';
        $this->session->set_flashdata('status', $status);

        if(file_exists($dir.'/'.$file->file_name)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($dir.'/'.$file->file_name).'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($dir.'/'.$file->file_name));
          flush(); // Flush system output buffer
          readfile($dir.'/'.$file->file_name);
          exit;
        }

        redirect('user/file');
      }

      file_put_contents($dir.'/de_'.$file_name, base64_decode($plaintext));
      $time_elapsed_secs = microtime(true) - $start;
      if(file_exists($dir.'/de_'.$file_name)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($dir.'/de_'.$file_name).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($dir.'/de_'.$file_name));
        flush(); // Flush system output buffer
        readfile($dir.'/de_'.$file_name);
        unlink($dir.'/de_'.$file_name);
        exit;
      }
      unlink($dir.'/de_'.$file_name);
      $status['message'] = 'Data '.$file->file_name.' berhasil di dekrip dengan waktu: '.$time_elapsed_secs.' s';
      $status['type'] = 'info';
      $status['color'] = 'blue';
      $this->session->set_flashdata('status', $status);
      redirect('user/file');
    }else{
      if(file_exists($dir.'/'.$file->file_name)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($dir.'/'.$file->file_name).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($dir.'/'.$file->file_name));
        flush(); // Flush system output buffer
        readfile($dir.'/'.$file->file_name);
        exit;
      }

      redirect('user/file');
    }


    $status = $this->session->flashdata('status');
    $data['status'] = (isset($status)) ? $status : NULL ;
    $parent = 'user/'.$this->uri->segment(2);
    $data['parent'] = site_url($parent);
    $data['form_post'] = site_url($parent.'/insert');
    $data['file_info'] = $info;

    $this->load->view('user/head');
    $this->load->view('user/header');
    $this->load->view('user/file/dekripsi',$data);
    $this->load->view('user/footer');
    $this->load->view('user/script');

  }

  public function delete($id) {
    $file = $this->m_file->getWhere(array('file_id'=>$id))[0];
    unlink($this->dir.'/'.$file->file_name );
    $this->m_file->delete(array('file_id'=>$id));
    $status['message'] = 'Data '.$file.' berhasil di delete';
    $status['type'] = 'info';
    $status['color'] = 'blue';
    $this->session->set_flashdata('status', $status);
    $level = $this->session->user_level;
    redirect($level.'/file');

  }

  function file_info($f){
    $dir = $this->dir;
    $obj = new \stdClass;
    $obj->id = $f->file_id;
    $obj->name = $f->file_name;
    $obj->from = $this->m_user->getWhere(array('user_id'=>$f->owner_id))[0]->user_name;
    $obj->for = ($f->user_id!=0) ? $this->m_user->getWhere(array('user_id'=>$f->user_id))[0]->user_name : null;
    $obj->size = $this->formatSizeUnits(filesize($dir.'/'.$f->file_name));
    $obj->ext =  pathinfo($dir.'/'.$f->file_name, PATHINFO_EXTENSION);
    $obj->delete = ($f->owner_id==$this->session->user_id || $this->session->user_level=='admin') ? true : false;
    return $obj;
  }

  function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
  }

}
