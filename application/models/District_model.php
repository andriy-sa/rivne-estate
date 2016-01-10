<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends MY_Model
{

    public $table = "districts";
    public $timestamps = FALSE;

    public function  __construct()
    {
        parent::__construct();
        $this->has_many['estates'] = array('foreign_model' => 'Estate_model', 'foreign_table' => 'estates', 'foreign_key' => 'district_id', 'local_key' => 'id');
    }
}