<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_model extends MY_Model
{

    public $table = "slides";
    public $timestamps = FALSE;

    public function  __construct()
    {
        parent::__construct();
    }

    public function update_rules(){
        $rules = array(
            array(
                'field' => 'title',
                'label' => 'Заголовок',
                'rules' => 'required|trim',
            ),
        );

        return $rules;
    }

    public function get_last_slides($limit){
        $result = $this->limit($limit)->order_by('id','desc')->get_all();

        return $result;
    }


}