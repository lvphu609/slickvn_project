<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/models/api_link_enum.php';

class Search extends CI_Controller {
   public function __construct() {
    parent::__construct();
   // $this->load->model('function_modeler');
    
    
  }

  public function index()
  {
    
    
  }
  public function search_meal()
  {
    if(isset($_GET['meal_name'])){
      $meal_name=$_GET['meal_name'];
      $meal_name=  trim($meal_name);
      var_dump($meal_name);
    }
    else {
        $meal_name="";
       }
    
    //var_dump($meal_name);
    
    $this->load->model('restaurantenum');
    $this->load->helper('url');
    api_link_enum::initialize();
    
    $key=$meal_name;
    $link_search_meal = Api_link_enum::$SEARCH_MEAL_URL."?key=".$key."&limit=".Restaurantenum::LIMIT_PAGE_SEARCH_MEAL."&page=1";
    //var_dump($link_search_meal);
    $json_string_search_meal= file_get_contents($link_search_meal); 
    $json_search_meal = json_decode($json_string_search_meal, true);
    $data['result_search_meal']=$json_search_meal["Results"];
    $data['action_search']="meal";
    $data['result_search_favourite']=NULL;
    $data['result_search_restaurant']=NULL;
   //  $data['result_search_favourite']="error";
   // var_dump($data['result_search_meal']);
    
    $this->load->view('search/header/header');
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
    
    $this->load->view('home/menu/menu',$data);
  /*================END_MENU============================================================================*/
    
  /*================LOCATION============================================================================*/
   $this->load->view('search/content/location_page'); 
 /*================END LOCATION============================================================================*/
    $data['link_restaurant_frofile']=  Api_link_enum::$BASE_PROFILE_RESTAURANT_URL;
    $this->load->view('search/content/result_search',$data); 
  
     
    
    
    
   $this->load->view('home/content/footer_content'); 
   $this->load->view('search/footer/footer');
    
  }
  
  public function search_favourite()
  {
    
     if(isset($_GET['favourite_id'])){
       $favourite_id=$_GET['favourite_id'];
    }
    else {
        $favourite_id="";
       }
   
    //var_dump($meal_name);
    
    $this->load->model('restaurantenum');
    $this->load->helper('url');
    Api_link_enum::initialize();
    
    $key=$favourite_id;
    $link_search_favourite = Api_link_enum::$SEARCH_FAVOURITE_URL."?key=".$key."&limit=".Restaurantenum::LIMIT_PAGE_SEARCH_MEAL."&page=1"."&field=favourite_list";
    //$var_dump($link_search_favourite);
    $json_string_search_favourite= file_get_contents($link_search_favourite);    
    $json_search_favourite = json_decode($json_string_search_favourite, true);
    $data['result_search_favourite']=$json_search_favourite["Results"];
    $data['action_search']="favourite";
    $data['result_search_meal']=NULL;
    $data['result_search_restaurant']=NULL;
    //$data['result_search_meal']="error";
    //var_dump($data['result_search_favourite']);
    
    
    $this->load->view('search/header/header');
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
    
    $this->load->view('home/menu/menu',$data);
  /*================END_MENU============================================================================*/
    
  /*================LOCATION============================================================================*/
   $this->load->view('search/content/location_page'); 
 /*================END LOCATION============================================================================*/
   $data['link_restaurant_frofile']=  Api_link_enum::$BASE_PROFILE_RESTAURANT_URL;
   $this->load->view('search/content/result_search',$data); 
  
    
   $this->load->view('home/content/footer_content'); 
   $this->load->view('search/footer/footer');
    
  }
  
  
  public function search_restaurant()
  {
    $input_text_search=$_GET['input_text_search'];
    $input_text_search=  trim($input_text_search);
    $input_text_search=  urlencode($input_text_search);
   // $input_text_search=  str_replace(" ","%20",$input_text_search);
    //var_dump($input_text_search);
    
    $this->load->model('restaurantenum');
    //var_dump($input_text_search);
    $this->load->helper('url');
    Api_link_enum::initialize();
    
    $key=$input_text_search;
    $link_search_restaurant = Api_link_enum::$SEARCH_RESTAURANT_URL."?key=".$key."&limit=".Restaurantenum::LIMIT_PAGE_SEARCH_MEAL."&page=1";
   // var_dump($link_search_restaurant);
   
    
    $json_string_search_restaurant= file_get_contents($link_search_restaurant);
  //  var_dump($json_string_search_restaurant);
    $json_search_restaurant = json_decode($json_string_search_restaurant, true);
   // var_dump($json_search_restaurant);
    $data['result_search_restaurant']=$json_search_restaurant["Results"];
    $data['action_search']="restaurant";
    $data['result_search_meal']=NULL;
    $data['result_search_favourite']=NULL;
    //$data['result_search_meal']="error";
    //var_dump($link_search_restaurant);
    
    
    $this->load->view('search/header/header');
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
    
    $this->load->view('home/menu/menu',$data);
  /*================END_MENU============================================================================*/
    
  /*================LOCATION============================================================================*/
   $this->load->view('search/content/location_page'); 
 /*================END LOCATION============================================================================*/
   $data['link_restaurant_frofile']=  Api_link_enum::$BASE_PROFILE_RESTAURANT_URL;
   $this->load->view('search/content/result_search',$data); 
  
    
   $this->load->view('home/content/footer_content'); 
   $this->load->view('search/footer/footer');
    
  }
  
  
  
  
  
  
}

