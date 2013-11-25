<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of API_Link_Enum
 *
 * @author phu
 *///http://192.168.1.147:8181/slickvn/index.php/slick_apis/format/json
class Api_link_enum { 
  const DOMAIN_NAME = "http://192.168.1.194";
  const PORT = "/"; //":8181/";
  const SUB_DOMAIN = "slickvn_api_project_xinh/slickvn_api/index.php/";
  const SUB_DOMAIN_COMMON ="common/common_apis/";
  const SUB_DOMAIN_USER ="user/user_apis/";
  const SUB_DOMAIN_RESTAURANT ="restaurant/restaurant_apis/";
  const FORMAT_JSON = "/format/json";
  const NEWEST_RESTAURANT_API = "get_newest_restaurant_list";
  const ORTHER_RESTAURANT_API = "get_orther_restaurant_list";
  const MEAL_TYPE_LIST_API = "get_base_collection";
  const FAVOURITE_TYPE_API = "get_base_collection";
  const CAROUSEL_API = "get_all_restaurant_approval_show_carousel";
  const PROMOTION_API = "get_coupon_list";
  const POST_API = "get_post_list";
  const DETAIL_RESTAURANT_API="get_detail_restaurant";
  const PRICE_PERSION_API="get_base_collection";
  const CULINARY_STYLE_API="get_base_collection";
  const ALL_RESTAURANT_API="get_all_restaurant";




  const LINK_RESTAURANT_PROFILE = "slickvn_api_project_xinh/slickvn_api/restaurant_profile/"; //link image in restaurant profile
  const LINK_IMAGE_POST = "slickvn_api_project_xinh/slickvn_api/posts/";  //link image post
  const LINK_IMAGE_UPLOAD_TEMP="slickvn_api_project_xinh/slickvn_api/";   //link image upload temp
  const LINK_CALL_UPLOAD_IMAGE_TEMP="../../../../../../../../slickvn_api_project_xinh/slickvn_api/"; //link call php upload temp


  const MODE_USE_LIST_API = "get_base_collection";
  const PAYMENT_TYPE_LIST_API = "get_base_collection";
  const LANDSCAPE_LIST_API = "get_base_collection";
  const PRICE_PERSON_LIST_API = "get_base_collection";
  const OTHER_CRITERIA_LIST_API = "get_base_collection";
  
 



    /*end link image----------*/


  /*search---------*/
  const SEARCH_MEAL_API="search_restaurant_by_meal";
  const SEARCH_FAVOURITE_API="search_restaurant_by_id_base_collection";
  const SEARCH_RESTAURANT_API="search_restaurant_by_name";
  /*end search----------*/


  //link API restaurant all
   const RESTAURANT_API = "get_order_by_restaurant";
  //link login 
    
   
   
   
   
   /*name collection*/
   const COLLECTION_NAME="?collection_name=";
   const COLLECTION_MEAL_TYPE = "meal_type";
   const COLLECTION_FAVOURITE = "favourite_type";
   const COLLECTION_PRICE_PERSION = "price_person";
   const COLLECTION_CULINARY_STYLE= "culinary_style";
   const COLLECTION_MODE_USE= "mode_use";
   const COLLECTION_PAYMENT = "payment_type";
   const COLLECTION_LANDSCAPE = "landscape";
   const COLLECTION_PRICE_PERSON = "price_person";
   const COLLECTION_OTHER_CRITERIA = "other_criteria";
   
   /*end name collection*/
   
   
    
    
    public static $BASE_API_URL;
    public static $NEWEST_RESTAURANT_URL;
    public static $ORTHER_RESTAURANT_URL;
    public static $MEAL_TYPE_LIST_URL;
    public static $FAVOURITE_TYPE_URL;
    public static $CAROUSEL_URL;
    public static $PROMOTION_URL;
    public static $POST_URL;
    public static $RESTAURANT_URL;
    public static $ALL_RESTAURANT_URL;
    public static $BASE_API_COMMON_URL;
    public static $BASE_API_USER_URL;
    public static $BASE_API_RESTAURANT_URL;
    public static $DETAIL_RESTAURANT_URL;
    public static $SEARCH_MEAL_URL;
    public static $PRICE_PERSION_URL; 
    public static $CULINARY_STYLE_URL;
    public static $BASE_PROFILE_RESTAURANT_URL;
    public static $BASE_IMAGE_POST_URL;
    public static $SEARCH_FAVOURITE_URL;
    public static $SEARCH_RESTAURANT_URL;
    public static $MODE_USE_LIST_URL;
    public static $PAYMENT_TYPE_LIST_URL;
    public static $LANDSCAPE_LIST_URL;
    public static $PRICE_PERSON_LIST_URL;
    public static $OTHER_CRITERIA_LIST_URL;
    public static $BASE_IMAGE_UPLOAD_TEMP_URL;
    public static $BASE_CALL_UPLOAD_IMAGE_TEMP_URL;
    
    
    
    public static function initialize()
    {  
      /*url*/
      self::$BASE_API_COMMON_URL = self::DOMAIN_NAME.self::PORT.self::SUB_DOMAIN.self::SUB_DOMAIN_COMMON;
      self::$BASE_API_USER_URL = self::DOMAIN_NAME.self::PORT.self::SUB_DOMAIN.self::SUB_DOMAIN_USER;
      self::$BASE_API_RESTAURANT_URL = self::DOMAIN_NAME.self::PORT.self::SUB_DOMAIN.self::SUB_DOMAIN_RESTAURANT;
      self::$BASE_PROFILE_RESTAURANT_URL = self::DOMAIN_NAME.self::PORT.self::LINK_RESTAURANT_PROFILE;
      self::$BASE_IMAGE_POST_URL=self::DOMAIN_NAME.self::PORT.self::LINK_IMAGE_POST;
      self::$BASE_IMAGE_UPLOAD_TEMP_URL=self::DOMAIN_NAME.self::PORT.self::LINK_IMAGE_UPLOAD_TEMP;
      self::$BASE_CALL_UPLOAD_IMAGE_TEMP_URL=self::LINK_CALL_UPLOAD_IMAGE_TEMP;
      
      
      /*
       * end url*/
      
      self::$NEWEST_RESTAURANT_URL = self::$BASE_API_RESTAURANT_URL.self::NEWEST_RESTAURANT_API.self::FORMAT_JSON ;              
      self::$ORTHER_RESTAURANT_URL = self::$BASE_API_RESTAURANT_URL.self::ORTHER_RESTAURANT_API.self::FORMAT_JSON ;
      self::$MEAL_TYPE_LIST_URL = self::$BASE_API_COMMON_URL.self::MEAL_TYPE_LIST_API.self::FORMAT_JSON ;
      self::$FAVOURITE_TYPE_URL = self::$BASE_API_COMMON_URL.self::FAVOURITE_TYPE_API.self::FORMAT_JSON ;
      self::$CAROUSEL_URL = self::$BASE_API_RESTAURANT_URL.self::CAROUSEL_API.self::FORMAT_JSON ;
      self::$PROMOTION_URL = self::$BASE_API_RESTAURANT_URL.self::PROMOTION_API.self::FORMAT_JSON ;
      self::$POST_URL = self::$BASE_API_RESTAURANT_URL.self::POST_API.self::FORMAT_JSON ;
      self::$RESTAURANT_URL = self::$BASE_API_RESTAURANT_URL.self::RESTAURANT_API.self::FORMAT_JSON ;
      self::$ALL_RESTAURANT_URL = self::$BASE_API_RESTAURANT_URL.self::ALL_RESTAURANT_API.self::FORMAT_JSON ;
      self::$DETAIL_RESTAURANT_URL = self::$BASE_API_RESTAURANT_URL.self::DETAIL_RESTAURANT_API.self::FORMAT_JSON ;
      self::$PRICE_PERSION_URL = self::$BASE_API_COMMON_URL.self::PRICE_PERSION_API.self::FORMAT_JSON ;
      self::$CULINARY_STYLE_URL = self::$BASE_API_COMMON_URL.self::CULINARY_STYLE_API.self::FORMAT_JSON ;
      self::$MODE_USE_LIST_URL = self::$BASE_API_COMMON_URL.self::MODE_USE_LIST_API.self::FORMAT_JSON ;
      
      self::$PAYMENT_TYPE_LIST_URL= self::$BASE_API_COMMON_URL.self::PAYMENT_TYPE_LIST_API.self::FORMAT_JSON ;
      self::$LANDSCAPE_LIST_URL= self::$BASE_API_COMMON_URL.self::LANDSCAPE_LIST_API.self::FORMAT_JSON ;
      self::$PRICE_PERSON_LIST_URL= self::$BASE_API_COMMON_URL.self::PRICE_PERSON_LIST_API.self::FORMAT_JSON ;
      self::$OTHER_CRITERIA_LIST_URL= self::$BASE_API_COMMON_URL.self::OTHER_CRITERIA_LIST_API.self::FORMAT_JSON ;
              
              
      /*search*/
      self::$SEARCH_MEAL_URL = self::$BASE_API_RESTAURANT_URL.self::SEARCH_MEAL_API.self::FORMAT_JSON ;
      self::$SEARCH_FAVOURITE_URL= self::$BASE_API_RESTAURANT_URL.self::SEARCH_FAVOURITE_API.self::FORMAT_JSON ;
      self::$SEARCH_RESTAURANT_URL= self::$BASE_API_RESTAURANT_URL.self::SEARCH_RESTAURANT_API.self::FORMAT_JSON ;
      
      /*end search*/
       
      
      
      
      
    }
    
    
}



?>
