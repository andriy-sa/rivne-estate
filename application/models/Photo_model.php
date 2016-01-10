<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo_model extends MY_Model {

    public $table = 'photos';
    public $timestamps = false;

    public function __construct(){

        parent::__construct();
    }



}