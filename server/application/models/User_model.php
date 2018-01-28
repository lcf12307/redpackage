<?php
/**
 * Created by PhpStorm.
 * User: lcf12307
 * Date: 2018/1/25
 * Time: 22:24
 */


class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public  function storeUserInfo ($userinfo) {
        $open_id = $userinfo->openId;
        $param = [
            'open_id' => $userinfo->openId,
            'nickName' => $userinfo->nickName,
            'gender' => $userinfo->gender,
            'language' => $userinfo->language,
            'city' => $userinfo->city,
            'province' => $userinfo->province,
            'country' => $userinfo->country,
            'avatarUrl' => $userinfo->avatarUrl,

        ];
        $query = $this->db->select()
            ->from("cUserinfo")
            ->where("open_id",$open_id)
            ->get();
        $res = $query->result_array();
        if (empty($res)) {
            $this->db->insert('cUserinfo', $param);
        }
    }

    public  function findUserBySKey ($skey) {
        $query = $this->db->select()
            ->from("cUserinfo")
            ->where("skey",$skey)
            ->get();
        $res = $query->result_array();
        return $res;
    }
}