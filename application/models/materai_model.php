<?php

class Materai_model extends CI_Model {

  public function __construct(){
    $this->forum = $this->load->database("forum",TRUE);
    $this->forum->reconnect();
      
		parent::__construct();
  }
  
}
