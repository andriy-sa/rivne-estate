<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Estate_model','Category_model','Slide_model','District_model','Rieltor_model'));
	}

	public function index()
	{
		$slides = $this->Slide_model->get_last_slides(5);

		$top_estates = $this->Estate_model->get_latest_top();
		//dump($top_estates);

		$this->twig->display('front',array(
			'slides'      => $slides,
			'top_estates' => $top_estates,
		));
	}
}
