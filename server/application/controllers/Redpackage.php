<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redpackage extends CI_Controller {
    public function index() {
//        $this->load->library("driver");
//        $this->driver->__set("1","word");
//        var_dump($this->driver->__get("1"));
        $query = $this->db->select()
            ->get("cUserinfo");
        $this->json([
            'code' => 0,
            'data' => $query->result_array()
        ]);
    }
    public function test(){
        $this->load->library("test");
        $s = $this->test->getTest();
        echo $s;exit;
    }
}
