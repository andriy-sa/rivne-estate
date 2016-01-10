<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rieltor_model extends MY_Model
{

    public $table = "rieltors";
    public $timestamps = FALSE;

    public function  __construct()
    {
        parent::__construct();
        $this->has_many['estates'] = array('foreign_model' => 'Estate_model', 'foreign_table' => 'estates', 'foreign_key' => 'rieltor_id', 'local_key' => 'id');
    }

    public function update_rules(){
        $rules = array(
            array(
                'field' => 'name',
                'label' => 'ПІП',
                'rules' => 'required|trim',
            ),
            array(
                'field' => 'phone',
                'label' => 'Телефон',
                'rules' => 'required|trim',
            ),
        );

        return $rules;
    }
}