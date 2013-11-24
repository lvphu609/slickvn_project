<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include model/API_Link_Enum
require APPPATH.'/models/api_link_enum.php';

class Admin_controller extends CI_Controller {
   public function __construct() {
    parent::__construct();
   // $this->load->model('function_modeler');
    $this->load->model('restaurantenum');
    $this->load->helper('url');
     Api_link_enum::initialize();
    
    
  }
/*========================TRANG CHINH=================================================================*/
  public function index()
  {

    $data['chosed']="main_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    $this->load->view('admin/content/main_page/main_page');
    $this->load->view('admin/footer/footer_main');
    
  }
  
/*========================TRANG THÀNH VIÊN=================================================================*/  
  public function member_page()
  {

    $data['chosed']="member_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    $this->load->view('admin/content/member_page/member_page');
    $this->load->view('admin/footer/footer_main');
    
  }
    //trang thêm thành viên mới
 public function create_new_member()
  {
   
    $data['chosed']="member_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    $this->load->view('admin/content/member_page/create_new_member');
    $this->load->view('admin/footer/footer_main');
    
  }  
  
   //thêm thành viên thành công
  public function create_new_member_success()
  {
   
    $data['chosed']="member_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    $this->load->view('admin/content/member_page/create_new_member_success');
    $this->load->view('admin/footer/footer_main');
    
  } 
  
  
  
/*========================TRANG NGƯỜI DÙNG=================================================================*/  
  public function user_page()
  {

    $data['chosed']="user_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    //$this->load->view('admin/content/main_page/member_page');
    $this->load->view('admin/footer/footer_main');
    
  }
  
/*========================TRANG NHÀ HÀNG=================================================================*/  
  public function restaurant_page()
  {
    //danh sách tất cả các nhà hàng
     $link_all_restaurant = Api_link_enum::$ALL_RESTAURANT_URL."?limit=".Restaurantenum::LIMIT_PAGE_RESTAURANT_ALL."&page=1";
     $json_string_all_restaurant= file_get_contents($link_all_restaurant);    
     $json_all_restaurant = json_decode($json_string_all_restaurant, true);
     $data['all_restaurant']=$json_all_restaurant["Results"];
     //var_dump( $data['all_restaurant']);
    
    $data['chosed']="restaurant_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    
    $this->load->view('admin/content/restaurant_page/restaurant_page');
    $this->load->view('admin/footer/footer_main');
    
  }  
  
    //trang thêm nhà hàng mới
 public function create_new_restaurant()
  {
    //link image upload temp
     $data['BASE_IMAGE_UPLOAD_TEMP_URL']=  Api_link_enum::$BASE_IMAGE_UPLOAD_TEMP_URL;
   //call php upload image temp
     $data['BASE_CALL_UPLOAD_IMAGE_TEMP_URL']=  Api_link_enum::$BASE_CALL_UPLOAD_IMAGE_TEMP_URL;
   
   //danh sách phong cách ẩm thực
     $link_culinary_style = Api_link_enum::$CULINARY_STYLE_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_CULINARY_STYLE;
     $json_string_culinary_style = file_get_contents($link_culinary_style);    
     $json_culinary_style = json_decode($json_string_culinary_style, true);
     $data['culinary_style']=$json_culinary_style["Results"];
   //phương thức sử dụng
     $link_mode_use_list = Api_link_enum::$MODE_USE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_MODE_USE;
     $json_string_mode_use_list = file_get_contents($link_mode_use_list);    
     $json_mode_use_list = json_decode($json_string_mode_use_list, true);
     $data['mode_use_list']=$json_mode_use_list["Results"];
   //nhu cầu
     $link_favourite_list = Api_link_enum::$FAVOURITE_TYPE_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_FAVOURITE;
     $json_string_favourite_list = file_get_contents($link_favourite_list);    
     $json_favourite_list = json_decode($json_string_favourite_list, true);
     $data['favourite_list']=$json_favourite_list["Results"];
    //hình thức thanh toán
     $link_payment_type_list = Api_link_enum::$PAYMENT_TYPE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_PAYMENT;
     $json_string_payment_type_list = file_get_contents($link_payment_type_list);    
     $json_payment_type_list = json_decode($json_string_payment_type_list, true);
     $data['payment_type_list']=$json_payment_type_list["Results"];
    //ngoại cảnh
     $link_landscape_list = Api_link_enum::$LANDSCAPE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_LANDSCAPE;
     $json_string_landscape_list = file_get_contents($link_landscape_list);    
     $json_landscape_list = json_decode($json_string_landscape_list, true);
     $data['landscape_list']=$json_landscape_list["Results"];
    //giá trung bình người
     $link_price_person_list = Api_link_enum::$PRICE_PERSON_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_PRICE_PERSION;
     $json_string_price_person_list = file_get_contents($link_price_person_list);    
     $json_price_person_list = json_decode($json_string_price_person_list, true);
     $data['price_person_list']=$json_price_person_list["Results"];
    //các tiêu chí khác
     $link_other_criteria_list = Api_link_enum::$OTHER_CRITERIA_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_OTHER_CRITERIA;
     $json_string_other_criteria_list = file_get_contents($link_other_criteria_list);    
     $json_other_criteria_list = json_decode($json_string_other_criteria_list, true);
     $data['other_criteria_list']=$json_other_criteria_list["Results"];
     
     
      $data['chosed']="restaurant_page";
      $this->load->helper('url');
      $this->load->view('admin/header/header_main',$data);
      $this->load->view('admin/taskbar_top/taskbar_top');
      $this->load->view('admin/menu/menu_main',$data);
    
    
    
    
    
    
    $this->load->view('admin/content/restaurant_page/create_new_restaurant',$data);
    
    $this->load->view('admin/footer/footer_main');
    
  }  
  //sửa nhà hàng
  public function edit_restaurant_page()
  {
     //link image upload temp
     $data['BASE_IMAGE_UPLOAD_TEMP_URL']=  Api_link_enum::$BASE_IMAGE_UPLOAD_TEMP_URL;
   //call php upload image temp
     $data['BASE_CALL_UPLOAD_IMAGE_TEMP_URL']=  Api_link_enum::$BASE_CALL_UPLOAD_IMAGE_TEMP_URL;
   
   //danh sách phong cách ẩm thực
     $link_culinary_style = Api_link_enum::$CULINARY_STYLE_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_CULINARY_STYLE;
     $json_string_culinary_style = file_get_contents($link_culinary_style);    
     $json_culinary_style = json_decode($json_string_culinary_style, true);
     $data['culinary_style']=$json_culinary_style["Results"];
   //phương thức sử dụng
     $link_mode_use_list = Api_link_enum::$MODE_USE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_MODE_USE;
     $json_string_mode_use_list = file_get_contents($link_mode_use_list);    
     $json_mode_use_list = json_decode($json_string_mode_use_list, true);
     $data['mode_use_list']=$json_mode_use_list["Results"];
   //nhu cầu
     $link_favourite_list = Api_link_enum::$FAVOURITE_TYPE_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_FAVOURITE;
     $json_string_favourite_list = file_get_contents($link_favourite_list);    
     $json_favourite_list = json_decode($json_string_favourite_list, true);
     $data['favourite_list']=$json_favourite_list["Results"];
    //hình thức thanh toán
     $link_payment_type_list = Api_link_enum::$PAYMENT_TYPE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_PAYMENT;
     $json_string_payment_type_list = file_get_contents($link_payment_type_list);    
     $json_payment_type_list = json_decode($json_string_payment_type_list, true);
     $data['payment_type_list']=$json_payment_type_list["Results"];
    //ngoại cảnh
     $link_landscape_list = Api_link_enum::$LANDSCAPE_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_LANDSCAPE;
     $json_string_landscape_list = file_get_contents($link_landscape_list);    
     $json_landscape_list = json_decode($json_string_landscape_list, true);
     $data['landscape_list']=$json_landscape_list["Results"];
    //giá trung bình người
     $link_price_person_list = Api_link_enum::$PRICE_PERSON_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_PRICE_PERSION;
     $json_string_price_person_list = file_get_contents($link_price_person_list);    
     $json_price_person_list = json_decode($json_string_price_person_list, true);
     $data['price_person_list']=$json_price_person_list["Results"];
    //các tiêu chí khác
     $link_other_criteria_list = Api_link_enum::$OTHER_CRITERIA_LIST_URL.Api_link_enum::COLLECTION_NAME.Api_link_enum::COLLECTION_OTHER_CRITERIA;
     $json_string_other_criteria_list = file_get_contents($link_other_criteria_list);    
     $json_other_criteria_list = json_decode($json_string_other_criteria_list, true);
     $data['other_criteria_list']=$json_other_criteria_list["Results"];
     
     
     
     
    
      $data['chosed']="restaurant_page";
      $this->load->helper('url');
      $this->load->view('admin/header/header_main',$data);
      $this->load->view('admin/taskbar_top/taskbar_top');
      $this->load->view('admin/menu/menu_main',$data);

      $this->load->view('admin/content/restaurant_page/edit_restaurant_page');
      $this->load->view('admin/footer/footer_main');
    
  }  
  
/*========================TRANG KHUYẾN MÃI=================================================================*/  
  public function coupon_page()
  {

    $data['chosed']="coupon_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    //$this->load->view('admin/content/main_page/member_page');
    $this->load->view('admin/footer/footer_main');
    
  }  
/*========================TRANG BÀI VIẾT=================================================================*/  
  public function post_page()
  {

    $data['chosed']="post_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    //$this->load->view('admin/content/main_page/member_page');
    $this->load->view('admin/footer/footer_main');
    
  } 
/*========================TRANG TÙY CHỈNH=================================================================*/  
  public function custom_page()
  {

    $data['chosed']="custom_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    //$this->load->view('admin/content/main_page/member_page');
    $this->load->view('admin/footer/footer_main');
    
  } 
  
}