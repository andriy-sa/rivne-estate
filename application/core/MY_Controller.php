<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {

    public function __construct(){

        parent::__construct();

    }

}

class Admin_Controller extends CI_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->library('ion_auth');

        if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
            redirect('/');
        }
    }

}
