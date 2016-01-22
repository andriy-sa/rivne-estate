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
       if($get_cat){
           if(is_array($get_cat)){
               foreach($get_cat as $item){
                   $get_cat_arr[] = $item;
               }
           }
           else if(is_numeric($get_cat)){
               $get_cat_arr[] = $get_cat;
           }
       }
       $get_dis = $this->input->get('dis');
       $get_dis_arr = [];
       if($get_dis){
           if(is_array($get_dis)){
               foreach($get_dis as $item){
                   $get_dis_arr[] = $item;
               }
           } else if(is_numeric($get_dis)){
               $get_dis_arr[] = $get_dis;
           }
       }
       $type = $this->input->get('type');

       $get_query = '';
       foreach($this->input->get() as $key => $val){
           if($key !='page' && $val){
               if(is_array($val)){
                 foreach($val as $v){
                     $get_query.=$key.'%5B%5D='.$v.'&';
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
           ->paginate(10,$total_estates,$page,"estate?".$get_query);

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
        $latest     = $this->Estate_model->get_latest();

        $rieltors = $this->Rieltor_model->order_by('id','desc')->get_all();

        //dump($rieltors);

        $this->twig->display('rieltors',array(
            'latest'       => $latest,
            'latest_title' => 'Новинки нерухомості',
            'rieltors'     => $rieltors,
        ));
    }

    public function rieltor_estate($id) {
        $rieltor = $this->Rieltor_model->get($id);
        if(!$rieltor) show_404();

        $latest     = $this->Estate_model->get_latest_top();

        $page = $this->input->get('page');
        if(!$page) $page = 1;
        $query = "/".$id.'?';

        $total_estates    = $this->Estate_model->get_by_rieltor($id)->count();
        $estates          = $this->Estate_model->get_by_rieltor($id)->paginate(10,$total_estates,$page,$query);

        $pagination = $this->Estate_model->all_pages;

        $this->twig->display('rieltor_estate',array(
            'latest'        => $latest,
            'latest_title'  => 'Топ нерухомість',
            'rieltor'       => $rieltor,
            'total_estates' => $total_estates,
            'estates'       => $estates,
            'pagination'    => $pagination,
        ));
    }
}