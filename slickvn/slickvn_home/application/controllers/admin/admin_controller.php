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
    
     //danh sách tất cả các thành viên
     $link_all_user = Api_link_enum::$ALL_USER_URL."?limit=".Restaurantenum::LIMIT_PAGE_USER_ALL."&page=1";
    // var_dump($link_all_user);
     $json_string_all_user= file_get_contents($link_all_user);    
     $json_all_user = json_decode($json_string_all_user, true);
     $data['all_user']=$json_all_user["Results"];
     //var_dump( $data['all_user']);
    
    $this->load->view('admin/content/member_page/member_page',$data);
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
    
    
    //link image upload temp
     $data['BASE_IMAGE_UPLOAD_TEMP_URL']=  Api_link_enum::$BASE_IMAGE_UPLOAD_TEMP_URL;
   //call php upload image temp
     $data['BASE_CALL_UPLOAD_IMAGE_TEMP_URL']=  Api_link_enum::$BASE_CALL_UPLOAD_IMAGE_TEMP_URL;
    
     
     
     //danh sách tất cả các role
     $link_all_role = Api_link_enum::$ALL_ROLE_URL;
     $json_string_all_role= file_get_contents($link_all_role);    
     $json_all_role = json_decode($json_string_all_role, true);
     $data['all_role']=$json_all_role["Results"];
     //var_dump( $data['all_role']);
     
     $this->load->view('admin/content/member_page/create_new_member',$data);
     $this->load->view('admin/footer/footer_main');
    
  }  
  
   //thêm thành viên
  public function create_new_member_post()
  {
   
    //echo "hello add";
    $avatar        =$_POST['avatar'];
    $full_name     =$_POST['full_name'];
    $address       =$_POST['address'];
    $email         =$_POST['email'];
    $phone_number  =$_POST['phone_number'];
    $introduce     =$_POST['introduce'];
    $password      =$_POST['password'];
    $password=  md5($password);
    $role_list=$_POST['role'];
    $role_list=  trim($role_list);
    
   // echo $password;
    
    //add new member
    $action="insert";
    $url=Api_link_enum::$ADD_USER_URL;
    echo $url;
    $myvars = 'avatar=' . $avatar . 
              '&full_name=' . $full_name.
              '&address=' . $address.
              '&email=' . $email.
              '&phone_number=' . $phone_number.
              '&desc=' . $introduce.
              '&password=' . $password.
              '&role_list=' . $role_list.
              '&action=' . $action;
    
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec( $ch );
    
    
    
    
    
  } 
  //edit member
  public function edit_member_post()
  {
   
    //echo "hello add";
    $avatar        =$_POST['avatar'];
    $full_name     =$_POST['full_name'];
    $address       =$_POST['address'];
    $email         =$_POST['email'];
    $phone_number  =$_POST['phone_number'];
    $introduce     =$_POST['introduce'];
    $password      =$_POST['password'];
    $password=  md5($password);
    $role_list=$_POST['role'];
    $role_list=  trim($role_list);
    $id= $_POST['id'];
   // echo $password;
    
    //add new member
    $action="edit";
    $url=Api_link_enum::$EDIT_USER_URL;
    echo $url;
    $myvars = 'avatar=' . $avatar . 
              '&full_name=' . $full_name.
              '&address=' . $address.
              '&email=' . $email.
              '&phone_number=' . $phone_number.
              '&desc=' . $introduce.
              '&password=' . $password.
              '&role_list=' . $role_list.
              '&id='.$id.
              '&action=' . $action;
    
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec( $ch );
    
    
  } 
   public function view_edit_user()
  {
   
    $data['chosed']="member_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    $id=$_GET['param_id'];
    //chi tiết 1 thành viên
     $link_detail_user = Api_link_enum::$DETAIL_USER_URL."?id=".$id;
    // var_dump($link_detail_user);
     $json_string_detail_user= file_get_contents($link_detail_user);    
     $json_detail_user = json_decode($json_string_detail_user, true);
     $data['detail_user']=$json_detail_user["Results"];
     //var_dump( $data['detail_user']);
    
    //link image upload temp
     $data['BASE_IMAGE_UPLOAD_TEMP_URL']=  Api_link_enum::$BASE_IMAGE_UPLOAD_TEMP_URL;
   //call php upload image temp
     $data['BASE_CALL_UPLOAD_IMAGE_TEMP_URL']=  Api_link_enum::$BASE_CALL_UPLOAD_IMAGE_TEMP_URL; 
     
    $data['BASE_IMAGE_USER_PROFILE_URL']=Api_link_enum::$BASE_IMAGE_USER_PROFILE_URL;
    
    
     //danh sách tất cả các role
     $link_all_role = Api_link_enum::$ALL_ROLE_URL;
     $json_string_all_role= file_get_contents($link_all_role);    
     $json_all_role = json_decode($json_string_all_role, true);
     $data['all_role']=$json_all_role["Results"];
     //var_dump( $data['all_role']);
    
    $this->load->view('admin/content/member_page/view_user',$data);
    
    $this->load->view('admin/footer/footer_main');
    
  } 
   public function delete_user()
  {
   
    $data['chosed']="member_page";
    $this->load->helper('url');
    $this->load->view('admin/header/header_main',$data);
    $this->load->view('admin/taskbar_top/taskbar_top');
    $this->load->view('admin/menu/menu_main',$data);
    $id=$_GET['param_id'];
    
    //xoa
    $action="delete";
    $url=Api_link_enum::$DELETE_USER_URL;
    
    $myvars = 'id=' . $id . '&action=' . $action;
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec( $ch );
    
     
    
    
      //danh sách tất cả các thành viên
     $link_all_user = Api_link_enum::$ALL_USER_URL."?limit=".Restaurantenum::LIMIT_PAGE_USER_ALL."&page=1";
     $json_string_all_user= file_get_contents($link_all_user);    
     $json_all_user = json_decode($json_string_all_user, true);
     $data['all_user']=$json_all_user["Results"];
     //var_dump( $data['all_user']);
     
      $this->load->view('admin/content/member_page/member_page',$data);

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
     $data['INSERT_RESTAURANT_URL']=  Api_link_enum::$INSERT_RESTAURANT_URL;
     
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
      $this->load->model('restaurantenum');
      $this->load->helper('url');
    
      //id nhà hàng
      $id_restaurant=$_GET['id_restaurant'];
      $link_detail_restaurant = Api_link_enum::$EDIT_RESTAURANT_URL."?id=$id_restaurant";
      $json_string_detail_restaurant= file_get_contents($link_detail_restaurant);    
      $json_detail_restaurant = json_decode($json_string_detail_restaurant, true);
      $data['info_restaurant']=$json_detail_restaurant["Results"];
    
    
    
     //link image upload temp
     $data['BASE_IMAGE_UPLOAD_TEMP_URL']=  Api_link_enum::$BASE_IMAGE_UPLOAD_TEMP_URL;
   //call php upload image temp
     $data['BASE_CALL_UPLOAD_IMAGE_TEMP_URL']=  Api_link_enum::$BASE_CALL_UPLOAD_IMAGE_TEMP_URL;
     $data['link_restaurant_frofile']=  Api_link_enum::$BASE_PROFILE_RESTAURANT_URL;
     
     
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

    
   
    
    //danh sách tất cả các nhà hàng
     $link_all_restaurant = Api_link_enum::$ALL_RESTAURANT_URL."?limit=".Restaurantenum::LIMIT_PAGE_RESTAURANT_ALL."&page=1";
     $json_string_all_restaurant= file_get_contents($link_all_restaurant);    
     $json_all_restaurant = json_decode($json_string_all_restaurant, true);
     $data['all_restaurant']=$json_all_restaurant["Results"];
     //var_dump( $data['all_restaurant']);
      $data['chosed']="coupon_page";
      $this->load->helper('url');
      $this->load->view('admin/header/header_main',$data);
      $this->load->view('admin/taskbar_top/taskbar_top');
      $this->load->view('admin/menu/menu_main',$data);
    
      $this->load->view('admin/content/coupon_page/coupon_page');
      $this->load->view('admin/footer/footer_main');
    
    
    
  }  
  public function form_add_coupon()
  {
      $data['id_res']=$_GET['id_restaurant'];
      $data['name_res']=$_GET['name_res'];
      
      $data['chosed']="coupon_page";
      $this->load->helper('url');
      $this->load->view('admin/header/header_main',$data);
      $this->load->view('admin/taskbar_top/taskbar_top');
      $this->load->view('admin/menu/menu_main',$data);
    
      $this->load->view('admin/content/coupon_page/add_coupon');
      
      $this->load->view('admin/footer/footer_main');
    
    
    
  }  
    public function add_coupon()
  {
    $id_restaurant           =$_POST['id_restaurant'];
    $value_coupon            =$_POST['value_coupon'];
    $date_coupon_start       =$_POST['date_coupon_start'];
    $date_coupon_end         =$_POST['date_coupon_end'];
    $description             =$_POST['description'];
    $action="insert";
    $url=Api_link_enum::$ADD_COUPON_URL;
    $myvars = 'id_restaurant=' . $id_restaurant . 
              '&value_coupon=' . $value_coupon.
              '&start_date=' . $date_coupon_start.
              '&due_date=' . $date_coupon_end.
              '&desc=' . $description.
              '&action=' . $action;
   // echo $url;
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec( $ch );
    
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