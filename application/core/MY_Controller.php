<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {

    public function __construct(){

        parent::__construct();

        $activeUri = $this->uri->segment(1);
        $this->twig->addGlobal('activeUri',$activeUri);

        $menuItems = array(
            ''         => 'Головна',
            'estate'   => 'Нерухомість',
            'rieltors' => 'Ріелтори',
            'comments' => 'Відгуки',
            'contacts' => 'Зворотній звязок'
        );
        $this->twig->addGlobal('menuItems',$menuItems);
    }

}

class Admin_Controller extends CI_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->model('Request_model');
        $last_requests = $this->Request_model->get_last_request();
        $this->twig->addGlobal('last_requests',$last_requests);

        if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
            redirect('/');
        }
    }

}
