<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends MY_Model
{

    public $table = "comments";

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
                'field' => 'text',
                'label' => 'Коментар',
                'rules' => 'required|trim',
            ),
        );

        return $rules;
    }

    public function get_comments(){
        $result = $this->order_by('created_at','desc')->get_all();

        return $result;
    }
}