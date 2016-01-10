<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends Admin_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model(array('Rieltor_model','Slide_model'));
        $this->load->library('form_validation');
    }

    public function index(){

        $this->twig->display('admin/front');
    }

    public function rieltors(){

        $rieltors = $this->Rieltor_model->order_by('id','desc')->get_all();
        /*dump($rieltors);
        exit();*/
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
        $this->twig->display('admin/slide_update',array(

        ));
    }

    public function slides_delete($id){
        $this->twig->display('admin/slide_delete',array(

        ));
    }

}