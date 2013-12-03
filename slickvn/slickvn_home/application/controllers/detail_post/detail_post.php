<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include model/Api_link_enum
require APPPATH.'/models/api_link_enum.php';

class Detail_post extends CI_Controller {
   public function __construct() {
    parent::__construct();
   // $this->load->model('function_modeler');
    
    
  }

  public function index()
  {
    
    $this->load->model('restaurantenum');
    $this->load->helper('url');
    $this->load->view('detail_post/header/header');
    api_link_enum::initialize();
      
    //nếu tồn tại id nhà hàng
   if(isset($_GET['id_post'])){
    if($_GET['id_post']!=NULL){  //nếu id khác null
    $id_post=$_GET['id_post'];
    $link_detail_post = Api_link_enum::$DETAIL_POST_URL."?id=$id_post";
  //  var_dump($link_detail_post);
    $json_string_detail_post= file_get_contents($link_detail_post);    
    $json_detail_post = json_decode($json_string_detail_post, true);
    $data['info_post']=$json_detail_post["Results"];
    //var_dump($data['info_post']);
      if($data['info_post']!=NULL){//nếu dữ liệu lấy về không NULL
              /*===============MENU==========================================================================*/
                $link_meal_list = Api_link_enum::$MEAL_TYPE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_MEAL_TYPE;
                $json_string_meal_list = file_get_contents($link_meal_list);    
                $json_meal_list = json_decode($json_string_meal_list, true);

                $link_favourite_list = Api_link_enum::$FAVOURITE_TYPE_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_FAVOURITE;
                $json_string_favourite_list = file_get_contents($link_favourite_list);    
                $json_favourite_list = json_decode($json_string_favourite_list, true);


                $data['meal_list']=$json_meal_list["Results"];
                //var_dump($json_meal_list["Results"]);
                $data['favourite_list']=$json_favourite_list["Results"];    
                //var_dump($data['favourite_list']);
                $this->load->view('home/menu/menu',$data);
             /*================END_MENU============================================================================*/       
             /*==================LOCATION_PAGE======================================================================================*/

                 $this->load->view('detail_post/content/location_page',$data);
             /*=================END_LOCATION_PAGE=======================================================================================*/ 
             /*==================DETAIL POST======================================================================================*/

                 $this->load->view('detail_post/content/detail_post',$data);
             /*=================END DETAIL POST=======================================================================================*/ 
                      
                 
                 
                  $this->load->view('home/content/footer_content'); 
                  $this->load->view('detail_post/footer/footer');
              }
            else{}
          }
        else{}
       }
    else{}
    
  }
}
