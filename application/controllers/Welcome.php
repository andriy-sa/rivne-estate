<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'Estate_model',
			'Category_model',
			'Slide_model',
			'District_model',
			'Rieltor_model',
			'Comment_model',
			'Request_model'
		));
	}

	public function index()
	{
		$slides = $this->Slide_model->get_last_slides(5);

		$top_estates = $this->Estate_model->get_latest_top();

		$this->twig->display('front',array(
			'slides'      => $slides,
			'top_estates' => $top_estates,
		));
	}

	public function comments(){

		$latest     = $this->Estate_model->get_latest();
		$comments = $this->Comment_model->get_comments();

		$this->load->library('form_validation');

		$rules = $this->Comment_model->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()){
			$data = array(
				'name'       => $this->input->post('name'),
				'text'       => $this->input->post('text'),
				'created_at' => date('Y-m-d G:i:s'),
			);
			$this->Comment_model->insert($data);
			$this->session->set_flashdata('success', 'Відгук успішно додано!');
			redirect('/comments');
		}
		$errors  = validation_errors('<p>','</p>');
		$success = $this->session->flashdata('success');

		$this->twig->display('comments',array(
			'latest'       => $latest,
			'latest_title' => 'Новинки нерухомості',
			'comments'     => $comments,
			'errors'       => $errors,
			'success'      => $success,
		));
	}

	public function contacts(){

		$this->load->library('form_validation');
		$rules = $this->Request_model->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()){
			$data = array(
				'name'    => $this->input->post('name'),
				'phone'   => $this->input->post('phone'),
				'email'   => $this->input->post('email'),
				'message' => $this->input->post('message')
			);
			$this->Request_model->insert($data);
			$this->session->set_flashdata('success','Повідомлення успішно відправлено!');
			redirect('/contacts');
		}

		$latest     = $this->Estate_model->get_latest_top();
		$errors  = validation_errors('<p>','</p>');
		$success = $this->session->flashdata('success');

		$this->twig->display('contacts',array(
			'latest'       => $latest,
			'latest_title' => 'Топ нерухомість',
			'errors'       => $errors,
			'success'      => $success,
		));
	}
}
