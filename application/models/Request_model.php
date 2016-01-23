<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends MY_Model
{

    public $table = "requests";

    public function  __construct()
    {
        parent::__construct();
    }

    public function rules(){

        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Імя',
                'rules' => 'required|trim',
            ),
            array(
                'field' => 'message',
                'label' => 'Повідомлення',
                'rules' => 'required|trim',
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim',
            ),
            array(
                'field' => 'phone',
                'label' => 'Телефон',
                'rules' => 'trim',
            ),
        );

        return $rules;
    }

    public function get_last_request(){
        $result = $this->limit(3)->order_by('created_at','desc')->get_all();

        return $result;
    }

    public function get_all_count(){
        $result = $this->count();

        return $result;
    }
}