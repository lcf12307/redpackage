<?php
/**
 * Created by PhpStorm.
 * User: lcf12307
 * Date: 2018/1/25
 * Time: 22:24
 */

use QCloud_WeApp_SDK\Mysql\Mysql as DB;
use QCloud_WeApp_SDK\Constants;
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public static function storeUserInfo ($userinfo) {
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
        $res = DB::row('cUserinfo', ['*'], compact('open_id'));
        if ($res === NULL) {
            try {
                DB::insert('cUserinfo', $param);
            } catch (\Exception $e){

            }
        }
    }

    public static function findUserBySKey ($skey) {
        return DB::row('cUserinfo', ['*'], compact('skey'));
    }
}