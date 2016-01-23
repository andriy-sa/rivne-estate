<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estate_model extends MY_Model {

    public $table = "estates";

    public function  __construct(){
        parent::__construct();
        $this->has_many['photos']  = array('foreign_model'=>'Photo_model','foreign_table'=>'photos','foreign_key'=>'estate_id','local_key'=>'id');
        $this->has_one['category'] = array('foreign_model'=>'Category_model','foreign_table'=>'category','foreign_key'=>'id','local_key'=>'category_id');
        $this->has_one['district'] = array('foreign_model'=>'District_model','foreign_table'=>'districts','foreign_key'=>'id','local_key'=>'district_id');
        $this->has_one['rieltor'] = array('foreign_model'=>'Rieltor_model','foreign_table'=>'rieltors','foreign_key'=>'id','local_key'=>'rieltor_id');
    }

    public function update_rules(){

        $rules = array(
          array(
              'field' => 'title',
              'label' => 'Назва',
              'rules' => 'required|trim',
          ),
          array(
              'field' => 'address',
              'label' => 'Адреса',
              'rules' => 'required|trim',
          ),
            array(
                'field' => 'price',
                'label' => 'Ціна',
                'rules' => 'required|integer|trim',
            ),
            array(
                'field' => 'currency',
                'label' => 'Валюта',
                'rules' => 'required|trim',
            ),
            array(
                'field' => 'type',
                'label' => 'Операція',
                'rules' => 'required|trim',
            ),
            array(
                'field' => 'category_id',
                'label' => 'Категорія',
                'rules' => 'required|integer|trim',
            ),
            array(
                'field' => 'district_id',
                'label' => 'Район',
                'rules' => 'required|integer|trim',
            ),
            array(
                'field' => 'rieltor_id',
                'label' => 'Ріелтор',
                'rules' => 'required|integer|trim',
            ),
        );

        return $rules;
    }

    public function get_latest_top(){
        $result = $this->where('published',1)
            ->where('top',1)
            ->order_by('created_at','desc')
            ->limit(5)
            ->with_photos()
            ->with_category()
            ->with_district()
            ->with_rieltor()
            ->get_all();

        return $result;
    }

    public function get_latest(){
        $result = $this->where('published',1)
            ->order_by('created_at','desc')
            ->limit(5)
            ->with_photos()
            ->with_category()
            ->with_district()
            ->with_rieltor()
            ->get_all();

        return $result;
    }

    public function get_estate($id) {
        $result = $this->where('published',1)
            ->with_photos()
            ->with_category()
            ->with_district()
            ->with_rieltor()
            ->get($id);

        return $result;
    }

    public function get_filtered_estates($category,$districts,$type){
        $result = $this->where('published',1)
            ->order_by('created_at','desc')
            ->with_photos()
            ->with_category()
            ->with_district()
            ->with_rieltor();

        if($category){
            $result = $this->where("category_id",$category);
        }
        if($districts){
            $result = $this->where("district_id",$districts);
        }
        if($type){
            $result = $this->where("type",$type);
        }

        return $result;
    }

    public function get_by_rieltor($id){
        $result = $this->where('published',1)
            ->where('rieltor_id',$id)
            ->order_by('created_at','desc')
            ->with_photos()
            ->with_category()
            ->with_district()
            ->with_rieltor();

        return $result;
    }

    public function get_all_count($publish = 1){
        $result = $this->where('published',$publish)->count();

        return $result;
    }
}