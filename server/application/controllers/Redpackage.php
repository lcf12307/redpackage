<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Redpackage extends CI_Controller {
    public function index() {
        $open_id = $_GET['open_id'];
        $redis = new Redis();
        $redis->connect('123.207.236.246', 6379);
        $redis->set('name','zhou', 10);
        $key_1 = $redis->get('name');

        echo $key_1;
    }
    public  function phpinfo(){
    }
}
