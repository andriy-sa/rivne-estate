<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AdminEstate extends Admin_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model(array('Estate_model','Category_model','District_model','Rieltor_model','Photo_model'));
        $this->load->library('form_validation');

    }

    public function index(){

        $estates = $this->Estate_model->order_by('created_at','desc')->get_all();

        $success = $this->session->flashdata('success');

        $this->twig->display('admin/estates',array(
            'estates' => $estates,
            'success' => $success,
        ));
    }

    public function insert(){

        $rules = $this->Estate_model->update_rules();
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $data = $this->_generate_data();
            $this->Estate_model->insert($data);
            $this->session->set_flashdata('success', 'Нерухомість успішно додана!');
            redirect('/admin/estates');
        }

        $category  = $this->Category_model->order_by('title','asc')->get_all();
        $districts = $this->District_model->order_by('title','asc')->get_all();
        $rieltors  = $this->Rieltor_model->order_by('name','asc')->get_all();

        $errors = validation_errors('<p>','</p>');

        $this->twig->display('admin/estate_insert',array(
            'category'  => $category,
            'districts' => $districts,
            'rieltors'  => $rieltors,
            'errors'    => $errors,
        ));


    }

    public function update($id){

        $estate = $this->Estate_model->get($id);
        if(!$estate) show_404();

        $rules = $this->Estate_model->update_rules();
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()){
            $data = $this->_generate_data();
            $this->Estate_model->update($data,$id);
            $this->session->set_flashdata('success', 'Нерухомість успішно відредаговано!');
            redirect('/admin/estates');
        }

        $category  = $this->Category_model->order_by('title','asc')->get_all();
        $districts = $this->District_model->order_by('title','asc')->get_all();
        $rieltors  = $this->Rieltor_model->order_by('name','asc')->get_all();

        $errors = validation_errors('<p>','</p>');


        $this->twig->display('admin/estate_update',array(
            'estate' => $estate,
            'errors' => $errors,
            'category'  => $category,
            'districts' => $districts,
            'rieltors'  => $rieltors,
        ));


    }

    public function photo($id){
        $estate = $this->Estate_model->fields('title')->with_photos()->get($id);
        if(!$estate) show_404();

        if($this->input->post('del_image')){
            $del_id = $this->input->post('del_id');
            $del_photo = $this->Photo_model->get($del_id);
            if(!$del_photo) show_404();

            unlink("assets/userfiles/photo/".$del_photo->image);
            $this->Photo_model->delete($del_id);

            $this->session->set_flashdata('success', 'Фото успішно видалено!');
            redirect("/admin/estates/photo/$id");
        }

        /*dump($estate);
        exit();*/

        $config['upload_path']          = './assets/userfiles/tmp/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 10000;
        $config['encrypt_name']         = true;

        $this->load->library('upload', $config);

        $errors = false;
        $success = $this->session->flashdata('success');

        if($this->input->post('new_image')){
            if ($this->upload->do_upload('image'))
            {
                $upload_data = $this->upload->data();

                $config["source_image"] = './assets/userfiles/tmp/'.$upload_data['file_name'];
                $config['new_image'] = './assets/userfiles/photo/'.$upload_data['file_name'];
                $config["width"] = 900;
                $config["height"] = 500;

                $this->load->library('image_lib', $config);
                $this->image_lib->fit();

                unlink("assets/userfiles/tmp/".$upload_data['file_name']);

                $this->Photo_model->insert(array(
                    'image'     => $upload_data['file_name'],
                    'estate_id' => $id,
                ));

                $this->session->set_flashdata('success', 'Фото успішно додано!');
                redirect("/admin/estates/photo/$id");
            }
            $errors = $this->upload->display_errors('<p>','<p/>');
        }

        $this->twig->display('admin/estate_photo',array(
            'estate'  => $estate,
            'errors'  => $errors,
            'success' => $success,
        ));
    }

    public function delete($id)
    {
        $estate = $this->Estate_model->fields('title')->with_photos()->get($id);
        if (!$estate) show_404();

        if($this->input->post('delete')){
            if($estate->photos){
                foreach($estate->photos as $photo){
                    unlink("assets/userfiles/photo/".$photo->image);
                    $this->Photo_model->delete($photo->id);
                }
            }
            $this->Estate_model->delete($id);

            $this->session->set_flashdata('success', 'Нерухомість успішно видалено!');
            redirect("/admin/estates");
        }

        $this->twig->display('admin/estate_delete',array(
            'estate'  => $estate,
        ));
    }

    public function category(){

        if($this->input->post('create')){
            $title = trim($this->input->post('title'));

            if(!$title){
                $this->session->set_flashdata('error', 'Помилка введення категорії!');
                redirect("/admin/estates/category");
            }
            $this->Category_model->insert(array(
               'title' => $title,
            ));

            $this->session->set_flashdata('success', 'Категорія успішно додана!');
            redirect("/admin/estates/category");
        }
        if($this->input->post('delete')){
            $del_id = $this->input->post('del_id',0,0);

            $this->Category_model->delete($del_id);

            $this->session->set_flashdata('success', 'Категорія успішно видалена!');
            redirect("/admin/estates/category");
        }

        $category = $this->Category_model->get_all();

        $success = $this->session->flashdata('success');
        $error   = $this->session->flashdata('error');

        $this->twig->display('admin/category',array(
            'category' => $category,
            'success'  => $success,
            'error'    => $error,
        ));
    }

    public function districts(){
        if($this->input->post('create')){
            $title = trim($this->input->post('title'));

            if(!$title){
                $this->session->set_flashdata('error', 'Помилка введення району!');
                redirect("/admin/estates/districts");
            }
            $this->District_model->insert(array(
                'title' => $title,
            ));

            $this->session->set_flashdata('success', 'Категорія успішно додана!');
            redirect("/admin/estates/districts");
        }
        if($this->input->post('delete')){
            $del_id = $this->input->post('del_id',0,0);

            $this->District_model->delete($del_id);

            $this->session->set_flashdata('success', 'Категорія успішно видалена!');
            redirect("/admin/estates/districts");
        }

        $category = $this->District_model->get_all();

        $success = $this->session->flashdata('success');
        $error   = $this->session->flashdata('error');

        $this->twig->display('admin/districts',array(
            'category' => $category,
            'success'  => $success,
            'error'    => $error,
        ));
    }

    private function _generate_data(){
        $data = array(
            'title'       => $this->input->post('title',0,''),
            'address'     => $this->input->post('address',0,''),
            'price'       => $this->input->post('price',0,0),
            'currency'    => $this->input->post('currency',0,'грн'),
            'description' => $this->input->post('description',0,''),
            'coor'        => $this->input->post('coor',0,''),
            'type'        => $this->input->post('type',0,''),
            'category_id' => $this->input->post('category_id',0,0),
            'district_id' => $this->input->post('district_id',0,0),
            'rieltor_id'  => $this->input->post('rieltor_id',0,0),
            'top'         => $this->input->post('top',0,0),
            'published'   => $this->input->post('published',0,0),
        );

        return $data;
    }

}