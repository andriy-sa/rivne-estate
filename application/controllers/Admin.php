<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends Admin_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model(array('Rieltor_model','Slide_model'));
        $this->load->library('form_validation');
    }

    public function index(){
        $this->load->model(['Estate_model','Comment_model','Request_model']);

        $comment_count   = $this->Comment_model->get_all_count();
        $request_count   = $this->Request_model->get_all_count();
        $publish_count   = $this->Estate_model->get_all_count(1);
        $unpublish_count = $this->Estate_model->get_all_count(0);

        $this->twig->display('admin/front',array(
            'comment_count'   => $comment_count,
            'request_count'   => $request_count,
            'publish_count'   => $publish_count,
            'unpublish_count' => $unpublish_count,
        ));
    }

    public function rieltors(){

        $rieltors = $this->Rieltor_model->order_by('id','desc')->get_all();

        $success = $this->session->flashdata('success');

        $this->twig->display('admin/rieltors',array(
            'rieltors' => $rieltors,
            'success'  => $success,
        ));
    }

    public function rieltors_insert(){

        $errors = "";

        $rules = $this->Rieltor_model->update_rules();
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){

            $config['upload_path']          = './assets/userfiles/tmp/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['max_size']             = 10000;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();

                $config["source_image"] = './assets/userfiles/tmp/'.$upload_data['file_name'];
                $config['new_image'] = './assets/userfiles/rieltors/'.$upload_data['file_name'];
                $config["width"] = 100;
                $config["height"] = 100;

                $this->load->library('image_lib', $config);
                $this->image_lib->fit();

                unlink("assets/userfiles/tmp/".$upload_data['file_name']);

                $data = array(
                    'name'  => $this->input->post('name',0,''),
                    'phone' => $this->input->post('phone',0,''),
                    'photo' => $upload_data['file_name'],
                );

                $this->Rieltor_model->insert($data);
                $this->session->set_flashdata('success', 'Ріелтор успішно доданий!');
                redirect('/admin/rieltors');

            }
            $errors = $this->upload->display_errors('<p>','<p/>');
        }

        if(!$errors){
            $errors = validation_errors('<p>','</p>');
        }


        $this->twig->display('admin/rieltor_insert',array(
            'errors' => $errors,
        ));
    }

    public function rieltors_update($id){
        $rieltor = $this->Rieltor_model->get($id);
        if(!$rieltor) show_404();

        $rules = $this->Rieltor_model->update_rules();
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()) {

            $config['upload_path'] = './assets/userfiles/tmp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 10000;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            $data = array(
                'name' => $this->input->post('name', 0, ''),
                'phone' => $this->input->post('phone', 0, ''),
            );

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();

                $config["source_image"] = './assets/userfiles/tmp/' . $upload_data['file_name'];
                $config['new_image'] = './assets/userfiles/rieltors/' . $upload_data['file_name'];
                $config["width"] = 100;
                $config["height"] = 100;

                $this->load->library('image_lib', $config);
                $this->image_lib->fit();

                unlink("assets/userfiles/tmp/" . $upload_data['file_name']);
                unlink("assets/userfiles/rieltors/" . $rieltor->photo);
                $data['photo'] = $upload_data['file_name'];
            }
            $this->Rieltor_model->update($data, $id);
            $this->session->set_flashdata('success', 'Ріелтор успішно обновлений!');
            redirect('/admin/rieltors');
        }

        $errors = validation_errors('<p>','</p>');

        $this->twig->display('admin/rieltor_update',array(
            'errors'  => $errors,
            'rieltor' => $rieltor,
        ));
    }

    public function rieltors_delete($id){
        $rieltor = $this->Rieltor_model->get($id);
        if(!$rieltor) show_404();

        if($this->input->post('delete')){
            unlink("assets/userfiles/rieltors/" . $rieltor->photo);
            $this->Rieltor_model->delete($id);

            $this->session->set_flashdata('success', 'Ріелтор успішно видалений!');
            redirect('/admin/rieltors');
        }

        $this->twig->display('admin/rieltor_delete',array(
            'rieltor' => $rieltor,
        ));
    }

    public function slides(){

        $slides = $this->Slide_model->order_by('id','desc')->get_all();
        $success = $this->session->flashdata('success');

        $this->twig->display('admin/slides',array(
            'slides'   => $slides,
            'success'  => $success,
        ));
    }

    public function slides_insert(){
        $errors = "";

        $rules = $this->Slide_model->update_rules();
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()){

            $config['upload_path']          = './assets/userfiles/slides/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['max_size']             = 10000;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();

                $data = array(
                    'title'    => $this->input->post('title',0,''),
                    'subtitle' => $this->input->post('subtitle',0,''),
                    'image'    => $upload_data['file_name'],
                );

                $this->Slide_model->insert($data);
                $this->session->set_flashdata('success', 'Слайд успішно доданий!');
                redirect('/admin/slides');

            }
            $errors = $this->upload->display_errors('<p>','<p/>');
        }

        if(!$errors){
            $errors = validation_errors('<p>','</p>');
        }


        $this->twig->display('admin/slide_insert',array(
            'errors' => $errors,
        ));
    }

    public function slides_update($id){
        $slide = $this->Slide_model->get($id);
        if(!$slide) show_404();

        $rules = $this->Slide_model->update_rules();
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()){

            $data = array(
                'title'    => $this->input->post('title',0,''),
                'subtitle' => $this->input->post('subtitle',0,''),
            );

            $config['upload_path']          = './assets/userfiles/slides/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['max_size']             = 10000;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
                unlink("assets/userfiles/slides/".$slide->image);
            }
            $this->Slide_model->update($data,$id);
            $this->session->set_flashdata('success', 'Слайд успішно відредаговано!');
            redirect('/admin/slides');
        }

        $errors = validation_errors('<p>','</p>');

        $this->twig->display('admin/slide_update',array(
            "slide"  => $slide,
            'errors' => $errors,
        ));
    }

    public function slides_delete($id){

        $slide = $this->Slide_model->get($id);
        if(!$slide) show_404();

        if($this->input->post('delete')){
            unlink("assets/userfiles/slides/" . $slide->image);
            $this->Slide_model->delete($id);

            $this->session->set_flashdata('success', 'Слайд успішно видалений!');
            redirect('/admin/slides');
        }

        $this->twig->display('admin/slide_delete',array(
            'slide' => $slide,
        ));
    }

    public function requests(){

        $requests = $this->Request_model->order_by('created_at','desc')->get_all();
        $success = $this->session->flashdata('success');

        $this->twig->display('admin/requests',array(
            'requests' => $requests,
            'success'  => $success,
        ));
    }

    public function requests_detail($id){
        $request = $this->Request_model->get($id);
        if(!$request) show_404();

        if($this->input->post()){
            $this->Request_model->delete($id);
            $this->session->set_flashdata('success','Повідомлення успішно видалено!');
            redirect('/admin/requests');
        }

        $this->twig->display('admin/request_detail',array(
            'request' => $request,
        ));
    }

    public function comments(){
        $this->load->model('Comment_model');
        $comments = $this->Comment_model->order_by('created_at','desc')->get_all();
        $success = $this->session->flashdata('success');

        $this->twig->display('admin/comments',array(
            'comments'  => $comments,
            'success'   => $success,
        ));
    }

    public function comments_detail($id){
        $this->load->model('Comment_model');
        $comment = $this->Comment_model->get($id);
        if(!$comment) show_404();

        if($this->input->post()){
            $this->Comment_model->delete($id);
            $this->session->set_flashdata('success','Коментар успішно видалено!');
            redirect('/admin/comments');
        }

        $this->twig->display('admin/comments_detail',array(
            'comment' => $comment,
        ));
    }
}