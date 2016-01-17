<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Estate extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('Estate_model','Category_model','Slide_model','District_model','Rieltor_model'));
    }

    public function index()
    {
       $category  = $this->Category_model->get_all();
       $districts = $this->District_model->get_all();


       $get_cat = $this->input->get('cat');
       $get_cat_arr = [];
       if($get_cat && is_array($get_cat)){
           foreach($get_cat as $item){
               $get_cat_arr[] = $item;
           }
       }
       $get_dis = $this->input->get('dis');
       $get_dis_arr = [];
       if($get_dis && is_array($get_dis)){
           foreach($get_dis as $item){
               $get_dis_arr[] = $item;
           }
       }
       $type = $this->input->get('type');

       $get_query = '';
       foreach($this->input->get() as $key => $val){
           if($key !='page' && $val){
               if(is_array($val)){
                 foreach($val as $v){
                     $get_query.=$key.'='.$v.'&';
                 }
               } else {
                   $get_query.=$key.'='.$val.'&';
               }
           }
       }

       $this->Estate_model->pagination_delimiters = array('<li>','</li>');
       $total_estates = $this->Estate_model->get_filtered_estates($get_cat_arr,$get_dis_arr,$type)->count();

       $page = $this->input->get('page');
       if(!$page) $page = 1;
       $estates = $this->Estate_model
           ->get_filtered_estates($get_cat_arr,$get_dis_arr,$type)
           ->paginate(10,$total_estates,$page,$get_query);

       $pagination = $this->Estate_model->all_pages;

       $this->twig->display('estate_filter',array(
            'category'      => $category,
            'districts'     => $districts,
            'get_cat_arr'   => $get_cat_arr,
            'get_dis_arr'   => $get_dis_arr,
            'type'          => $type,
            'estates'       => $estates,
            'total_estates' => $total_estates,
            'pagination'    => $pagination,
       ));
    }

    public function estate($id){

        $estate = $this->Estate_model->get_estate($id);

        //dump($estate);
        $this->twig->display('estate',array(
            'estate' => $estate,
        ));
    }

    public function rieltors(){
        $this->twig->display('rieltors',array(

        ));
    }
}