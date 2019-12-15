<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_file extends CI_Model{

  private $table = 'table_file';
  private $base = 'file';
  private $id = 'file_id';

  public function get(){
    $query = $this->db->get($this->table);
    return $query->result();
  }
  public function getWhere($data){
    $query = $this->db->where($data)->get($this->table);
    return $query->result();
  }

  public function get_current($limit, $start){
    $this->db->limit($limit, $start);
    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0){
        return $query->result();
    }
    return false;
  }
  public function get_total(){
    $this->db->get($this->table);
    return $this->db->count_all_results();
  }

  public function add($data){
    $this->db->insert($this->table,$data);
    return ($this->db->affected_rows() != 1) ? false : true;
  }
  
  public function update($id, $data){
    //run Query to update data
    unset($data[$this->id]);
    $query = $this->db->where($this->id, $id)->update(
      $this->table, $data
    );

    return ($this->db->affected_rows() != 1) ? false : true;

  }

  public function delete($data){
    $this->db->delete($this->table, $data);
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  public function search($key=null, $limit=null, $start=null, $name=null){
      foreach ($name as $k => $value) {
      if ($k==0) {
        $this->db->like($value, $key);
      }else {
        $this->db->or_like($value, $key);
      }
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get($this->table);
    if($query->num_rows() > 0) {
      foreach($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return null;
  }

  public function search_count($key=null, $name=null){
      foreach ($name as $k => $value) {
      if ($k==0) {
        $this->db->like($value, $key);
      }else {
        $this->db->or_like($value, $key);
      }
    }
    $this->db->from($this->table);
    // $this->db->limit($limit, $start);
    $query = $this->db->count_all_results();
    return $query;

  }
  public function last(){
    return $this->db->count_all($this->table);;
  }



}

?>
