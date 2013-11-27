<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include model/api_link_enum
require APPPATH.'/models/api_link_enum.php';

class Check_login extends CI_Controller {
   public function __construct() {
    parent::__construct();
   // $this->load->model('function_modeler');
    Api_link_enum::initialize();
    session_start();
  }

  public function index()
  {
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $url = 'http://localhost/slickvn_api_project_xinh/slickvn_api/index.php/user/user_apis/login/format/json';
    $myvars = 'email=' . $email . '&password=' . $password;

    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec( $ch );
    
    $json = json_decode($response, true);
    
    if($json['Status']=="FALSE"){
      echo "Error";
      
    }
    else{
      foreach ($json['Results'] as $value){
         $full_name=$value['full_name'];
         $email=$value['email'];
         $phone_number=$value['phone_number'];
         $address=$value['address'];
         $location=$value['location'];
         $avatar=$value['avatar'];
         $id=$value['id'];
         $role_list=$value['role_list'];
         
         
         //echo $role_list[0];
         foreach ($role_list as $value_role_list){
          // echo $value_role_list;           
         }
   
         
         
     
         
      }
    }
    
    
    
    
    //echo $response;
    
    
    
    // curl_close($ch);
  }
 
 }