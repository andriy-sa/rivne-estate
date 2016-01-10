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

		$estates = $this->Estate_model->where('published',1)
			                            ->order_by('id','desc')
										->with_photos()
										->with_category()
										->with_district()
										->with_rieltor()
										->get(1);


		$this->twig->display('front',array(
			'slides' => $slides,
		));
	}
}
